<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sistem\UsersPartnerController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pelatihan as Pelatihan;
use App\Models\PelatihanLine as PelatihanLine;
use Arr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\UsersPartner as UsersPartner;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;

class PelatihanController extends Controller
{

    public function getProvinsi(){
        $provinsi = DB::table('pmi_provinsi')->get();
        return [$provinsi];
    }

    public function getKejuruan(){
        $kejuruan = DB::table('master_kategori_line')->where('jenis', 'm_kejuruan')->get();
        return [$kejuruan];
    }
    public function getSubKejuruan(){
        $sub_kejuruan = DB::table('master_kategori_line')->where('jenis', 'm_sub_kejuruan')->get();
        return [$sub_kejuruan];
    }
    public function getSumberDana(){
        $sumber_dana = DB::table('master_kategori_line')->where('jenis', 'm_sumber_dana')->get();
        return [$sumber_dana];
    }
    public function getMetode(){
        $metode = DB::table('master_kategori_line')->where('jenis', 'm_metode_pelatihan')->get();
        return [$metode];
    }

    public function getLSP(){
         // Untuk Keperluan Sertifikasi
        $lsp = DB::table('pmi_direktori')->where('kategori', 'lsp')
                ->where('sts_valid', 1)
                ->groupByRaw('trim(nama) asc')
                ->get();
        return [$lsp];
    }
    public function getPerusahaan(){
        // Untuk Keperluan Penempatan
        $perusahaan = DB::table('pmi_perusahaan')->select('id', 'nama')
                    ->orderByRaw('trim(nama) asc')->get();
        return [$perusahaan];
    }

    // Get Pelatihan - Global Untuk semua Sub
    public function getPelatihan(Request $request){
        $get_pelatihan = DB::table('pelatihan')->select('pelatihan.*',
                        DB::raw('kejuruan.name as kejuruan, sub_kejuruan.name as sub_kejuruan,dana.name as sumber_dana'))
                ->leftjoin('master_kategori_line as kejuruan', 'kejuruan.jenis_id', '=', 'pelatihan.kejuruan_id')
                ->leftjoin('master_kategori_line as sub_kejuruan', 'sub_kejuruan.jenis_id', '=', 'pelatihan.sub_kejuruan_id')
                ->leftjoin('master_kategori_line as dana', 'dana.jenis_id', '=', 'pelatihan.sumber_dana_id')
                ->where('kejuruan.jenis', 'm_kejuruan')
                ->where('sub_kejuruan.jenis', 'm_sub_kejuruan')
                ->where('dana.jenis', 'm_sumber_dana')
                ->whereYear('tgl_mulai', $request->nmTahun);

        return [$get_pelatihan];
    }

    // Get Pelatihan Detail by ID - Global Untuk semua Sub
    public function getPelatihanDetail(Request $request){
        $id = $request->nmIDpelatihan;
        $detail = DB::table('pelatihan')
                    ->where('id', $id)
                    ->first();
                    
        return [$detail];
    }

    // Pelatihan - Indeks JSON
    public function index_json(Request $request)
    {

        list($get_pelatihan) = $this->getPelatihan($request);
        $pelatihan = $get_pelatihan->orderBy('pelatihan.id', 'desc')->get();

        if ($request->ajax()) {
            return Datatables::of($pelatihan)
            ->editColumn('name', function($data){
                return  '<a href="' . route('pelatihan_detail', $data->id) .'">
                        <u class="font-weight-bold font-15">' 
                        . $data->name . '</u></a><br><span class="font-13 font-weight-bold ">Durasi: </span>
                        <span class="text-ungu font-12 font-weight-bold">' . $data->jam_pelajaran. ' Jam</span>
                        <br><span class="font-13 font-weight-bold ">Kuota: </span>
                        <span class="text-ungu font-12 font-weight-bold">' . $data->kuota_peserta. ' Peserta</span>';
            })
            ->editColumn('tgl_mulai', function($data){
                return  '<div class=""><span class="font-13 font-weight-bold">Mulai: </span>
                            <span class="text-primary font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') .'</span><br><span class="font-13 font-weight-bold">Selesai: </span>
                            <span class="text-danger font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') .'</span></div>';
            })
            ->editColumn('kejuruan', function($data){
                return  '<span class="font-weight-bold font-14 text-dark">' . $data->sub_kejuruan . '</span><br>
                        <span class="font-13 font-weight-bold ">' . $data->kejuruan . '</span>';
            })
            ->editColumn('anggaran', function($data){
                return  '<span class="font-weight-bold font-14 text-dark">' .number_format(($data->anggaran),0,",",".") . '</span><br>
                        <span class="font-12 font-weight-bold">Sumber: </span>
                        <span class="font-12 text-uppercase font-weight-bold text-primary">' . $data->sumber_dana . '</span>';
            })
            ->editColumn('status_pelatihan', function($data){
                if($data->status_pelatihan === "draft")
                {
                    return  '<span class="bg-warning px-2 py-1 rounded font-13 font-weight-500 text-white">Draft</span>';
                }
                elseif($data->status_pelatihan === "valid"){
                    return  '<span class="bg-ungu2 px-2 py-1 rounded font-13 font-weight-500 text-white">Valid</span>';
                }
                elseif($data->status_pelatihan === "batal"){
                    return  '<span class="bg-danger px-2 py-1 rounded font-13 font-weight-500 text-white">Batal</span>';
                }
                else{
                    return  '<span class="bg-success px-2 py-1 rounded font-13 font-weight-500 text-white">Selesai</span>';
                }
                
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail/Ubah/Hapus">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('pelatihan_detail', $data->id) . '"><i class="far fa-file-alt font-14 mr-2"></i> Detail</a>
                    <a class="dropdown-item text-primary" href="' . route('pelatihan_edit', $data->id) . '"> <i class="fas fa-edit font-13 mr-2"></i>Ubah</a>
                    <a class="dropdown-item text-success" href="' . route('pelatihan_pendaftaran_detail', $data->id) . '"> <i class="fas fa-user-friends font-13 mr-2"></i>Pendaftaran</a>
                    <a class="dropdown-item text-danger" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter" >
                    <i class="fas fa-times font-15 mr-2"></i> Hapus</a>
                </div>';
            })
            ->rawColumns(['name','tgl_mulai','kejuruan','anggaran','status_pelatihan','action'])
            ->toJson();
        }
    }

    // Pelatihan - Indeks
    public function index()
    {
        return view('sistem.pelatihan.index', [
        ]);
    }

    // Pelatihan - Baru
    public function create()
    {
        list($kejuruan) = $this->getKejuruan();
        list($sub_kejuruan) = $this->getsubKejuruan();
        list($metode) = $this->getMetode();
        list($sumber_dana) = $this->getSumberDana();
        return view('sistem.pelatihan.create',[
            'kejuruan' => $kejuruan,
            'sub_kejuruan' => $sub_kejuruan,
            'metode' => $metode,
            'sumber_dana' => $sumber_dana,
        ]);
    }

