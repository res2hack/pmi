<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterJabatan as MasterJabatan;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class MasterJabatanController extends Controller
{

    public function index_json(Request $request)
    {
        $jabatan = MasterJabatan::orderByRaw('trim(nama) asc ')->get();

        if ($request->ajax()) {
            return Datatables::of($jabatan)
            ->editColumn('nama', function($data){
                return  '<a class="font-15" href="' . route('jabatan_detail', $data->id) .'">' 
                        . $data->nama . '</a><br>
                        <span class="font-13">' .  $data->keterangan  . '</span>';
            })
            ->editColumn('kode_pmi_jabatan', function($data){
                return  '<span class="font-14 font-weight-bold">' .  $data->kode_pmi_jabatan  . '</span>';
            })
            ->editColumn('sts_formal', function($data){
                if($data->sts_formal == '1'){
                    return  '<span class="font-14 font-weight-500">Formal</span>';
                }
                else{
                    return  '<span class="font-14 font-weight-500">Informal</span>';
                }
                
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('jabatan_edit',  $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['nama','kode_pmi_jabatan','keterangan','sts_formal','action'])
            ->toJson();
        }
    }

    public function index()
    {
        return view('sistem.master.jabatan.index');
    }

    public function create()
    {
        return view('sistem.master.jabatan.create');
    }

    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmJabatan' => 'required'],
        ['nmJabatan.required' => '* Nama Jabatan harus diisi']
        );

        $status = $request->nmStatus;

        if($status == "baru"){
            $jabatan = new MasterJabatan();
        }
        else{
            $jabatan = MasterJabatan::find($request->nmID);
        }

        $jabatan->nama = $request->nmJabatan;
        $jabatan->kode_pmi_jabatan = $request->nmKode;
        $jabatan->keterangan = $request->nmKeterangan;
        $jabatan->sts_formal = $request->nmStsFormal;
        $jabatan->save();

        return [$jabatan];
    }

    public function store(Request $request)
    {
        list($jabatan) = $this->saveData($request);
        return redirect()->route('jabatan_detail', $jabatan)->with('success', 'Data baru telah ditambahkan');
    }

    public function edit($id)
    {
        $jabatan = MasterJabatan::find($id);
        return view('sistem.master.jabatan.edit', [
            'jabatan' => $jabatan,
        ]);
    }
    public function detail($id)
    {
        $jabatan = MasterJabatan::find($id);
        return view('sistem.master.jabatan.detail', [
            'jabatan' => $jabatan,
        ]);
    }
    public function update(Request $request)
    {
        list($jabatan) = $this->saveData($request);
        return redirect()->route('jabatan_detail', $jabatan)->with('success', 'Data jabatan telah diperbarui');
    }

    public function delete(Request $request)
    {
        MasterJabatan::find($request->idDelete)->delete();
        return redirect()->route('jabatan_index')->with('success', 'Data jabatan telah dihapus');
        
    }

}