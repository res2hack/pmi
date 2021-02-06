<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalPetugas as JadwalPetugas;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class JadwalPetugasController extends Controller
{

    public function index_json(Request $request)
    {
        $petugas = JadwalPetugas::orderByRaw('id desc')->get();

        if ($request->ajax()) {
            return Datatables::of($petugas)
            ->editColumn('nama', function($data){
                return  '<a class="font-15" href="' . route('jadwal_petugas_detail', $data->id) .'">' 
                        . $data->nama . '</a>';
            })
            ->editColumn('jadwal', function($data){
                return  '<span class="font-14 font-weight-bold">' .  $data->jadwal  . '</span>';
            })
            ->editColumn('ket1', function($data){
                return  '<span class="font-14 font-weight-500">' .  $data->ket1  . '</span>';
            })
            ->editColumn('ket2', function($data){
                return  '<span class="font-14 font-weight-500">' .  $data->ket2  . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('jadwal_petugas_edit',  $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['nama','jadwal','ket1','ket2','action'])
            ->toJson();
        }
    }

    public function index()
    {
        return view('sistem.jadwal.petugas.index');
    }

    public function create()
    {
        return view('sistem.jadwal.petugas.create');
    }

    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmPetugas' => 'required'],
        ['nmPetugas.required' => '* Nama Petugas harus diisi']
        );

        $status = $request->nmStatus;

        if($status == "baru"){
            $petugas = new JadwalPetugas();
        }
        else{
            $petugas = JadwalPetugas::find($request->nmID);
        }
        
        $petugas->nama = $request->nmPetugas;
        $petugas->jadwal = $request->nmJadwal;
        $petugas->ket1 = $request->nmKet1;
        $petugas->ket2 = $request->nmKet2;
        $petugas->save();

        return [$petugas];
    }

    public function store(Request $request)
    {
        list($petugas) = $this->saveData($request);
        return redirect()->route('jadwal_petugas_detail', $petugas)->with('success', 'Jadwal Petugas baru telah ditambahkan');
    }

    public function edit($id)
    {
        $petugas = JadwalPetugas::find($id);
        return view('sistem.jadwal.petugas.edit', [
            'petugas' => $petugas,
        ]);
    }
    public function detail($id)
    {
        $petugas = JadwalPetugas::find($id);
        return view('sistem.jadwal.petugas.detail', [
            'petugas' => $petugas,
        ]);
    }
    public function update(Request $request)
    {
        list($petugas) = $this->saveData($request);
        return redirect()->route('jadwal_petugas_detail', $petugas)->with('success', 'Jadwal Petugas telah diperbarui');
    }

    public function delete(Request $request)
    {
        JadwalPetugas::find($request->idDelete)->delete();
        return redirect()->route('jadwal_petugas_index')->with('success', 'Jadwal Petugas telah dihapus');
        
    }

}