    // Pelatihan Function Store / Update
    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmPelatihan' => 'required'],
        ['nmPelatihan.required' => '* Nama Program Pelatihan harus diisi']
        );

        $user = Auth::user();

        $tipe = $request->nmTipe;

        if($tipe == "create"){
            $pelatihan = new Pelatihan();
            $pelatihan->create_uid = $user->id;
            $pelatihan->create_date = now();
        }
        else{
            $pelatihan = Pelatihan::find($request->nmID);
            $pelatihan->write_uid = $user->id;
            $pelatihan->write_date = now();
        }
        
        $id_mix = explode("|", $request->nmKejuruan);
       
        $kejuruan_id = $id_mix[0];
        $sub_kejuruan_id = $id_mix[1];
        
        $anggaran = str_replace(".", "" , $request->nmAnggaran);

        $pelatihan->name = $request->nmPelatihan;
        $pelatihan->kejuruan_id = $kejuruan_id;
        $pelatihan->sub_kejuruan_id = $sub_kejuruan_id;
        $pelatihan->sumber_dana_id = $request->nmSumberDana;
        $pelatihan->anggaran = $anggaran;
        $pelatihan->metode_pelatihan_id = $request->nmMetode;
        $pelatihan->kuota_peserta = $request->nmKuota;
        $pelatihan->jam_pelajaran = $request->nmJamPelajaran;
        $pelatihan->tgl_mulai = $request->nmTglMulai;
        $pelatihan->tgl_selesai = $request->nmTglSelesai;
        $pelatihan->keterangan = $request->nmKeterangan;
        $pelatihan->status_pelatihan = $request->nmStatusPelatihan;
        $pelatihan->status_pendaftaran = $request->nmStatusPendaftaran;
        $pelatihan->tipe_pendaftaran = $request->nmTipePendaftaran;
        if($request->nmStatusPelatihan !== "valid"){
            $pelatihan->status_pendaftaran = "tutup";
        }
        $pelatihan->save();

        return [$pelatihan];
    }

    // Pelatihan - Store
    public function store(Request $request)
    {
        list($pelatihan) = $this->saveData($request);
        return redirect()->route('pelatihan_detail', $pelatihan->id)->with('success', 'Program Pelatihan Telah Disimpan');
    }

    // Pelatihan Fungsi Ambil Semua Data By ID
    public function firstData($id){

        $pelatihan = Pelatihan::find($id);

        $kejuruan = '-';
        $sub_kejuruan = '-';
        $sumber_dana = '-';
        $metode = '-';

        if($pelatihan){
            $kejuruan = DB::table('master_kategori_line')->where('jenis', 'm_kejuruan')
            ->where('jenis_id', $pelatihan->kejuruan_id)->pluck('name')->first();

            $sub_kejuruan = DB::table('master_kategori_line')->where('jenis', 'm_sub_kejuruan')
            ->where('jenis_id', $pelatihan->sub_kejuruan_id)->pluck('name')->first();

            $sumber_dana = DB::table('master_kategori_line')->where('jenis', 'm_sumber_dana')
            ->where('jenis_id', $pelatihan->sumber_dana_id)->pluck('name')->first();

            $metode = DB::table('master_kategori_line')->where('jenis', 'm_metode_pelatihan')
            ->where('jenis_id', $pelatihan->metode_pelatihan_id)->pluck('name')->first();
        }

        return [$pelatihan,  $kejuruan, $sub_kejuruan, $sumber_dana, $metode];
    }

    // Pelatihan - Edit
    public function edit($id)
    {
        $pelatihan = Pelatihan::find($id);
        list($kejuruan) = $this->getKejuruan();
        list($sub_kejuruan) = $this->getsubKejuruan();
        list($metode) = $this->getMetode();
        list($sumber_dana) = $this->getSumberDana();
        
        return view('sistem.pelatihan.edit', [
            'pelatihan' => $pelatihan,
            'kejuruan' => $kejuruan,
            'sub_kejuruan' => $sub_kejuruan,
            'metode' => $metode,
            'sumber_dana' => $sumber_dana,
        ]);
    }

    // Pelatihan - Detail
    public function detail($id)
    {
        $pelatihan = Pelatihan::find($id);
        list($pelatihan,  $kejuruan, $sub_kejuruan, $sumber_dana, $metode) = $this->firstData($id);

        return view('sistem.pelatihan.detail', [
            'pelatihan' => $pelatihan, 
            'kejuruan' => $kejuruan,
            'sub_kejuruan' => $sub_kejuruan,
            'metode' => $metode,
            'sumber_dana' => $sumber_dana,
        ]);
    }

    // Pelatihan - Update
    public function update(Request $request)
    {
        list($pelatihan) = $this->saveData($request);
        return redirect()->route('pelatihan_detail', $pelatihan->id)->with('success', 'Program Pelatihan Diperbarui');
    }

    public function delete(Request $request)
    {
        Pelatihan::find($request->idDelete)->delete();
        return redirect()->route('pelatihan_index')->with('success', 'Program Pelatihan telah dihapus');
        
    }

    public function pelatihan_selesai(Request $request, $id)
    {
        $user = Auth::user();
        $pelatihan = Pelatihan::find($id);
        $pelatihan->status_pelatihan = 'selesai';
        $pelatihan->write_uid = $user->id;
        $pelatihan->write_date = $user->id;
        $pelatihan->save();
        return redirect()->back()->with('success', 'Status Pelatihan Selesai');
    }

    // ----- End Pelatihan ------


    // -------- Pendaftaran Parent (Indeks) ----------

    // Pendaftaran Indeks Json
    public function pendaftaran_index_json(Request $request)
    {
    
        list($get_pelatihan) = $this->getPelatihan($request);
        $pendaftaran = $get_pelatihan->whereIn('pelatihan.status_pelatihan', ['valid', 'selesai'])
                        ->orderBy('pelatihan.id', 'desc')->get();
        
        if ($request->ajax()) {
            return Datatables::of($pendaftaran)
            ->editColumn('name', function($data){
                return  '<a href="' . route('pelatihan_pendaftaran_detail', $data->id) .'">
                        <u class="font-weight-bold font-15">' 
                        . $data->name . '</u></a><br><span class="font-13 font-weight-bold ">Kuota: </span>
                        <span class="text-ungu font-12 font-weight-bold">' . $data->kuota_peserta. ' Peserta</span>
                        <br><span class="font-13 font-weight-bold ">Pendaftar: </span>
                        <span class="text-primary font-12 font-weight-bold">' . $data->jml_pendaftar. '</span>
                        <span class="ml-2 font-12 font-weight-bold">L('. $data->pendaftar_l. ') / P(' . $data->pendaftar_p .')</span>';
            })
            ->editColumn('tgl_mulai', function($data){
                return  '<div class=""><span class="font-13 font-weight-bold">Mulai: </span>
                            <span class="text-primary font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') .'</span><br><span class="font-13 font-weight-bold">Selesai: </span>
                            <span class="text-danger font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') .'</span></div>';
            })
            ->editColumn('kejuruan', function($data){
                return  '<span class="font-weight-bold font-14 text-dark">' . $data->sub_kejuruan . '</span><br>
                        <span class="font-13 font-weight-bold ">' . $data->kejuruan . '</span>';
            })
            ->editColumn('tipe_pendaftaran', function($data){
                if($data->tipe_pendaftaran === "terbuka")
                {
                return  '<span class="font-weight-bold text-capitalize text-dark font-14"><i class="fas fa-door-open text-success mr-2"></i>' . $data->tipe_pendaftaran . '</span>';
                }else{
                    return  '<span class="font-weight-bold text-capitalize font-14 text-dark"><i class="fas fa-door-closed text-secondary mr-2"></i>' . $data->tipe_pendaftaran . '</span>';
                }
            })
            ->editColumn('status_pendaftaran', function($data){
                if($data->status_pendaftaran === "buka")
                {
                    return  '<span class="bg-success px-2 py-1 rounded font-13 text-white font-weight-500"><i class="fas fa-lock-open mr-2 font-11"></i>Buka</span>';
                }
                else{
                    return  '<span class="bg-danger px-2 py-1 rounded font-13 text-white font-weight-500"><i class="fas fa-lock mr-2 font-11"></i>Tutup</span>';
                }
            })
            ->addColumn('action', function ($data) {
                if($data->status_pendaftaran === "buka")
                {
                    return '<div class="btn-group dropleft mr-2" title="Detail Pendaftaran Pelatihan">
                    <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v text-primary"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="' . route('pelatihan_pendaftaran_detail', $data->id) . '"><i class="far fa-file-alt font-14 mr-2"></i> Detail</a>
                        <a class="dropdown-item text-danger" href="" id="btnDelete"  onclick="$(' . "'#idUbahStatus'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                        data-toggle="modal" data-target="#modalUbahStatus" >
                        <i class="fas fas fa-lock mr-2"></i>Tutup</a>
                    </div>';
                }
                else{
                    return '<div class="btn-group dropleft mr-2" title="Detail Pendaftaran Pelatihan">
                    <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v text-primary"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="' . route('pelatihan_pendaftaran_detail', $data->id) . '"><i class="far fa-file-alt font-14 mr-2"></i> Detail</a>
                        <a class="dropdown-item text-success" href="" id="btnDelete"  onclick="$(' . "'#idUbahStatus'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                        data-toggle="modal" data-target="#modalUbahStatus" >
                        <i class="fas fas fa-lock-open mr-2"></i>Buka</a>
                    </div>';
                }
            })
            ->rawColumns(['name','tgl_mulai','kejuruan','tipe_pendaftaran','status_pendaftaran','action'])
            ->toJson();
        }
    }

    // Pendaftaran - Indeks View
    public function pendaftaran_index()
    {
        return view('sistem.pelatihan.pendaftaran.index', [
        ]);
    }

    // Fungsi Pendaftaran Get Detail Pendaftar - Function
    public function getPendaftaranDetail(Request $request){
        $get_pendaftaran_detail = DB::table('pelatihan_line')->select('pelatihan_line.*', 
                        'pelatihan.status_pelatihan',
                        'users_partner.name as nama', 'users_partner.alamat', 
                        'users_partner.nik', 'users_partner.jk', 
                        'users_partner.tgl_lahir', 'users_partner.email', 'users_partner.kontak')
                        ->leftjoin('pelatihan', 'pelatihan.id', '=', 'pelatihan_line.pelatihan_id')
                        ->leftjoin('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                        ->where('pelatihan_id', $request->nmIDpelatihan)
                        ->whereNull('pelatihan_line.delete_date');

        return [$get_pendaftaran_detail];
    }

    // Fungsi Pendaftaran Get Detail Pendaftar - JSON
    public function pendaftaran_detail_json(Request $request){

        list($get_pendaftaran_detail) = $this->getPendaftaranDetail($request);
        $pendaftaran = $get_pendaftaran_detail->orderByRaw('trim(tgl_pendaftaran) asc');

        if ($request->ajax()) {
            return Datatables::of($pendaftaran)
            ->editColumn('nama', function($data) {
                return  '<input id="idPeserta" type="hidden" value="' . $data->users_partner_id . '"></input>
                        <span class="font-weight-bold text-dark font-14">' . $data->nama . '</span></a>';
            })
            ->editColumn('nik', function ($data){
                return ' <div class="text-dark">' . $data->nik . '</div>';
            })
            ->editColumn('jk', function ($data){
                return ' <div class="text-dark">' . $data->jk . '</div>';
            })
            ->editColumn('alamat', function ($data){
                return ' <div class="text-dark">' . $data->alamat . '</div>';
            })
            ->editColumn('tgl_pendaftaran', function ($data){
                return ' <div class="text-dark">' . $data->tgl_pendaftaran . '</div>';
            })
            ->editColumn('no_pendaftaran', function ($data){
                return ' <div class="text-dark">' . $data->no_pendaftaran . '</div>';
            })
            ->addColumn('action', function ($data) {
                if($data->status_pelatihan !== "selesai"){
                    return '<a class="font-weight-bold font-14" href="" id="btnDelete"  onclick="$(' . "'#modalNama'" . ').text(' . "'$data->nama'".');
                    $(' . "'#modalNIK'" . ').text(' . "'$data->nik'".');$(' . "'#modalJK'" . ').text(' . "'$data->jk'".');
                    $(' . "'#modalAlamat'" . ').text(' . "'$data->alamat'".');$(' . "'#modalTglLahir'" . ').text(' . "'$data->tgl_lahir'".');
                    $(' . "'#modalNoDaftar'" . ').text(' . "'$data->no_pendaftaran'".');
                    $(' . "'#modalTglDaftar'" . ').val(' . "'$data->tgl_pendaftaran'".');
                    $(' . "'#idUbah'" . ').val(' . "'$data->id'".');" title="Detail / Ubah Data" 
                    data-toggle="modal" data-target="#modalUpdate"><i class="fas fa-edit font-14"></i></a>
                    <a class="text-danger " href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Batalkan Pendaftaran" 
                    data-toggle="modal" data-target="#modalBatalDaftar">
                    <i class="fas fa-times font-14"></i></a>';
                }else{
                    if($data->status_penerimaan === "ya"){
                        return '<div class="text-center">
                                <i class="iconStatus far fa-check-circle font-14 text-success" title="Diterima"></i>
                                </div>';
                    }
                    else{
                        return '<div class="text-center">
                        <i class="iconStatus far fa-times-circle font-14 text-danger" title="Tidak Diterima"></i>
                        </div>';
                    }
                    return '<div class="text-center text-capitalize">' . $data->status_penerimaan . '</div>';
                }
            })
            ->rawColumns(['nama', 'nik','jk', 'alamat', 'tgl_pendaftaran','no_pendaftaran','action'])
            ->toJson();
        }
    }

    // Pendaftaran Detail - View
    public function pendaftaran_detail($id)
    {
        $pelatihan = Pelatihan::find($id);
        list($provinsi) = $this->getProvinsi();
        list($pelatihan,  $kejuruan, $sub_kejuruan, $sumber_dana, $metode) = $this->firstData($id);
        return view('sistem.pelatihan.pendaftaran.detail', [
            'pelatihan' => $pelatihan, 
            'kejuruan' => $kejuruan,
            'sub_kejuruan' => $sub_kejuruan,
            'metode' => $metode,
            'sumber_dana' => $sumber_dana,
            'provinsi' => $provinsi,
        ]);
    }

    // Update Jumlah Pendaftar di Table pelatihan Setelah Proses Pendaftaran Peserta- JSON Function
    public function updateJumlahPendaftar($pelatihan_id){

        $jumlah_pendaftar = DB::table('pelatihan_line')
                            ->where('pelatihan_id', $pelatihan_id)
                            ->whereNull('delete_date')
                            ->count();

        $jumlah_l = DB::table('pelatihan_line')->select('pelatihan_line.id')
                ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                ->where('users_partner.jk', 'L')
                ->whereNull('pelatihan_line.delete_date')
                ->count();
        
        $jumlah_p = DB::table('pelatihan_line')->select('pelatihan_line.id')
                ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                ->where('users_partner.jk', 'P')
                ->whereNull('pelatihan_line.delete_date')
                ->count();

        $pelatihan = Pelatihan::find($pelatihan_id);
        $pelatihan->jml_pendaftar = $jumlah_pendaftar;
        $pelatihan->pendaftar_l = $jumlah_l;
        $pelatihan->pendaftar_p = $jumlah_p;
        $pelatihan->save();

        return [$jumlah_pendaftar, $jumlah_l, $jumlah_p, $pelatihan];
    }

    // Pendaftaran Peserta Yang Sudah Punya Data di table -> users_partner
    public function pendaftaran_store_exists(Request $request){
        
        $user = Auth::user();
        $id_mix = explode("|", $request->nmPenduduk);
    
        $users_partner_id = $id_mix[0];
        $users_id = $id_mix[1];

        $kejuruan_id = $request->nmKejuruanExists;
        
        $kode_kejuruan = DB::table('master_kategori_line')
        ->where('jenis', 'm_kejuruan')
        ->where('jenis_id', $kejuruan_id)
        ->pluck('tag1')
        ->first();

        $pendaftaran = new PelatihanLine();

        //  str_pad utk mematenkan digit karena kode kejuruan 01 menjadi 1 (varchar);

        $format = str_pad($kode_kejuruan, 2, '0', STR_PAD_LEFT) . now()->format('y') . now()->format('m');
        
        $cek_previous = DB::table('pelatihan_line')
                            ->where('no_pendaftaran', 'like', '%' . $format . '%')
                            ->orderby('no_pendaftaran', 'DESC')
                            ->pluck('no_pendaftaran')
                            ->first();

        $cek_previous = Str::substr($cek_previous, -4);

        if(!$cek_previous){
            $cek_previous = 0;
        }

        $format_final = $format . (str_pad($cek_previous+1, 4, '000', STR_PAD_LEFT));

        $no_pendaftaran =  $format_final;
        
        $pendaftaran->no_pendaftaran = $no_pendaftaran;
        $pendaftaran->users_partner_id = $users_partner_id;
        $pendaftaran->pelatihan_id = $request->nmIDpelatihanExists;
        $pendaftaran->tgl_pendaftaran = $request->nmTglDaftarExists;
        $pendaftaran->create_uid = $user->id;
        $pendaftaran->create_date = now();
        $pendaftaran->save();

        // Update Jumlah Pendaftar
        $pelatihan_id = $pendaftaran->pelatihan_id;
        list($jumlah_pendaftar, $jumlah_l, $jumlah_p, $pelatihan) = $this->updateJumlahPendaftar($pelatihan_id);

        return $pendaftaran;
    }

    // Pendaftaran Ubah Status - JSON
    public function pendaftaran_ubah_Status(Request $request){
        $id = $request->idUbahStatus;
        $user = Auth::user();
        $pendaftaran = Pelatihan::find($id);
        if($pendaftaran->status_pendaftaran == "buka"){
            $pesan = 'Ditutup';
            $status = 'tutup';
        }
        else{
            $pesan = 'Dibuka';
            $status = 'buka';
        }

        $pendaftaran->status_pendaftaran = $status;
        $pendaftaran->save();
        
        return redirect()->back()->with('success', 'Pendaftaran ' . $pesan);
    }

    // Pendaftaran Peserta Yang Belum Mempunyai Data di table -> users_partner
    public function pendaftaran_store_baru(Request $request){

        $partner = new UsersPartnerController;
        $users_partner = $partner->store_json($request);

        if(isset($request->nmBeriLogin)){

            $userLogin = new User();
            $userLogin->name = $request->nmPartner;
            $userLogin->tipe = 'user';
            $userLogin->username = $request->nmUsername;
            $userLogin->email = $request->nmEmailLogin;
            
            $userLogin->password = Hash::make($request->nmPassword);
            $userLogin->sct = $request->nmPassword;
            $userLogin->status = $request->nmStatusAktif;
            $userLogin->save();

            DB::table('model_has_roles')->where('model_id', $users_partner->user_id)->delete();
            
            // Set Role sebagai User atau user
            $role_id = DB::table('roles')->where('name', 'User')
                        ->orWhere('name', 'user')->pluck('id')
                        ->first();

            $userLogin->assignRole($role_id);

            $update_partner = UsersPartner::find($users_partner->id);
            $update_partner->user_id = $userLogin->id;
            $update_partner->save();
        }


        $id = $request->nmIDpelatihanBaru;
    
        $kejuruan_id = $request->nmKejuruanBaru;
        
        $kode_kejuruan = DB::table('master_kategori_line')
        ->where('jenis', 'm_kejuruan')
        ->where('jenis_id', $kejuruan_id)
        ->pluck('tag1')
        ->first();

        $pendaftaran = new PelatihanLine();

        //  str_pad utk mematenkan digit karena kode kejuruan 01 menjadi 1 (varchar);

        $format = str_pad($kode_kejuruan, 2, '0', STR_PAD_LEFT) . now()->format('y') . now()->format('m');
        
        $cek_previous = DB::table('pelatihan_line')
                            ->where('no_pendaftaran', 'like', '%' . $format . '%')
                            ->orderby('no_pendaftaran', 'DESC')
                            ->pluck('no_pendaftaran')
                            ->first();

        $cek_previous = Str::substr($cek_previous, -4);

        if(!$cek_previous){
            $cek_previous = 0;
        }

        $format_final = $format . (str_pad($cek_previous+1, 4, '000', STR_PAD_LEFT));

        $no_pendaftaran =  $format_final;

        $user = Auth::user();
        $pendaftaran = new PelatihanLine();
        $pendaftaran->users_partner_id = $users_partner->id;
        $pendaftaran->no_pendaftaran = $no_pendaftaran;
        $pendaftaran->pelatihan_id = $id;
        $pendaftaran->tgl_pendaftaran = $request->nmTglDaftarBaru;
        $pendaftaran->create_uid = $user->id;
        $pendaftaran->create_date = now();
        $pendaftaran->save();

        // Update Jumlah Pendaftar
        $pelatihan_id = $pendaftaran->pelatihan_id;
        list($jumlah_pendaftar, $jumlah_l, $jumlah_p, $pelatihan) = $this->updateJumlahPendaftar($pelatihan_id);

        return $pendaftaran;
    }

    // Update Pendaftaran (Hanya Tanggal Daftar Saja) - JSON
    public function pendaftaran_update(Request $request){

        $id = $request->idUbah;
        $user = Auth::user();
        $pendaftaran = PelatihanLine::find($id);
        $pendaftaran->tgl_pendaftaran = $request->nmTglDaftarUbah;
        $pendaftaran->write_uid = $user->id;
        $pendaftaran->write_date = now();
        $pendaftaran->save();
        return $pendaftaran;
    }

    // Hapus Pendaftar (Softdelete) - JSON
    public function pendaftaran_delete(Request $request){
        $id = $request->idDelete;
        $user = Auth::user();
        $pendaftaran = PelatihanLine::find($id);
        $pendaftaran->status_penerimaan = 'tidak';
        $pendaftaran->delete_uid = $user->id;
        $pendaftaran->delete_date = now();
        $pendaftaran->save();

        // Update Jumlah Pendaftar
        $pelatihan_id = $pendaftaran->pelatihan_id;
        list($jumlah_pendaftar, $jumlah_l, $jumlah_p, $pelatihan) = $this->updateJumlahPendaftar($pelatihan_id);

        return $pendaftaran;
    }

    // Cek Duplikat Pendaftaran - Function
    public function pendaftaran_duplikat(Request $request){
        $pelatihan_id = $request->nmIDpelatihanExists;
        $users_partner_id = $request->nmPenduduk;
        
        $cek_duplikat = DB::table('pelatihan_line')
                ->where('pelatihan_id', $pelatihan_id)
                ->where('users_partner_id', $users_partner_id)
                ->whereNull('delete_date')
                ->count();
        return $cek_duplikat;
    }

    // -------- End Pendaftaran ----------



    // -------- Penerimaan Parent (Indeks) ----------

    public function updateJumlahPenerimaan($pelatihan_id){

        $jumlah_peserta = DB::table('pelatihan_line')
                            ->where('pelatihan_id', $pelatihan_id)
                            ->where('status_penerimaan', 'ya')
                            ->whereNull('delete_date')
                            ->count();

        $jumlah_l = DB::table('pelatihan_line')->select('pelatihan_line.id')
                ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                ->where('pelatihan_line.status_penerimaan', 'ya')
                ->where('users_partner.jk', 'L')
                ->whereNull('pelatihan_line.delete_date')
                ->count();
        
        $jumlah_p = DB::table('pelatihan_line')->select('pelatihan_line.id')
                ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                ->where('pelatihan_line.status_penerimaan', 'ya')
                ->where('users_partner.jk', 'P')
                ->whereNull('pelatihan_line.delete_date')
                ->count();

        $pelatihan = Pelatihan::find($pelatihan_id);
        $pelatihan->jml_peserta = $jumlah_peserta;
        $pelatihan->peserta_l = $jumlah_l;
        $pelatihan->peserta_p = $jumlah_p;
        $pelatihan->save();

        return [$jumlah_peserta, $jumlah_l, $jumlah_p, $pelatihan];
    }

    public function penerimaan_index_json(Request $request)
    {
        list($get_pelatihan) = $this->getPelatihan($request);
        $penerimaan = $get_pelatihan->whereIn('pelatihan.status_pelatihan', ['valid', 'selesai'])
                    ->orderBy('pelatihan.id', 'desc')->get();

        if ($request->ajax()) {
            return Datatables::of($penerimaan)
            ->editColumn('name', function($data){
                if($data->status_pendaftaran === "buka"){
                    return  '<a href="' . route('pelatihan_penerimaan_detail', $data->id) .'">
                    <u class="font-weight-bold font-15">' 
                    . $data->name . '</u></a><br><span class="font-13 font-weight-bold ">Kuota: </span>
                    <span class="text-ungu font-12 font-weight-bold">' . $data->kuota_peserta. ' Peserta</span>
                    <br><span class="font-13 font-weight-bold">Pendaftaran: <span class="text-success">Buka</span></span> ';
                }else{
                    return  '<a href="' . route('pelatihan_penerimaan_detail', $data->id) .'">
                    <u class="font-weight-bold font-15">' 
                    . $data->name . '</u></a><br><span class="font-13 font-weight-bold">Kuota: </span>
                    <span class="text-ungu font-12 font-weight-bold">' . $data->kuota_peserta. ' Peserta</span>
                    <br><span class="font-13 font-weight-bold">Pendaftaran: <span class="text-danger">Tutup</span></span> ';
                }
            })
            ->editColumn('tgl_mulai', function($data){
                return  '<div class=""><span class="font-13 font-weight-bold">Mulai: </span>
                            <span class="text-primary font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') .'</span><br><span class="font-13 font-weight-bold">Selesai: </span>
                            <span class="text-danger font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') .'</span></div>';
            })
            ->editColumn('kejuruan', function($data){
                return  '<span class="font-weight-bold font-14 text-dark">' . $data->sub_kejuruan . '</span><br>
                        <span class="font-13 font-weight-bold ">' . $data->kejuruan . '</span>';
            })
            ->editColumn('jumlah_pendaftar', function($data){
                    return  '<div class="text-center font-weight-bold text-dark font-15">'. $data->jml_pendaftar . '</div>';
            })
            ->editColumn('diterima', function($data){
                return  '<div class="font-weight-bold text-primary font-15 text-center">'. $data->jml_peserta . '</div>';
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('pelatihan_penerimaan_detail', $data->id) . '" title="Detail Penerimaan">
                            <i class="fas fa-caret-right mr-2"></i>Detail Penerimaan</a>
                    <a class="dropdown-item"  href="' . route('pelatihan_pendaftaran_detail', $data->id) . '" title="Detail Pendaftaran">
                        <i class="fas fa-caret-right mr-2"></i>Detail Pendaftaran</a>
                    <a class="dropdown-item"  href="' . route('pelatihan_detail', $data->id) . '" title="Detail Pelatihan"> 
                        <i class="fas fa-caret-right mr-2"></i>Detail Pelatihan</a>
                    </div>';
                
            })
            ->rawColumns(['name','tgl_mulai','kejuruan','jumlah_pendaftar','diterima','action'])
            ->toJson();
        }
    }

    public function penerimaan_index()
    {
        return view('sistem.pelatihan.penerimaan.index', [
        ]);
    }

    public function penerimaan_detail_json(Request $request){

        list($get_pendaftaran_detail) = $this->getPendaftaranDetail($request);

        $penerimaan_detail = $get_pendaftaran_detail->get();

        if ($request->ajax()) {
            return Datatables::of($penerimaan_detail)
            ->editColumn('nama', function($data) {
                return  '<div class="text-dark font-weight-500 font-14">'. $data->nama . '</div>';
            })
            ->editColumn('nik', function ($data){
                return ' <div class="text-dark font-14">' . $data->nik . '</div>';
            })
            ->editColumn('jk', function ($data){
                return ' <div class="text-dark font-14">' . $data->jk . '</div>';
            })
            ->editColumn('alamat', function ($data){
                return ' <div class="text-dark font-14">' . $data->alamat . '</div>';
            })
            ->editColumn('tgl_pendaftaran', function ($data){
                return ' <div class="text-dark font-14">' . $data->tgl_pendaftaran . '</div>';
            })
            ->editColumn('no_pendaftaran', function ($data){
                return ' <div class="text-dark font-14">' . $data->no_pendaftaran . '</div>';
            })
            ->editColumn('status_penerimaan', function ($data) {
                if($data->status_penerimaan === "ya"){
                    return '<div class="text-center"><i class="iconStatus far fa-check-circle font-14 text-success" title="Diterima"></i>
                    <div class="custom-checkbox"><input type="checkbox" class="custom-control-input"
                    id="cbTerima'.$data->id.'" name="nmTerima[]" checked value="'.$data->id.'" >
                    <label for="cbTerima'.$data->id.'" class="ubahCheckbox custom-control-label font-14 font-weight-500 align-top text-primary" 
                    style="cursor:pointer;display:none;"></label>
                    </div>
                    </div>';
                }
                else{
                    return '<div class="text-center"><i class="iconStatus far fa-times-circle font-14 text-danger" title="Tidak Diterima"></i>
                    <div class="custom-checkbox"><input type="checkbox" class="custom-control-input"
                    id="cbTerima'.$data->id.'" name="nmTerima[]" value="'.$data->id.'" >
                    <label for="cbTerima'.$data->id.'" class="ubahCheckbox custom-control-label font-14 font-weight-500 align-top text-primary" 
                    style="cursor:pointer;display:none;"></label>
                    </div>
                    </div>';
                }
            })
            ->rawColumns(['nama', 'nik','jk', 'alamat', 'tgl_pendaftaran','no_pendaftaran','status_penerimaan'])
            ->toJson();
        }
    }
    
    public function penerimaan_detail($id)
    {
        $pelatihan = Pelatihan::find($id);
        list($provinsi) = $this->getProvinsi();
        list($pelatihan,  $kejuruan, $sub_kejuruan, $sumber_dana, $metode) = $this->firstData($id);
        return view('sistem.pelatihan.penerimaan.detail', [
            'pelatihan' => $pelatihan, 
            'kejuruan' => $kejuruan,
            'sub_kejuruan' => $sub_kejuruan,
            'metode' => $metode,
            'sumber_dana' => $sumber_dana,
            'provinsi' => $provinsi,
        ]);
    }


    public function penerimaan_update(Request $request)
    {
        $id_pelatihan = $request->nmIdPelatihan;
        $id_terima = $request->nmTerima;
        
        $id_tolak = DB::table('pelatihan_line')->where('pelatihan_id', $id_pelatihan)
                ->whereNotIn('id', $id_terima)
                ->whereNull('delete_date')
                ->pluck('id');
        
        $id_tolak = arr::flatten($id_tolak);

        if($id_terima){
            $penerimaan =  DB::table('pelatihan_line')->whereIn('id', $id_terima)->update([
                'status_penerimaan' => 'ya'
            ]);
        }
        if($id_tolak){
            $penerimaan = DB::table('pelatihan_line')->whereIn('id', $id_tolak)->update([
                'status_penerimaan' => 'tidak'
            ]);
        }

        // Update Jumlah Penerimaan
        $pelatihan_id = $id_pelatihan;
        list($jumlah_peserta, $jumlah_l, $jumlah_p, $pelatihan) = $this->updateJumlahPenerimaan($pelatihan_id);
        
        return $penerimaan;
    }


    // Kelulusan


    public function updateJumlahKelulusan($pelatihan_id){

        $jumlah_lulus = DB::table('pelatihan_line')
                            ->where('pelatihan_id', $pelatihan_id)
                            ->where('status_lulus', 'ya')
                            ->whereNull('delete_date')
                            ->count();

        $jumlah_l = DB::table('pelatihan_line')->select('pelatihan_line.id')
                ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                ->where('pelatihan_line.status_lulus', 'ya')
                ->where('users_partner.jk', 'L')
                ->whereNull('pelatihan_line.delete_date')
                ->count();
        
        $jumlah_p = DB::table('pelatihan_line')->select('pelatihan_line.id')
                ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                ->where('pelatihan_line.status_lulus', 'ya')
                ->where('users_partner.jk', 'P')
                ->whereNull('pelatihan_line.delete_date')
                ->count();

        $pelatihan = Pelatihan::find($pelatihan_id);
        $pelatihan->jml_lulusan = $jumlah_lulus;
        $pelatihan->lulusan_l = $jumlah_l;
        $pelatihan->lulusan_p = $jumlah_p;
        $pelatihan->save();

        return [$jumlah_lulus, $jumlah_l, $jumlah_p, $pelatihan];
    }


    public function kelulusan_index_json(Request $request)
    {

        list($get_pelatihan) = $this->getPelatihan($request);
        $kelulusan = $get_pelatihan->whereIn('pelatihan.status_pelatihan', ['valid', 'selesai'])
                    ->orderBy('pelatihan.id', 'desc')->get();
                    
        if ($request->ajax()) {
            return Datatables::of($kelulusan)
            ->editColumn('name', function($data){
                return  '<a href="' . route('pelatihan_kelulusan_detail', $data->id) .'">
                        <u class="font-weight-bold font-15">' 
                        . $data->name . '</u></a><br><span class="font-13 font-weight-bold ">Kuota: </span>
                        <span class="text-ungu font-12 font-weight-bold">' . $data->kuota_peserta. ' Peserta</span>';
            })
            ->editColumn('tgl_mulai', function($data){
                return  '<div class=""><span class="font-13 font-weight-bold">Mulai: </span>
                            <span class="text-primary font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') .'</span><br><span class="font-13 font-weight-bold">Selesai: </span>
                            <span class="text-danger font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') .'</span></div>';
            })
            ->editColumn('kejuruan', function($data){
                return  '<span class="font-weight-bold font-14 text-dark">' . $data->sub_kejuruan . '</span><br>
                        <span class="font-13 font-weight-bold ">' . $data->kejuruan . '</span>';
            })
            ->editColumn('jumlah_peserta', function($data){
                return  '<div class="font-weight-bold text-dark font-15 text-center">'. $data->jml_peserta . '</u></div>';
            })
            ->editColumn('lulus', function($data){
                return  '<div class="font-weight-bold text-primary font-15 text-center">'. $data->jml_lulusan . '</u></div>';
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('pelatihan_kelulusan_detail', $data->id) . '" title="Detail Kelulusan">
                            <i class="fas fa-caret-right mr-2"></i>Detail Kelulusan</a>
                    <a class="dropdown-item"  href="' . route('pelatihan_penerimaan_detail', $data->id) . '" title="Detail Penerimaan">
                        <i class="fas fa-caret-right mr-2"></i>Detail Penerimaan</a>
                    <a class="dropdown-item"  href="' . route('pelatihan_detail', $data->id) . '" title="Detail Pelatihan"> 
                        <i class="fas fa-caret-right mr-2"></i>Detail Pelatihan</a>
                    </div>';
                
            })
            ->rawColumns(['name','tgl_mulai','kejuruan','jumlah_peserta','lulus','action'])
            ->toJson();
        }
    }

    public function kelulusan_index()
    {
        return view('sistem.pelatihan.kelulusan.index', [
        ]);
    }

    public function kelulusan_detail_json(Request $request){

        // Filter Peserta (Pendaftar yang sudah diterima)
        list($get_pendaftaran_detail) = $this->getPendaftaranDetail($request);
        $kelulusan_detail = $get_pendaftaran_detail->where('pelatihan_line.status_penerimaan', 'ya')->get();

        if ($request->ajax()) {
            return Datatables::of($kelulusan_detail)
            ->editColumn('nama', function($data) {
                return  '<div class="text-dark font-weight-500 font-14">'. $data->nama . '</div>';
            })
            ->editColumn('nik', function ($data){
                return ' <div class="text-dark font-14">' . $data->nik . '</div>';
            })
            ->editColumn('jk', function ($data){
                return ' <div class="text-dark font-14">' . $data->jk . '</div>';
            })
            ->editColumn('alamat', function ($data){
                return ' <div class="text-dark font-14">' . $data->alamat . '</div>';
            })
            ->editColumn('tgl_pendaftaran', function ($data){
                return ' <div class="text-dark font-14">' . $data->tgl_pendaftaran . '</div>';
            })
            ->editColumn('no_pendaftaran', function ($data){
                return ' <div class="text-dark font-14">' . $data->no_pendaftaran . '</div>';
            })
            ->editColumn('status_lulus', function ($data) {
                if($data->status_lulus === "ya"){
                    return '<div class="text-center"><i class="iconStatus far fa-check-circle font-14 text-success" title="Lulus"></i>
                    <div class="custom-checkbox"><input type="checkbox" class="custom-control-input"
                    id="cbTerima'.$data->id.'" name="nmLulus[]" checked value="'.$data->id.'" >
                    <label for="cbTerima'.$data->id.'" class="ubahCheckbox custom-control-label font-14 font-weight-500 align-top text-primary" 
                    style="cursor:pointer;display:none;"></label>
                    </div>
                    </div>';
                }
                else{
                    return '<div class="text-center"><i class="iconStatus far fa-times-circle font-14 text-danger" title="Tidak Lulus"></i>
                    <div class="custom-checkbox"><input type="checkbox" class="custom-control-input"
                    id="cbTerima'.$data->id.'" name="nmLulus[]" value="'.$data->id.'" >
                    <label for="cbTerima'.$data->id.'" class="ubahCheckbox custom-control-label font-14 font-weight-500 align-top text-primary" 
                    style="cursor:pointer;display:none;"></label>
                    </div>
                    </div>';
                }
            })
            ->rawColumns(['nama', 'nik','jk', 'alamat', 'tgl_pendaftaran','no_pendaftaran','status_lulus'])
            ->toJson();
        }
    }
    
    public function kelulusan_detail($id)
    {
        $pelatihan = Pelatihan::find($id);
        list($provinsi) = $this->getProvinsi();
        list($pelatihan,  $kejuruan, $sub_kejuruan, $sumber_dana, $metode) = $this->firstData($id);
        return view('sistem.pelatihan.kelulusan.detail', [
            'pelatihan' => $pelatihan, 
            'kejuruan' => $kejuruan,
            'sub_kejuruan' => $sub_kejuruan,
            'metode' => $metode,
            'sumber_dana' => $sumber_dana,
            'provinsi' => $provinsi,
        ]);
    }


    public function kelulusan_update(Request $request)
    {
        $id_pelatihan = $request->nmIdPelatihan;
        $id_lulus = $request->nmLulus;
        
        $id_tidak = DB::table('pelatihan_line')->where('pelatihan_id', $id_pelatihan)
                ->whereNotIn('id', $id_lulus)
                ->whereNull('delete_date')
                ->pluck('id');
        
        $id_tidak = arr::flatten($id_tidak);

        if($id_lulus){
            $kelulusan =  DB::table('pelatihan_line')->whereIn('id', $id_lulus)->update([
                'status_lulus' => 'ya'
            ]);
        }
        if($id_tidak){
            $kelulusan = DB::table('pelatihan_line')->whereIn('id', $id_tidak)->update([
                'status_lulus' => 'tidak'
            ]);
        }
        
        // Update Jumlah Kelulusan
        $pelatihan_id = $id_pelatihan;
        list($jumlah_lulus, $jumlah_l, $jumlah_p, $pelatihan) = $this->updateJumlahKelulusan($pelatihan_id);

        return $kelulusan;
    }

    // Sertifikasi

    public function updateDataSertifikasi($pelatihan_id){

        $jumlah = DB::table('pelatihan_line')->select(DB::raw(
                        'sum(case when pelatihan_line.status_ikut_sertifikasi = "ya" then 1 ELSE 0 end) AS sertifikasi,
                        sum(case when pelatihan_line.status_kompeten = "ya" then 1 ELSE 0 end) AS kompeten'))
                        ->where('pelatihan_id', $pelatihan_id)
                        ->where('status_ikut_sertifikasi', 'ya')
                        ->whereNull('delete_date')
                        ->first();

        $jumlah_l = DB::table('pelatihan_line')->select(DB::raw(
                    'sum(case when pelatihan_line.status_ikut_sertifikasi = "ya" then 1 ELSE 0 end) AS sertifikasi,
                    sum(case when pelatihan_line.status_kompeten = "ya" then 1 ELSE 0 end) AS kompeten'))
                ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                ->where('pelatihan_line.status_ikut_sertifikasi', 'ya')
                ->where('users_partner.jk', 'L')
                ->whereNull('pelatihan_line.delete_date')
                ->first();
        
        $jumlah_p = DB::table('pelatihan_line')->select(DB::raw(
                    'sum(case when pelatihan_line.status_ikut_sertifikasi = "ya" then 1 ELSE 0 end) AS sertifikasi,
                    sum(case when pelatihan_line.status_kompeten = "ya" then 1 ELSE 0 end) AS kompeten'))
                ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                ->where('pelatihan_line.status_ikut_sertifikasi', 'ya')
                ->where('users_partner.jk', 'P')
                ->whereNull('pelatihan_line.delete_date')
                ->first();

        $pelatihan = Pelatihan::find($pelatihan_id);
        $pelatihan->jml_peserta_sertifikasi = $jumlah->sertifikasi;
        $pelatihan->peserta_sertifikasi_l = $jumlah_l->sertifikasi;
        $pelatihan->peserta_sertifikasi_p = $jumlah_p->sertifikasi;
        $pelatihan->jml_lulusan_sertifikasi = $jumlah->kompeten;
        $pelatihan->lulusan_sertifikasi_l = $jumlah_l->kompeten;
        $pelatihan->lulusan_sertifikasi_p = $jumlah_p->kompeten;
        $pelatihan->save();

        return [$jumlah, $jumlah_l, $jumlah_p, $pelatihan];
    }

    public function sertifikasi_index_json(Request $request)
    {
        list($get_pelatihan) = $this->getPelatihan($request);
        $sertifikasi = $get_pelatihan->orderBy('pelatihan.id', 'desc')->get();

        if ($request->ajax()) {
            return Datatables::of($sertifikasi)
            ->editColumn('name', function($data){
                return  '<a href="' . route('pelatihan_sertifikasi_detail', $data->id) .'">
                        <u class="font-weight-bold font-15">' 
                        . $data->name . '</u></a><br><span class="font-13 font-weight-bold ">Peserta Pelatihan: </span>
                        <span class="text-ungu font-12 font-weight-bold">' . $data->jml_peserta. ' Orang</span>';
            })
            ->editColumn('tgl_mulai', function($data){
                return  '<div class=""><span class="font-13 font-weight-bold">Mulai: </span>
                            <span class="text-primary font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') .'</span><br><span class="font-13 font-weight-bold">Selesai: </span>
                            <span class="text-danger font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') .'</span></div>';
            })
            ->editColumn('kejuruan', function($data){
                return  '<span class="font-weight-bold font-14 text-dark">' . $data->sub_kejuruan . '</span><br>
                        <span class="font-13 font-weight-bold ">' . $data->kejuruan . '</span>';
            })
            ->editColumn('sertifikasi', function($data){
                return  '<div class="font-weight-bold text-dark font-14 text-center">'. $data->jml_peserta_sertifikasi . ' Peserta</div>';
            })
            ->editColumn('kompeten', function($data){
                return  '<div class="font-weight-bold text-primary font-14 text-center">'. $data->jml_lulusan_sertifikasi . ' Peserta</div>';
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('pelatihan_sertifikasi_detail', $data->id) . '" title="Detail Sertifikasi">
                            <i class="fas fa-caret-right mr-2"></i>Detail Sertifikasi</a>
                    <a class="dropdown-item"  href="' . route('pelatihan_kelulusan_detail', $data->id) . '" title="Detail Kelulusan">
                        <i class="fas fa-caret-right mr-2"></i>Detail Kelulusan</a>
                    <a class="dropdown-item"  href="' . route('pelatihan_detail', $data->id) . '" title="Detail Pelatihan"> 
                        <i class="fas fa-caret-right mr-2"></i>Detail Pelatihan</a>
                    </div>';
                
            })
            ->rawColumns(['name','tgl_mulai','kejuruan','sertifikasi','kompeten','action'])
            ->toJson();
        }
    }

    public function sertifikasi_index()
    {
        return view('sistem.pelatihan.sertifikasi.index', [
        ]);
    }

    public function sertifikasi_detail_json(Request $request){

        list($get_pendaftaran_detail) = $this->getPendaftaranDetail($request);
        $sertifikasi_detail = $get_pendaftaran_detail->where('pelatihan_line.status_penerimaan', 'ya')->get();

        if ($request->ajax()) {
            return Datatables::of($sertifikasi_detail)
            ->editColumn('nama', function($data) {
                return  '<div class="text-dark font-weight-500 font-14">'. $data->nama . '</div>';
            })
            ->editColumn('nik', function ($data){
                return ' <div class="text-dark font-14">' . $data->nik . '</div>';
            })
            ->editColumn('jk', function ($data){
                return ' <div class="text-dark font-14">' . $data->jk . '</div>';
            })
            ->editColumn('alamat', function ($data){
                return ' <div class="text-dark font-14">' . $data->alamat . '</div>';
            })
            ->editColumn('tgl_pendaftaran', function ($data){
                return ' <div class="text-dark font-14">' . $data->tgl_pendaftaran . '</div>';
            })
            ->editColumn('status_ikut_sertifikasi', function ($data) {
                if($data->status_ikut_sertifikasi === "ya"){
                    return '<div class="text-center"><i class="iconStatus far fa-check-circle font-14 text-success" title="Ikut Sertifikasi"></i>
                    <div class="custom-checkbox"><input type="checkbox" class="cbClassSertifikasi custom-control-input"
                    id="cbSertifikasi'.$data->id.'" name="nmSertifikasi[]" checked value="'.$data->id.'" >
                    <label for="cbSertifikasi'.$data->id.'" class="ubahCheckbox custom-control-label font-14 font-weight-500 align-top text-primary" 
                    style="cursor:pointer;display:none;"></label>
                    </div>
                    </div>';
                }
                else{
                    return '<div class="text-center"><i class="iconStatus far fa-times-circle font-14 text-danger" title="Tidak Ikut Sertifikasi"></i>
                    <div class="custom-checkbox"><input type="checkbox" class="cbClassSertifikasi custom-control-input"
                    id="cbSertifikasi'.$data->id.'" name="nmSertifikasi[]" value="'.$data->id.'" >
                    <label for="cbSertifikasi'.$data->id.'" class="ubahCheckbox custom-control-label font-14 font-weight-500 align-top text-primary" 
                    style="cursor:pointer;display:none;"></label>
                    </div>
                    </div>';
                }
            })
            ->editColumn('status_kompeten', function ($data) {
                if($data->status_kompeten === "ya"){
                    return '<div class="text-center"><i class="iconStatus far fa-check-circle font-14 text-success" title="Kompeten"></i>
                    <div class="custom-checkbox"><input type="checkbox" class="cbClassKompeten custom-control-input"
                    id="cbKompeten'.$data->id.'" name="nmKompeten[]" checked value="'.$data->id.'" >
                    <label for="cbKompeten'.$data->id.'" class="ubahCheckbox custom-control-label font-14 font-weight-500 align-top text-primary" 
                    style="cursor:pointer;display:none;"></label>
                    </div>
                    </div>';
                }
                else{
                    return '<div class="text-center"><i class="iconStatus far fa-times-circle font-14 text-danger" title="Tidak Kompeten"></i>
                    <div class="custom-checkbox"><input type="checkbox" class="cbClassKompeten custom-control-input"
                    id="cbKompeten'.$data->id.'" name="nmKompeten[]" value="'.$data->id.'" >
                    <label for="cbKompeten'.$data->id.'" class="ubahCheckbox custom-control-label font-14 font-weight-500 align-top text-primary" 
                    style="cursor:pointer;display:none;"></label>
                    </div>
                    </div>';
                }
            })
            ->rawColumns(['nama', 'nik','jk', 'alamat', 'tgl_pendaftaran','status_ikut_sertifikasi','status_kompeten'])
            ->toJson();
        }
    }
    
    public function sertifikasi_detail($id)
    {
        $pelatihan = Pelatihan::find($id);
        list($lsp) = $this->getLSP();
        list($provinsi) = $this->getProvinsi();
        list($pelatihan,  $kejuruan, $sub_kejuruan, $sumber_dana, $metode) = $this->firstData($id);

      
        return view('sistem.pelatihan.sertifikasi.detail', [
            'pelatihan' => $pelatihan, 
            'kejuruan' => $kejuruan,
            'sub_kejuruan' => $sub_kejuruan,
            'metode' => $metode,
            'sumber_dana' => $sumber_dana,
            'provinsi' => $provinsi,
            'lsp' => $lsp,
        ]);
    }


    public function sertifikasi_update(Request $request)
    {

        return DB::transaction(function () use ($request) {

            $id_pelatihan = $request->nmIdPelatihan;
            $id_sertifikasi = $request->nmSertifikasi;
            $id_kompeten = $request->nmKompeten;
            
            // Update Pelatihan
            $updatePelatihan = Pelatihan::find($id_pelatihan);
            $id_mix = explode("|", $request->nmLSP);
            $updatePelatihan->tgl_sertifikasi = $request->nmTglSertifikasi;
            $updatePelatihan->lsp_id = $id_mix[0];
            $updatePelatihan->nama_lsp = $id_mix[1];
            $updatePelatihan->nama_asesor = $request->nmAsesor;
            $updatePelatihan->skema_uji = $request->nmSkemaUji;
            $updatePelatihan->save();

            // Pelatihan Line (Sertifikasi)
            $id_tidak_sertifikasi = DB::table('pelatihan_line')->where('pelatihan_id', $id_pelatihan)
                    ->whereNotIn('id', $id_sertifikasi)
                    ->whereNull('delete_date')
                    ->pluck('id');
            
            $id_tidak_sertifikasi = arr::flatten($id_tidak_sertifikasi);


            $id_tidak_kompeten = DB::table('pelatihan_line')->where('pelatihan_id', $id_pelatihan)
                    ->whereNotIn('id', $id_kompeten)
                    ->whereNull('delete_date')
                    ->pluck('id');
            
            $id_tidak_kompeten = arr::flatten($id_tidak_kompeten);

            if($id_sertifikasi){
                $sertifikasi =  DB::table('pelatihan_line')->whereIn('id', $id_sertifikasi)->update([
                    'status_ikut_sertifikasi' => 'ya'
                ]);
            }
            if($id_tidak_sertifikasi){
                $sertifikasi = DB::table('pelatihan_line')->whereIn('id', $id_tidak_sertifikasi)->update([
                    'status_ikut_sertifikasi' => 'tidak'
                ]);
            }

            if($id_kompeten){
                $sertifikasi =  DB::table('pelatihan_line')->whereIn('id', $id_kompeten)->update([
                    'status_kompeten' => 'ya'
                ]);
            }
            if($id_tidak_kompeten){
                $sertifikasi = DB::table('pelatihan_line')->whereIn('id', $id_tidak_kompeten)->update([
                    'status_kompeten' => 'tidak'
                ]);
            }

            // Update Detail Sertifikasi
            $pelatihan_id = $id_pelatihan;
            list($jumlah, $jumlah_l, $jumlah_p, $pelatihan) = $this->updateDataSertifikasi($pelatihan_id);
            

            return [$updatePelatihan, $sertifikasi];
        });
    }

    // Penempatan

    public function updateDataPenempatan($pelatihan_id){

        $jumlah_perusahaan = DB::table('pelatihan_line')
                        ->where('pelatihan_id', $pelatihan_id)
                        ->whereNotNull('perusahaan_penempatan')
                        ->whereNull('delete_date')
                        ->count();
                        
        $jumlah_l = DB::table('pelatihan_line')
                        ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                        ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                        ->whereNotNull('pelatihan_line.perusahaan_penempatan')
                        ->whereNull('pelatihan_line.delete_date')
                        ->where('users_partner.jk', 'L')
                        ->count();

        $jumlah_p = DB::table('pelatihan_line')
                        ->join('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                        ->where('pelatihan_line.pelatihan_id', $pelatihan_id)
                        ->whereNotNull('pelatihan_line.perusahaan_penempatan')
                        ->whereNull('pelatihan_line.delete_date')
                        ->where('users_partner.jk', 'P')
                        ->count();

        $jumlah_informal = DB::table('pelatihan_line')
                        ->where('pelatihan_id', $pelatihan_id)
                        ->where('jenis_penempatan', 'informal')
                        ->whereNull('delete_date')
                        ->count();
        
        $jumlah_formal = DB::table('pelatihan_line')
                        ->where('pelatihan_id', $pelatihan_id)
                        ->where('jenis_penempatan', 'formal')
                        ->whereNull('delete_date')
                        ->count();

        $pelatihan = Pelatihan::find($pelatihan_id);
        $pelatihan->jml_penempatan = $jumlah_perusahaan;
        $pelatihan->penempatan_l = $jumlah_l;
        $pelatihan->penempatan_p = $jumlah_p;
        $pelatihan->jml_penempatan_informal = $jumlah_informal;
        $pelatihan->jml_penempatan_formal = $jumlah_formal;
        $pelatihan->save();

        return [$jumlah_perusahaan, $jumlah_l, $jumlah_p, $jumlah_informal, $jumlah_formal, $pelatihan];
    }

    public function penempatan_index_json(Request $request)
    {
        list($get_pelatihan) = $this->getPelatihan($request);
        $penempatan = $get_pelatihan->whereIn('pelatihan.status_pelatihan',['valid','selesai'])
                        ->where('pelatihan.jml_pendaftar', '>', 0)
                        ->orderBy('pelatihan.id', 'desc')
                        ->get();

        if ($request->ajax()) {
            return Datatables::of($penempatan)
            ->editColumn('name', function($data){
                return  '<a href="' . route('pelatihan_penempatan_detail', $data->id) .'">
                        <u class="font-weight-bold font-15">' 
                        . $data->name . '</u></a><br><span class="font-13 font-weight-bold ">Peserta: </span>
                        <span class="text-ungu font-12 font-weight-bold">' . $data->jml_peserta . 
                            ' Orang / ' . $data->peserta_l . ' L, '. $data->peserta_p . ' P</span>';
            })
            ->editColumn('kejuruan', function($data){
                return  '<span class="font-weight-bold font-14 text-dark">' . $data->sub_kejuruan . '</span><br>
                        <span class="font-13 font-weight-bold ">' . $data->kejuruan . '</span>';
            })
            ->editColumn('tgl_mulai', function($data){
                return  '<div class=""><span class="font-13 font-weight-bold">Mulai: </span>
                            <span class="text-primary font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') .'</span><br><span class="font-13 font-weight-bold">Selesai: </span>
                            <span class="text-danger font-12 font-weight-bold">'
                            . \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') .'</span></div>';
            })
            ->editColumn('kompeten', function($data){
                return  '<div class="font-weight-bold font-13">'. 'Tanggal: '
                        . '<span class="text-ungu">' . $data->tgl_sertifikasi . '</span><br>Lulus: '. 
                            '<span class="text-ungu">' . $data->jml_lulusan_sertifikasi . ' Peserta</div>';
            })
            ->editColumn('penempatan', function($data){
                return  '<div class="font-weight-bold text-dark font-15 text-center">'. $data->jml_penempatan . ' Peserta</div>';
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('pelatihan_penempatan_detail', $data->id) . '" title="Detail Penempatan">
                            <i class="fas fa-caret-right mr-2"></i>Detail Penempatan</a>
                    <a class="dropdown-item"  href="' . route('pelatihan_sertifikasi_detail', $data->id) . '" title="Detail Sertifikasi">
                        <i class="fas fa-caret-right mr-2"></i>Detail Sertifikasi</a>
                    <a class="dropdown-item"  href="' . route('pelatihan_detail', $data->id) . '" title="Detail Pelatihan"> 
                        <i class="fas fa-caret-right mr-2"></i>Detail Pelatihan</a>
                    </div>';
                
            })
            ->rawColumns(['name','tgl_mulai','kejuruan','penempatan','kompeten','action'])
            ->toJson();
        }
    }

    public function penempatan_index()
    {
        return view('sistem.pelatihan.penempatan.index', [
        ]);
    }

    public function penempatan_detail(Request $request, $id)
    {
        $pelatihan = Pelatihan::find($id);
        
        list($lsp) = $this->getLSP();
        list($perusahaan) = $this->getPerusahaan();
        list($provinsi) = $this->getProvinsi();
        list($pelatihan,  $kejuruan, $sub_kejuruan, $sumber_dana, $metode) = $this->firstData($id);

        $penempatan_detail = DB::table('pelatihan_line')->select('pelatihan_line.*',
                    'users_partner.name as nama', 'users_partner.alamat', 
                    'users_partner.nik', 'users_partner.jk', 'users_partner.tgl_lahir', 
                    'users_partner.email', 'users_partner.kontak', 'pmi_perusahaan.nama as perusahaan')
                    ->leftjoin('users_partner', 'users_partner.id', '=', 'pelatihan_line.users_partner_id')
                    ->leftjoin('pmi_perusahaan', 'pmi_perusahaan.id', '=', 'pelatihan_line.perusahaan_penempatan')
                    ->where('pelatihan_id', $id)
                    ->where('pelatihan_line.status_penerimaan', 'ya')
                    ->whereNull('pelatihan_line.delete_date')
                    ->get();

        return view('sistem.pelatihan.penempatan.detail', [
            'pelatihan' => $pelatihan, 
            'kejuruan' => $kejuruan,
            'sub_kejuruan' => $sub_kejuruan,
            'metode' => $metode,
            'sumber_dana' => $sumber_dana,
            'provinsi' => $provinsi,
            'lsp' => $lsp,
            'perusahaan' => $perusahaan,
            'penempatan_detail' => $penempatan_detail,
        ]);
    }


    public function penempatan_update(Request $request)
    {

        return DB::transaction(function () use ($request) {

            $id = $request->nmIDline;
            $tgl_penempatan = $request->nmTglPenempatan;
            $perusahaan = $request->nmPerusahaan;
            $jenis = $request->nmJenisPenempatan;

            // dd($perusahaan);
            // Update Pelatihan Line (Penempatan)

            if($id !== null){   
                foreach ($id as $x => $value) {
                    DB::table('pelatihan_line')->where('id', $value)->update(
                        [
                            'tgl_penempatan' => $tgl_penempatan[$x],
                            'perusahaan_penempatan' => $perusahaan[$x],
                            'jenis_penempatan' => $jenis[$x],
                        ]
                    );
                }
            }


            // Update Detail Sertifikasi
            $pelatihan_id = $request->nmIDpelatihan;
            list($jumlah_perusahaan, $jumlah_l, $jumlah_p, $jumlah_informal, $jumlah_formal, $pelatihan) = $this->updateDataPenempatan($pelatihan_id);
            

            return redirect()->back()->with('sweetSuccess', '');
        });
    }

}