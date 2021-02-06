<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Provinsi as Provinsi;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ProvinsiController extends Controller
{

    public function index_json(Request $request)
    {
        $provinsi = Provinsi::get();

        if ($request->ajax()) {
            return Datatables::of($provinsi)
            ->editColumn('nama', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->nama . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('provinsi_edit', $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['nama','action'])
            ->toJson();
        }
    }

    public function index()
    {
        return view('sistem.master.provinsi.index');
    }

    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmProvinsi' => 'required'],
        ['nmProvinsi.required' => '* Provinsi harus diisi']
        );

        $cek_id = DB::table('kedatangan_provinsi')->max('id');
        $id = $cek_id + 1;
        $status = $request->nmStatus;

        if($status == "baru"){
            $provinsi = new Provinsi();
            $provinsi->id = $id;
        }
        else{
            $provinsi = Provinsi::find($request->nmID);
        }
        
        $provinsi->nama = $request->nmProvinsi;
        $provinsi->save();

        
    }

    public function store(Request $request)
    {
        $this->saveData($request);
        return redirect()->route('provinsi_index')->with('success', 'Provinsi Baru Ditambahkan');
    }

    public function edit($id)
    {
        $provinsi = DB::table('kedatangan_provinsi')->where('id', $id)->first();
        return view('sistem.master.provinsi.edit', [
            'provinsi' => $provinsi
        ]);
    }

    public function update(Request $request)
    {
        $this->saveData($request);
        return redirect()->route('provinsi_index')->with('success', 'Provinsi Diperbarui');
    }

    public function delete(Request $request)
    {
        Provinsi::find($request->idDelete)->delete();
        return redirect()->route('provinsi_index')->with('success', 'Data telah dihapus');
        
    }

}