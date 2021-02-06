<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KabKota as KabKota;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class KabKotaController extends Controller
{

    public function index_json(Request $request)
    {
        $kabkota = DB::table('kedatangan_kabkota')->select('kedatangan_kabkota.*', 'kedatangan_provinsi.nama as provinsi')
                    ->join('kedatangan_provinsi', 'kedatangan_provinsi.id', '=', 'kedatangan_kabkota.provinsi_id')
                    ->get();

        if ($request->ajax()) {
            return Datatables::of($kabkota)
            ->editColumn('nama', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->nama . '</span>';
            })
            ->editColumn('provinsi', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->provinsi . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('kabkota_edit', $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['nama', 'provinsi','action'])
            ->toJson();
        }
    }

    public function index()
    {
        $provinsi = DB::table('kedatangan_provinsi')->get();
        return view('sistem.master.kabkota.index', [
            'provinsi' => $provinsi
        ]);
    }

    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmKabKota' => 'required'],
        ['nmKabKota.required' => '* Kabupaten harus diisi']
        );

        $cek_id = DB::table('kedatangan_kabkota')->max('id');
        $id = $cek_id + 1;
        $status = $request->nmStatus;

        if($status == "baru"){
            $kabkota = new KabKota();
            $kabkota->id = $id;
        }
        else{
            $kabkota = KabKota::find($request->nmID);
        }
        $kabkota->provinsi_id = $request->nmProvinsi;
        $kabkota->nama = $request->nmKabKota;
        $kabkota->save();

        
    }

    public function store(Request $request)
    {
        $this->saveData($request);
        return redirect()->route('kabkota_index')->with('success', 'Kabupaten Baru Ditambahkan');
    }

    public function edit($id)
    {
        $kabkota = DB::table('kedatangan_kabkota')->where('id', $id)->first();
        $provinsi = DB::table('kedatangan_provinsi')->get();
        return view('sistem.master.kabkota.edit', [
            'provinsi' => $provinsi,
            'kabkota' => $kabkota,
        ]);
    }

    public function update(Request $request)
    {
        $this->saveData($request);
        return redirect()->route('kabkota_index')->with('success', 'Kabupaten / Kota Diperbarui');
    }

    public function delete(Request $request)
    {
        KabKota::find($request->idDelete)->delete();
        return redirect()->route('kabkota_index')->with('success', 'Data telah dihapus');
        
    }

}