<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterKategoriLine as MasterKategoriLine;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class MasterKategoriLineController extends Controller
{

    public function index($jenisKategori)
    {
        return view('sistem.master.' . $jenisKategori . '.index', [
            'jenisKategori' => $jenisKategori,
        ]);
    }


    public function saveData(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $user = Auth::user();

            $this->validate($request, 
            ['nmName' => 'required'],
            ['nmName.required' => '* Kolom ini wajib diisi']
            );

            $id = $request->nmID;
            $status = $request->nmStatus;
            $redirect = $request->nmRedirect;
            $jenisKategori = $request->nmJenisKategori;

            if($status == "baru"){
                $max_jenis_id = DB::table('master_kategori_line')
                                ->where('jenis', $jenisKategori)
                                ->orderBy('jenis_id', 'desc')
                                ->pluck('jenis_id')
                                ->first();
                $master = new MasterKategoriLine();
                $master->jenis = $jenisKategori;
                $master->jenis_id = $max_jenis_id + 1;
            }
            else{
                $master = MasterKategoriLine::find($id);
            }

            $master->kode = $request->nmKode;
            $master->name = $request->nmName;
            $master->join1 = $request->nmJoin1;
            $master->join1_id = $request->nmJoin1_ID;
            $master->join2 = $request->nmJoin2;
            $master->join2_id = $request->nmJoin2_ID;
            $master->tag1 = $request->nmTag1;
            $master->tag2 = $request->nmTag2;
            $master->tag1_int = $request->nmTag1_Int;
            $master->tag2_int = $request->nmTag2_Int;
            $master->keterangan1 = $request->nmKeterangan1;
            $master->keterangan2 = $request->nmKeterangan2;
            $master->save();
        
            return [$master, $redirect, $jenisKategori];
        });
    }

    public function store(Request $request)
    {
        list($master, $redirect, $jenisKategori) = $this->saveData($request);
        $cek_slug = str_replace("m_","", $jenisKategori);
        $slug = str_replace("_","-", $cek_slug);

        $message = 'Data baru telah ditambahkan';
        if($redirect == "back"){
            return redirect()->back()->with('success', $message);
        }
        else{
            return redirect()->route('master_' . $redirect , $slug)->with('success', $message);
        }
    }

    public function edit(Request $request, $jenisKategori, $id)
    {
        $master = MasterKategoriLine::find($id);
        $cek_slug = str_replace("m_","", $jenisKategori);
        $slug = str_replace("_","-", $cek_slug);
        return view('sistem.master.' . $slug . '.edit', [
            'master' => $master,
            'jenisKategori' => $jenisKategori,
        ]);
    }

    public function update(Request $request)
    {
        list($master, $redirect, $jenisKategori) = $this->saveData($request);
        $cek_slug = str_replace("m_","", $jenisKategori);
        $slug = str_replace("_","-", $cek_slug);

        $pesan = 'Data telah diperbarui';
        if($redirect == "back"){
            return redirect()->back()->with('success', $pesan);
        }
        else{
            return redirect()->route('master_' . $redirect , $slug)->with('success', $pesan);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->idDelete;
        $jenisKategori = $request->nmJenisKategoriDelete;
        $cek_slug = str_replace("m_","", $jenisKategori);
        $slug = str_replace("_","-", $cek_slug);

        $master = MasterKategoriLine::find($id);
        $master->delete();
        return redirect()->route('master_index' , $slug)->with('success', 'Data telah dihapus');
        
    }

    // INDEX JSON

    public function sektor_json(Request $request)
    {

        $master = DB::table('master_kategori_line')->where('jenis', 'm_sektor')->get();
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('name', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->name . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['sektor', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name','action'])
            ->toJson();
        }
    }

    public function masalah_json(Request $request)
    {

        $master = DB::table('master_kategori_line')->where('jenis', 'm_masalah')->get();
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('name', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->name . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['masalah', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name','action'])
            ->toJson();
        }
    }

    public function jenisPulang_json(Request $request)
    {

        $master = DB::table('master_kategori_line')
                ->where('jenis', 'kedatangan_jenis_pulang')->get();
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('name', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->name . '</span>';
            })
            ->editColumn('tag1', function($data){
                return  '<span class="font-14 font-weight-bold text-white py-1 px-2
                        bg-' . $data->tag1. '">' . $data->tag1 . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['kedatangan_jenis_pulang', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name', 'tag1','action'])
            ->toJson();
        }
    }

    public function pendidikan_json(Request $request)
    {
        $master = DB::table('master_kategori_line')->where('jenis', 'm_pendidikan')->get();
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('name', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->name . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['pendidikan', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name','action'])
            ->toJson();
        }
    }

    public function pekerjaan_json(Request $request)
    {

        $master = (DB::select(DB::raw("SELECT p.id AS 'id', p.name AS 'pekerjaan', s.name AS 'sektor'
                            FROM master_kategori_line p, master_kategori_line s
                            WHERE p.jenis = 'm_pekerjaan' AND s.jenis = 'm_sektor' 
                            AND s.jenis_id = p.join1_id ORDER BY p.id DESC")));

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('pekerjaan', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->pekerjaan . '</span>';
            })
            ->editColumn('sektor', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->sektor . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['pekerjaan', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['pekerjaan','sektor','action'])
            ->toJson();
        }
    }

    public function negara_json(Request $request)
    {
        $master = DB::table('master_kategori_line')->select('id','jenis','kode','name')
                ->where('jenis', 'm_negara')
                ->orderByRaw('trim(name) ASC')
                ->get();
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('name', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->name . '</span>';
            })
            ->editColumn('kode', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->kode . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['negara', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name','kode','action'])
            ->toJson();
        }
    }

    public function bandara_json(Request $request)
    {
        $master = (DB::select(DB::raw("SELECT ban.id AS 'id',ban.kode AS 'kode', ban.tag1 AS 'kota', 
                                    ban.name AS 'bandara', neg.name AS 'negara'
                            FROM master_kategori_line ban, master_kategori_line neg
                            WHERE ban.jenis = 'm_bandara' AND neg.jenis = 'm_negara' 
                            AND neg.jenis_id = ban.join1_id ORDER BY trim(neg.name) ASC")));
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('bandara', function($data){
                return  '<span class="font-14 font-weight-bold"> 
                        <span class="text-capitalize">[' . $data->kode . ']</span> - '
                        . $data->bandara . '</span><br>
                        <span class="font-12 text-primary font-weight-500">' . $data->kota . '</span>';
            })
            ->editColumn('negara', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->negara . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['bandara', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['bandara','negara','action'])
            ->toJson();
        }
    }

    public function pesawat_json(Request $request)
    {
        $master = DB::table('master_kategori_line')->select('id','jenis','kode','name')
                ->where('jenis', 'm_pesawat')
                ->orderByRaw('trim(name) ASC')
                ->get();
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('name', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->name . '</span>';
            })
            ->editColumn('kode', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->kode . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['pesawat', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name','kode','action'])
            ->toJson();
        }
    }

    public function imigrasi_json(Request $request)
    {
        $master = DB::table('master_kategori_line')
                ->select('id','name','keterangan1','keterangan2')
                ->where('jenis', 'm_kantor_imigrasi')
                ->orderBy('id', 'desc')
                ->get();
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('name', function($data){
                return  '<span class="font-15 font-weight-bold text-dark">' . $data->name . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->keterangan1 . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->keterangan2 . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['imigrasi', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name','action'])
            ->toJson();
        }
    }

    public function konsultasi_kategori_json(Request $request)
    {
        $master = DB::table('master_kategori_line')->where('jenis', 'm_konsultasi_kategori')->get();
        // $jenisKategori = $request->nmJenisKategori;

        if ($request->ajax()) {
            return Datatables::of($master)
            ->editColumn('name', function($data){
                return  '<span class="font-14 font-weight-bold">' . $data->name . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('master_edit', ['kategori-konsultasi', $data->id]) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name','action'])
            ->toJson();
        }
    }

}