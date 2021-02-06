<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Konsultasi as Konsultasi;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\User;

class KonsultasiController extends Controller
{

    public function index_json(Request $request)
    {
        $konsultasi = DB::table('konsultasi')->select('konsultasi.*', 'master_kategori_line.name as kategori', 'users.username')
                    ->leftjoin('master_kategori_line', 'master_kategori_line.jenis_id', '=', 'konsultasi.kategori_id')
                    ->join('users', 'users.id', '=', 'konsultasi.user_id')
                    ->where('master_kategori_line.jenis', 'm_konsultasi_kategori')
                    ->get();

        if ($request->ajax()) {
            return Datatables::of($konsultasi)
            ->editColumn('judul', function($data){
                return  '<a class="" href="' . route('konsultasi_detail', $data->id) .'">
                        <span class="font-weight-bold font-15">'. $data->judul . '</span></a>';
            })
            ->editColumn('kategori', function($data){
                return  '<span class="font-14 text-dark font-weight-bold">' . $data->kategori .'</span>';
            })
            ->editColumn('status', function($data){
                if($data->status === "open"){
                    return  '<span class="bg-primary text-white font-13 px-2 py-1 rounded font-weight-500">Open</span>';
                }else{
                    return  '<span class="bg-dark text-white font-13 px-2 py-1 rounded font-weight-500">Closed</span>';
                }
            })
            ->editColumn('create_date', function($data){
                return  '<span class="font-14 text-dark font-weight-bold">' .  
                        \Carbon\Carbon::parse($data->create_date)->format('d-m-Y') . '<br><span class="text-success font-13">' .
                        $data->username  . '</span></span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('konsultasi_edit',  $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['judul','kategori','status','create_date','action'])
            ->toJson();
        }
    }

    
    public function index()
    {
        return view('sistem.konsultasi.index');
    }

    public function getKategori(){
        $kategori = DB::table('master_kategori_line')
                    ->select('id', 'name', 'kode', 'jenis_id')
                    ->where('jenis', 'm_konsultasi_kategori')
                    ->get();
        return [$kategori];
    }

    public function getRespon($id){
        $respon = DB::table('konsultasi_respon')
                ->select('konsultasi_respon.*', 'users.*', 'konsultasi_respon.id as id_respon')
                ->join('users', 'users.id', '=', 'konsultasi_respon.user_id')
                ->where('konsultasi_id', $id)
                ->orderby('konsultasi_respon.id', 'desc')
                ->get();

        return [$respon];
    }

    
    public function create()
    {
        list($kategori) = $this->getKategori();
        return view('sistem.konsultasi.create',[
            'kategori' => $kategori,
        ]);
    }

    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmJudul' => 'required'],
        ['nmJudul.required' => '* Judul harus diisi']
        );

        $user = Auth::user();

        $status = $request->nmStatus;

        if($status == "baru"){
            $konsultasi = new Konsultasi();
            $konsultasi->create_uid = $user->id;
            $konsultasi->create_date = now();
        }
        else{
            $konsultasi = Konsultasi::find($request->nmID);
            $konsultasi->write_uid = $user->id;
            $konsultasi->write_date = now();
        }
    
        $konsultasi->judul = $request->nmJudul;
        $konsultasi->kategori_id = $request->nmKategori;
        $konsultasi->konten = $request->nmPertanyaan;
        $konsultasi->save();

        return [$konsultasi];
    }

    public function store(Request $request)
    {
        list($konsultasi) = $this->saveData($request);
        return redirect()->route('konsultasi_detail', $konsultasi)->with('success', 'Konsultasi Baru Telah Dibuat');
    }

    // Get Single Data (edit / detail)
    public function firstData($id){

        $konsultasi = DB::table('konsultasi')->select('konsultasi.*', 'master_kategori_line.name as kategori', 'users.username')
                    ->leftjoin('master_kategori_line', 'master_kategori_line.jenis_id', '=', 'konsultasi.kategori_id')
                    ->join('users', 'users.id', '=', 'konsultasi.user_id')
                    ->where('master_kategori_line.jenis', 'm_konsultasi_kategori')
                    ->where('konsultasi.id', $id)
                    ->first();

        return [$konsultasi];
    }

    public function edit($id)
    {
        list($konsultasi) = $this->firstData($id);
        list($kategori) = $this->getKategori();
        return view('sistem.konsultasi.edit', [
            'konsultasi' => $konsultasi,
            'kategori' => $kategori,
        ]);
    }
    public function detail($id)
    {
        list($konsultasi) = $this->firstData($id);
        list($respon) = $this->getRespon($id);

        $user = User::find($konsultasi->user_id);
        
        return view('sistem.konsultasi.detail', [
            'konsultasi' => $konsultasi,
            'respon' => $respon,
            'user' => $user,
        ]);
    }
    public function update(Request $request)
    {
        list($konsultasi) = $this->saveData($request);
        return redirect()->route('konsultasi_detail', $konsultasi)->with('success', 'Jadwal Kedatangan telah diperbarui');
    }

    public function delete(Request $request)
    {
        Konsultasi::find($request->idDelete)->delete();
        return redirect()->route('konsultasi_index')->with('success', 'Jadwal Kedatangan telah dihapus');
        
    }

    public function konsultasi_status(Request $request){
        $id = $request->idStatusKonsultasi;
        $konsultasi = Konsultasi::find($id);
        if($konsultasi->status === "open"){
            $status = 'closed';
            $info = 'Sesi Konsultasi Ditutup dan Dinyatakan Selesai.';
        }
        else{
            $status = 'open';
            $info = 'Sesi Konsultasi Dibuka Kembali.';
        }
        $konsultasi->status = $status;
        $konsultasi->save();

        return redirect()->back()->with('konsultasi', $info);
    }

    public function respon(Request $request)
    {
        $id = $request->nmID;
        $user = Auth::user();
        DB::table('konsultasi_respon')->insert([
            'konsultasi_id' => $id,
            'user_id' => $user->id,
            'respon' => $request->nmRespon,
            'create_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Tanggapan Baru Ditambahkan');
    }

    public function respon_hapus(Request $request)
    {
        $id = $request->nmIdResponHapus;
        DB::table('konsultasi_respon')->where('id', $id)->update([
            'delete_date' => now(),
        ]);

        return redirect()->back()->with('respon', 'Tanggapan Dihapus');
    }
    
    public function respon_status(Request $request){
        $id = $request->idRespon;
        $konsultasi = Konsultasi::find($id);
        // dd($konsultasi);
        if($konsultasi->status_respon === "open"){
            $status_respon = 'closed';
            $info = 'Kolom Tanggapan Ditutup.';
        }
        else{
            $status_respon = 'open';
            $info = 'Kolom Tanggapan Dibuka.';
        }
        $konsultasi->status_respon = $status_respon;
        $konsultasi->save();

        return redirect()->back()->with('respon', $info);
    }
    

}