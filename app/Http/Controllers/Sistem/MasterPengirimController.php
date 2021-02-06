<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterPengirim as MasterPengirim;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class MasterPengirimController extends Controller
{

    public function index_json(Request $request)
    {
        $pengirim = MasterPengirim::orderByRaw('trim(kode) asc ')->get();

        if ($request->ajax()) {
            return Datatables::of($pengirim)
            ->editColumn('nama', function($data){
                return  '<a class="font-15" href="' . route('pengirim_detail', $data->id) .'">' 
                        . '[' . $data->kode . '] - ' . $data->nama . '</a><br>
                        <span class="font-13 font-weight-500">' . $data->alamat . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->telepon . '<br>' . $data->fax . '</span>';
            })
            ->editColumn('pemilik', function($data){
                return  '<span class="font-14 font-weight-bold text-dark">' .  $data->pemilik  . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->keputusan . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('pengirim_edit',  $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['nama','pemilik','action'])
            ->toJson();
        }
    }

    public function index()
    {
        // $provinsi = DB::table('kedatangan_provinsi')->get();
        return view('sistem.master.pengirim.index', [
            // 'provinsi' => $provinsi
        ]);
    }

    public function create()
    {
        return view('sistem.master.pengirim.create');
    }

    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmPengirim' => 'required',
            'nmKode' => 'max:4'],
        ['nmPengirim.required' => '* Nama Pengirim harus diisi',
            'nmKode.max' => '* Jumlah Karakter Maksimal adalah 4']
        );

        $status = $request->nmStatus;

        if($status == "baru"){
            $pengirim = new MasterPengirim();
        }
        else{
            $pengirim = MasterPengirim::find($request->nmID);
        }
        
        $pengirim->kode = $request->nmKode;
        $pengirim->nama = $request->nmPengirim;
        $pengirim->pemilik = $request->nmPemilik;
        $pengirim->keputusan = $request->nmKeputusan;
        $pengirim->telepon = $request->nmTelepon;
        $pengirim->fax = $request->nmFax;
        $pengirim->alamat = $request->nmAlamat;
        $pengirim->alamat_penampungan = $request->nmPenampungan;
        $pengirim->save();

        return [$pengirim];
    }

    public function store(Request $request)
    {
        list($pengirim) = $this->saveData($request);
        return redirect()->route('pengirim_detail', $pengirim->id)->with('success', 'Data baru telah ditambahkan');
    }

    public function edit($id)
    {
        $pengirim = MasterPengirim::find($id);
        return view('sistem.master.pengirim.edit', [
            'pengirim' => $pengirim,
        ]);
    }
    public function detail($id)
    {
        $pengirim = MasterPengirim::find($id);
        return view('sistem.master.pengirim.detail', [
            'pengirim' => $pengirim,
        ]);
    }
    public function update(Request $request)
    {
        $this->saveData($request);
        return redirect()->route('pengirim_index')->with('success', 'Data pengirim telah diperbarui');
    }

    public function delete(Request $request)
    {
        MasterPengirim::find($request->idDelete)->delete();
        return redirect()->route('pengirim_index')->with('success', 'Data pengirim telah dihapus');
        
    }

}