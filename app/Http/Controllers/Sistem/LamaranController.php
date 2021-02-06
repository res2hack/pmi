<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lamaran as Lamaran;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\UsersPartner as UsersPartner;


class LamaranController extends Controller
{

    public function index_json(Request $request)
    {
        $lamaran = DB::table('pmi_sip_lamaran')->select('pmi_sip_lamaran.*', 
                            'users_partner.name', 'users_partner.jk'
                            , 'users_partner.tgl_lahir', 'pmi_pendidikan.nama as pendidikan', )
                    ->leftjoin('users_partner', 'users_partner.id', '=', 'pmi_sip_lamaran.user_partner_id')
                    ->leftjoin('pmi_pendidikan', 'pmi_pendidikan.id', '=', 'pmi_sip_lamaran.pendidikan_id')
                    ->where('pmi_sip_lamaran.sip_id', $request->nmLowongan)
                    ->orderBy('pmi_sip_lamaran.id', 'desc')
                    ->get();

        if ($request->ajax()) {
            return Datatables::of($lamaran)
            ->editColumn('name', function($data){
                return  '<a class="" href="' . route('lamaran_detail', $data->id) .'">
                        <span class="font-weight-bold font-15"><u>' 
                        . $data->name . '</u></span><br>
                        <span class="font-13 font-weight-bold"><span class="text-danger">' . $data->jk . '</span> 
                                <span class="text-dark"> - '. \Carbon\Carbon::parse($data->tgl_lahir)->format('d-m-Y'). '</span></a>';
            })
            ->editColumn('pendidikan', function($data){
                return  '<span class="font-weight-bold font-13 text-dark">' . $data->pendidikan . '</span><br>
                        <span class="font-13 font-weight-bold ">' . $data->jurusan . '</span>';
            })
            ->editColumn('tgl_registrasi', function($data){
                if($data->tgl_registrasi)
                {
                    return  '<span class="font-13 font-weight-bold text-dark">' . \Carbon\Carbon::parse($data->tgl_registrasi)->format('d-m-Y') . '</span>';
                }
                else{
                    return  '<span class="font-13 font-weight-bold text-dark">-</span>';
                }
            
            })
            ->editColumn('syarat_kompetensi', function($data){
                if($data->syarat_kompetensi == "Y")
                {
                    return  '<div class="text-center"><i class="far fa-check-circle font-13 text-success"></i>
                            <span class="ml-1 text-dark font-weight-500">Ya</span></div>';
                }else{
                    return  '<div class="text-center"><i class="far fa-times-circle font-13 text-danger"></i>
                            <span class="ml-1 font-weight-500">Tidak</span></div>';
                }
                
            })
            ->editColumn('syarat_sehat', function($data){
                if($data->syarat_sehat == "Y")
                {
                    return  '<div class="text-center"><i class="far fa-check-circle font-13 text-success"></i>
                            <span class="ml-1 text-dark font-weight-500">Ya</span></div>';
                }else{
                    return  '<div class="text-center"><i class="far fa-times-circle font-13 text-danger"></i>
                            <span class="ml-1 font-weight-500">Tidak</span></div>';
                }
                
            })
            ->editColumn('syarat_dokumen', function($data){
                if($data->syarat_dokumen == "Y")
                {
                    return  '<div class="text-center"><i class="far fa-check-circle font-13 text-success"></i>
                            <span class="ml-1 text-dark font-weight-500">Ya</span></div>';
                }else{
                    return  '<div class="text-center"><i class="far fa-times-circle font-13 text-danger"></i>
                            <span class="ml-1 font-weight-500">Tidak</span>';
                }
                
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('lamaran_edit',  $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['name','pendidikan','tgl_registrasi','syarat_kompetensi', 
                        'syarat_sehat', 'syarat_dokumen', 'action'])
            ->toJson();
        }
    }
    
    public function index()
    {
        list($lowongan) = $this->getLowongan();
        return view('sistem.lamaran.index', [
            'lowongan' => $lowongan,
        ]);
    }

    public function getProvinsi(){
        $provinsi = DB::table('pmi_provinsi')->get();
        return [$provinsi];
    }
    public function getKabupaten(Request $request){
        $kabkota = DB::table('pmi_kabupaten')->select('id', 'nama')
                    ->where('provinsi_id', $request->nmProvinsi)->get();
        return json_encode($kabkota);
    }
    public function getKecamatan(Request $request){
        $kecamatan = DB::table('pmi_kecamatan')
                ->where('kabupaten_id', $request->nmKabKota)->get();
        return json_encode($kecamatan);
    }
    public function getAgama(){
        $agama = DB::table('pmi_agama')->get();
        return [$agama];
    }
    public function getPendidikan(){
        $pendidikan = DB::table('pmi_pendidikan')->where('levels', 'G')
                    ->where('kode', '<>', 4000)->get();
        return [$pendidikan];
    }
    public function getLowongan(){
        $lowongan = DB::table('pmi_sip')->select('pmi_sip.id', 'pmi_sip.agency', 
                            'pmi_jabatan.nama as jabatan', 'pmi_negara.negara')
                    ->join('pmi_jabatan', 'pmi_jabatan.id', '=', 'pmi_sip.jabatan_id')
                    ->join('pmi_negara', 'pmi_negara.id', '=', 'pmi_sip.negara_id')
                    ->where('tgl_ijin_akhir', '>=', date('Y-m-d'))
                    ->get();
                    
        return [$lowongan];
    }
    public function create()
    {
        list($provinsi) = $this->getProvinsi();
        list($agama) = $this->getAgama();
        list($pendidikan) = $this->getPendidikan();
        list($lowongan) = $this->getLowongan();
        return view('sistem.lamaran.create',[
            'provinsi' => $provinsi,
            'agama' => $agama,
            'pendidikan' => $pendidikan,
            'lowongan' => $lowongan,
        ]);
    }

    public function saveData(Request $request)
    {
        // $this->validate($request, 
        // ['nmPelamar' => 'required'],
        // ['nmlamaran.required' => '* Nama harus diisi']
        // );

        $user = Auth::user();

        $tipe = $request->nmTipe;

        $id_partner = null;
        $cek_id_partner = explode("|", $request->nmPenduduk);
        if($cek_id_partner){
            $id_partner = $cek_id_partner[0];
        }
        

        if($tipe == "create"){
            $lamaran = new Lamaran();
            $lamaran->create_uid = $user->id;
            $lamaran->create_date = now();

            // cek apakah pelamar sudah terdaftar penduduk
            $tipe_partner = $request->nmTipePelamar;
            if($tipe_partner == "exists"){
                $partner = UsersPartner::find($id_partner);
            }
            else{
                $partner = new UsersPartner();
                $partner->name = $request->nmPelamar;
                
                $userLogin = new User();
            }
            
        }
        else{
            $lamaran = Lamaran::find($request->nmID);
            $partner = UsersPartner::find($lamaran->user_partner_id);
            $lamaran->write_uid = $user->id;
            $lamaran->write_date = now();
        }

        // Lamaran (pmi_sip_lamaran)
        $lamaran->sip_id = $request->nmLowongan;
        $lamaran->user_partner_id = $id_partner;
        $lamaran->tgl_registrasi = $request->nmTglRegistrasi;
        $lamaran->pendidikan_id = $request->nmPendidikan;
        $lamaran->jurusan = $request->nmJurusan;
        $lamaran->keterangan = $request->nmKeterangan;
        if(isset($request->nmKompetensi)){
            $lamaran->syarat_kompetensi = 'Y';
        }
        if(isset($request->nmSehat)){
            $lamaran->syarat_sehat = 'Y';
        }
        if(isset($request->nmDokumen)){
            $lamaran->syarat_dokumen = 'Y';
            
        }

        $folder_foto =  public_path().'/uploads/file/pmi/foto/';
        $folder_cv =  public_path().'/uploads/file/pmi/cv/';

        if (! File::exists($folder_foto)) {
            File::makeDirectory($folder_foto, 0777,true);
        }
        if (! File::exists($folder_cv)) {
            File::makeDirectory($folder_cv, 0777,true);
        }

        $foto_lama = $lamaran->foto;
        $cv_lama = $lamaran->cv;
        if($request->hasFile('nmFoto')){

            $foto = $request->file('nmFoto');
            $filename_foto = uniqid() . '.' . $foto->getClientOriginalExtension();
            $filepath_foto = "uploads/file/pmi/foto"; 
            $foto->move($filepath_foto, $filename_foto);

            // Simpan di lamaran juga user partner
            $lamaran->foto = $filepath_foto . '/' . $filename_foto;
            $partner->foto = $filepath_foto . '/' . $filename_foto;
        }

        if($request->hasFile('nmCV')){

            $cv = $request->file('nmCV');
            $filename_cv = uniqid() . '.' . $cv->getClientOriginalExtension();
            $filepath_cv = "uploads/file/pmi/cv"; 
            $cv->move($filepath_cv, $filename_cv);

            // Simpan di lamaran juga user partner
            $lamaran->cv = $filepath_cv . '/' . $filename_cv;
            $partner->cv = $filepath_cv . '/' . $filename_cv;
        }

        if($tipe == "edit"){
            // jika hapus foto
            if(($request->statusFoto == "0" || $request->statusFoto !== "0") && $request->hasFile('nmFoto'))
            {
                File::delete($foto_lama);
                // $lamaran->foto = $filepath_foto . '/' . $filename_foto;
            }
            if($request->statusFoto !== "0" && !$request->hasFile('nmFoto')){
                $lamaran->foto = null;
                File::delete($request->statusFoto);
            }

            if(($request->statusCV == "0" || $request->statusCV !== "0") && $request->hasFile('nmCV'))
            {
                File::delete($cv_lama);
                // $lamaran->cv = $filepath_cv . '/' . $filename_cv;
            }

            if($request->statusCV !== "0" && !$request->hasFile('nmCV')){
                $lamaran->cv = null;
                File::delete($request->statusCV);
            }

        }

        if(isset($request->nmBeriLogin) && !$id_partner){

            $userLogin->name = $request->nmPelamar;
            $userLogin->tipe = 'user';
            $userLogin->username = $request->nmUsername;
            $userLogin->email = $request->nmEmailLogin;
            
            $userLogin->password = Hash::make($request->nmPassword);
            $userLogin->alamat = $request->nmAlamat;
            $userLogin->kontak = $request->nmKontak;
            $userLogin->sct = $request->nmPassword;
            $userLogin->status = $request->nmStatusAktif;
            $userLogin->save();

            DB::table('model_has_roles')->where('model_id', $lamaran->user_id)->delete();
            
            // Set Role sebagai User atau user
            $role_id = DB::table('roles')->where('name', 'User')
                        ->orWhere('name', 'user')->pluck('id')
                        ->first();

            $userLogin->assignRole($role_id);
            
            // partner user_id
            $partner->user_id = $userLogin->id;
        }
    
        //  Update Partner
       
        $partner->nik = $request->nmNIK;
        $partner->bpjs = $request->nmBPJS;
        $partner->jk = $request->nmJK;
        $partner->tgl_lahir = $request->nmTglLahir;
        $partner->kontak = $request->nmKontak;
        $partner->email = $request->nmEmail;
        $partner->alamat = $request->nmAlamat;
        $partner->provinsi_id = $request->nmProvinsi;
        $partner->kabupaten_id = $request->nmKabKota;
        $partner->kecamatan_id = $request->nmKecamatan;
        $partner->agama_id = $request->nmAgama;
        $partner->pendidikan_id = $request->nmPendidikan;
        $partner->save();

        $lamaran->user_partner_id = $partner->id;
        $lamaran->save();

        return [$lamaran];
    }

    public function store(Request $request)
    {
        list($lamaran) = $this->saveData($request);
        return redirect()->route('lamaran_detail', $lamaran)->with('success', 'Lamaran Berhasil Dikirim');
    }

    // Get Single Data (edit / detail)
    public function firstData($id){



        $lamaran_first = DB::table('pmi_sip_lamaran')->select('pmi_sip_lamaran.id as id_lamaran','pmi_sip_lamaran.sip_id',  
                    'pmi_sip_lamaran.user_partner_id', 'pmi_sip_lamaran.tgl_registrasi',
                    'pmi_sip_lamaran.pendidikan_id as pendidikan_lamaran',  'pmi_sip_lamaran.jurusan',
                    'pmi_sip_lamaran.foto as foto_lamaran', 'pmi_sip_lamaran.cv as cv_lamaran',
                    'pmi_sip_lamaran.syarat_kompetensi',  'pmi_sip_lamaran.syarat_sehat',
                    'pmi_sip_lamaran.syarat_dokumen', 'pmi_sip_lamaran.keterangan as keterangan_lamaran',
                    'users_partner.*')
                    ->leftjoin('users_partner', 'users_partner.id', '=', 'pmi_sip_lamaran.user_partner_id')
                    ->where('pmi_sip_lamaran.id', $id)
                    ->orderBy('pmi_sip_lamaran.id', 'desc')
                    ->first();
        
        $jabatan_first = '';
        $perusahaan_first = '';
        $negara_first = '';
        $pendidikan_first = '';
        $agama_first = '';
        $provinsi_first = '';
        $kabupaten_first = '';
        $kecamatan_first = '';

        $sip_first = DB::table('pmi_sip')->where('id', $lamaran_first->sip_id)
                    ->first();
        if($sip_first){
            $jabatan_first = DB::table('pmi_jabatan')->where('id', $sip_first->jabatan_id)
                ->first();
            $perusahaan_first = DB::table('pmi_perusahaan')->where('id', $sip_first->perusahaan_id)
                ->first();
            $negara_first = DB::table('pmi_negara')->where('id', $sip_first->negara_id)
                ->pluck('negara')->first();
        }
        if($lamaran_first){
            $pendidikan_first = DB::table('pmi_pendidikan')->where('id', $lamaran_first->pendidikan_lamaran)
                        ->pluck('nama')->first();
            $agama_first = DB::table('pmi_agama')->where('id', $lamaran_first->agama_id)
                        ->pluck('nama')->first();

            $provinsi_first = DB::table('pmi_provinsi')->where('id', $lamaran_first->provinsi_id)
                        ->first();

            $kabupaten_first = DB::table('pmi_kabupaten')->where('id', $lamaran_first->kabupaten_id)
                        ->first();
            
            $kecamatan_first = DB::table('pmi_kecamatan')->where('id', $lamaran_first->kecamatan_id)
                        ->first();
        }
      

        return [$lamaran_first,  $sip_first, $jabatan_first, $pendidikan_first, $agama_first,
                $perusahaan_first, $provinsi_first, $kabupaten_first, $kecamatan_first, $negara_first];
    }

    public function edit($id)
    {
        // $lamaran = Lamaran::find($id);
        list($provinsi) = $this->getProvinsi();
        list($agama) = $this->getAgama();
        list($pendidikan) = $this->getPendidikan();
        list($lowongan) = $this->getLowongan();

        list($lamaran_first, $sip_first, $jabatan_first, $pendidikan_first, $agama_first, $perusahaan_first, 
                $provinsi_first, $kabupaten_first, $kecamatan_first, $negara_first) = $this->firstData($id);
        
        return view('sistem.lamaran.edit', [
            // 'lamaran' => $lamaran,
            'pendidikan' => $pendidikan,
            'provinsi' => $provinsi,
            'agama' => $agama,
            'lowongan' => $lowongan,
            'lamaran_first' => $lamaran_first,
            'sip_first' => $sip_first,
            'jabatan_first' => $jabatan_first,
            'perusahaan_first' => $perusahaan_first,
            'provinsi_first' => $provinsi_first,
            'agama_first' => $agama_first,
            'pendidikan_first' => $pendidikan_first,
            'kabupaten_first' => $kabupaten_first,
            'kecamatan_first' => $kecamatan_first,
            'negara_first' => $negara_first,
        ]);
    }
    public function detail($id)
    {
         list($lamaran_first, $sip_first, $jabatan_first, $pendidikan_first, $agama_first, $perusahaan_first, 
                $provinsi_first, $kabupaten_first, $kecamatan_first, $negara_first) = $this->firstData($id);
// dd($jabatan);
        return view('sistem.lamaran.detail', [
            'lamaran_first' => $lamaran_first,
            'sip_first' => $sip_first,
            'jabatan_first' => $jabatan_first,
            'perusahaan_first' => $perusahaan_first,
            'provinsi_first' => $provinsi_first,
            'agama_first' => $agama_first,
            'pendidikan_first' => $pendidikan_first,
            'kabupaten_first' => $kabupaten_first,
            'kecamatan_first' => $kecamatan_first,
            'negara_first' => $negara_first,
        ]);
    }
    public function update(Request $request)
    {
        list($lamaran) = $this->saveData($request);
        return redirect()->route('lamaran_detail', $lamaran)->with('success', 'Lamaran telah diperbarui');
    }

    public function delete(Request $request)
    {
        Lamaran::find($request->idDelete)->delete();
        return redirect()->route('lamaran_index')->with('success', 'Lamaran telah dihapus');
        
    }

}