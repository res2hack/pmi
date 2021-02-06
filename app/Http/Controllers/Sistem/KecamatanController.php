<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kecamatan as Kecamatan;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class KecamatanController extends Controller
{

    public function index_json(Request $request)
    {
        $kecamatan = DB::table('kedatangan_pengirim')->select('kedatangan_pengirim.*', 'kedatangan_kabkota.nama as kabkota')
                    ->join('kedatangan_kabkota', 'kedatangan_kabkota.id', '=', 'kedatangan_pengirim.kabkota_id')
                    ->get();

        if ($request->ajax()) {
            return Datatables::of($kecamatan)
            ->editColumn('nama', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->nama . '</span>';
            })
            ->editColumn('kabkota', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->kabkota . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('kecamatan_edit', $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['nama', 'kabkota','action'])
            ->toJson();
        }
    }

    public function index()
    {
        $kabkota = DB::table('kedatangan_kabkota')->get();
        return view('sistem.master.kecamatan.index', [
            'kabkota' => $kabkota
        ]);
    }

    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmKecamatan' => 'required'],
        ['nmKecamatan.required' => '* Kecamatan harus diisi']
        );

        $cek_id = DB::table('kedatangan_pengirim')->max('id');
        $id = $cek_id + 1;
        $status = $request->nmStatus;

        if($status == "baru"){
            $kecamatan = new Kecamatan();
            $kecamatan->id = $id;
        }
        else{
            $kecamatan = Kecamatan::find($request->nmID);
        }
        $kecamatan->kabkota_id = $request->nmKabKota;
        $kecamatan->nama = $request->nmKecamatan;
        $kecamatan->save();

        
    }

    public function store(Request $request)
    {
        $this->saveData($request);
        return redirect()->route('kecamatan_index')->with('success', 'Kecamatan Baru Ditambahkan');
    }

    public function edit($id)
    {
        $kecamatan = DB::table('kedatangan_pengirim')->where('id', $id)->first();
        $kabkota = DB::table('kedatangan_kabkota')->get();
        return view('sistem.master.kecamatan.edit', [
            'kabkota' => $kabkota,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function update(Request $request)
    {
        $this->saveData($request);
        return redirect()->route('kecamatan_index')->with('success', 'Kecamatan  Diperbarui');
    }

    public function delete(Request $request)
    {
        Kecamatan::find($request->idDelete)->delete();
        return redirect()->route('kecamatan_index')->with('success', 'Data telah dihapus');
        
    }

}