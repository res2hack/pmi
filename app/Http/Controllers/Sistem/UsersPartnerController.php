<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Arr;
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

class UsersPartnerController extends Controller
{
    public function getProvinsi(){
        $provinsi = DB::table('pmi_provinsi')->get();
        return [$provinsi];
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
    public function getKabupaten(Request $request){
        $kabkota = DB::table('pmi_kabupaten')->select('id', 'nama')
                    ->where('provinsi_id', $request->nmProvinsi)->get();
        return json_encode($kabkota);
    }
    public function getKecamatan(Request $request){
        $kecamatan = DB::table('pmi_kecamatan')
                ->where('kabupaten_id', $request->nmKabupaten)->get();
        return json_encode($kecamatan);
    }

    public function index(){
        return view('sistem.penduduk.index');
    }

    public function index_json(Request $request){
        $partner = DB::table('users_partner')->orderByRaw('trim(name) asc')->get();

        if ($request->ajax()) {
            return Datatables::of($partner)
            ->editColumn('name', function($data) {
                if($data->tgl_lahir){
                    return  '<input id="idPerusahaan" type="hidden" value="' . $data->id . '"></input>
                        <a class="font-weight-bold font-14" href="' . route('partner_detail', $data->id) .'">'
                        . $data->name . '</a><br>
                        <span class="font-12 font-weight-bold text-dark">' . $data->jk . '</span>
                        <span class="font-12 font-weight-500 "><span class="mx-2">/</span>' . 
                        \Carbon\Carbon::parse($data->tgl_lahir)->format('d-m-Y') . '</span>';
                }else{
                    return  '<input id="idPerusahaan" type="hidden" value="' . $data->id . '"></input>
                        <a class="font-weight-bold font-14" href="' . route('partner_detail', $data->id) .'">'
                        . $data->name . '</a><br>
                        <span class="font-weight-500 font-12">' . $data->jk . '</span>
                        <span class="font-weight-500 font-12"><span class="mx-2">/</span-</span>';
                }
            })
            ->editColumn('nik', function ($data){
                return ' <span class="text-dark font-12"><span class="font-weight-bold">NIK:</span> ' . $data->nik . '</span><br>
                        <span class="text-dark font-12"><span class="font-weight-bold">BPJS:</span>' . $data->bpjs . '</span>';
            })
            ->editColumn('alamat', function($data){
                return ' <span class="text-dark">' . $data->alamat . '</span>';
            })
            ->editColumn('user_id', function($data){
                if($data->user_id){
                    return '<i class="font-18 far fa-check-circle text-success ml-2" title="Ya"></i>';
                }else{
                    return '<i class="font-18 far fa-times-circle text-danger ml-2" title="Tidak"></i>';
                }
            })
            ->editColumn('create_date', function($data){
                if($data->create_date){
                    return ' <span class="text-dark">' . \Carbon\Carbon::parse($data->create_date)->format('d-m-Y') . '</span>';
                }else{
                    return ' <span class="text-dark">-</span>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail/Ubah/Hapus">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('partner_detail', $data->id) . '"><i class="far fa-file-alt font-14 mr-2"></i> Detail</a>
                    <a class="dropdown-item text-primary" href="' . route('partner_edit', $data->id) . '"> <i class="fas fa-edit font-13 mr-2"></i>Ubah</a>
                    <a class="dropdown-item text-danger" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter" >
                    <i class="fas fa-times font-15 mr-2"></i> Hapus</a>
                </div>';
            })
            ->rawColumns(['name', 'nik', 'alamat', 'user_id','create_date', 'action'])
            ->toJson();
        }
    }

    // Untuk Select2 Pencarian Penduduk
    public function getPenduduk(Request $request){
        $search = $request->term;
        $penduduk = DB::table('users_partner')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('nik', 'like', '%' . $search . '%')
                ->orWhere('bpjs', 'like', '%' . $search . '%')
                ->get();

        $data_penduduk = [];

        foreach ($penduduk as $pdk) {
            $data_penduduk[] = ['id' => $pdk->id . "|" . $pdk->user_id, 'name' => $pdk->name, 'text' => "".$pdk->name."  <span class='mx-2'>&#8674;</span>  ".$pdk->jk . 
            "  <span class='mx-2'>&#8674;</span>  ". \Carbon\Carbon::parse($pdk->tgl_lahir)->format('d-m-Y') . "  <span class='mx-2'>&#8674;</span>  NIK:  ".$pdk->nik . "  <span class='mx-2'>&#8674;</span>  BPJS:  " . $pdk->bpjs];
        }
        return json_encode($data_penduduk);
    }

    public function cek_nik(Request $request){

        $nik = $request->nmNIK;
        $cek_nik = DB::table('users_partner')
                ->where('nik', $nik)
                ->pluck('id')
                ->first();

        return [$cek_nik];
    }

    public function cek_bpjs(Request $request){

        $bpjs = $request->nmBPJS;
        $cek_bpjs = DB::table('users_partner')
                ->where('bpjs', $bpjs)
                ->pluck('id')
                ->first();
                
        return [$cek_bpjs];
    }

    public function field(Request $request, $partner, $userLogin){
        $partner->name = $request->nmPartner;
        $partner->nik = $request->nmNIK;
        $partner->bpjs = $request->nmBPJS;
        $partner->jk = $request->nmJK;
        $partner->tgl_lahir = $request->nmTglLahir;
        $partner->tempat_lahir = $request->nmTempatLahir;
        $partner->pendidikan_id = $request->nmPendidikan;
        $partner->agama_id = $request->nmAgama;
        $partner->kontak = $request->nmKontak;
        $partner->email = $request->nmEmail;
        $partner->alamat = $request->nmAlamat;
        $partner->provinsi_id = $request->nmProvinsi;
        $partner->kabupaten_id = $request->nmKabupaten;
        $partner->kecamatan_id = $request->nmKecamatan;
        $partner->keterangan = $request->nmKeterangan;
        $partner->status_konsultasi = $request->nmStatusKonsultasi;
        $partner->status_pengaduan = $request->nmStatusPengaduan;
        $partner->status_lamaran = $request->nmStatusLamaran;
        $partner->status_pencaker = $request->nmStatusPencaker;

        if(isset($request->nmBeriLogin)){

            $userLogin->name = $partner->name;
            $userLogin->tipe = 'user';
            $userLogin->username = $request->nmUsername;
            $userLogin->email = $request->nmEmailLogin;
            
            $userLogin->password = Hash::make($request->nmPassword);
            $userLogin->alamat = $partner->alamat;
            $userLogin->kontak = $partner->kontak;
            $userLogin->sct = $request->nmPassword;
            $userLogin->status = $request->nmStatusAktif;
            $userLogin->save();

            DB::table('model_has_roles')->where('model_id', $partner->user_id)->delete();
            
            // Set Role sebagai User atau user
            $role_id = DB::table('roles')->where('name', 'User')
                        ->orWhere('name', 'user')->pluck('id')
                        ->first();

            $userLogin->assignRole($role_id);

            $partner->user_id = $userLogin->id;
        }
        else{
            $userLogin->delete();
            DB::table('model_has_roles')->where('model_id', $partner->user_id)->delete();
            $partner->user_id = null;
            $partner->status_konsultasi = 'tidak';
            $partner->status_pengaduan = 'tidak';
            $partner->status_lamaran = 'tidak';
            $partner->status_pencaker = 'tidak';
        }
        
        return [$partner, $userLogin];
    }

    // Khusus Create Baru Json
    public function store_json(Request $request){
        $user = Auth::user();
        $partner = new UsersPartner();
        list($partner) = $this->field($request, $partner);
        $partner->create_uid = $user->id;
        $partner->create_date = now();
        $partner->save();
        return $partner;
    }

    public function create()
    {
        list($provinsi) = $this->getProvinsi();
        list($agama) = $this->getAgama();
        list($pendidikan) = $this->getPendidikan();
        return view('sistem.penduduk.create', [
            'provinsi' => $provinsi,
            'agama' => $agama,
            'pendidikan' => $pendidikan,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $partner = new UsersPartner();
        $userLogin = new User();
        list($partner) = $this->field($request, $partner, $userLogin);
        $partner->create_uid = $user->id;
        $partner->create_date = now();
        $partner->save();
        return redirect()->route('partner_detail', $partner->id)->with('success', 'Data Penduduk Ditambahkan');
    }

    public function detail_json(Request $request)
    {
       
        $id_partner = explode("|", $request->nmPenduduk);
        $id = $id_partner[0];

        $partner = UsersPartner::find($id);
        return $partner;
    }

    public function detail($id)
    {
        $partner = UsersPartner::find($id);
        if($partner){
            $provinsi = DB::table('pmi_provinsi')->where('id', $partner->provinsi_id)->pluck('nama')->first();
            $kabupaten = DB::table('pmi_kabupaten')->where('id', $partner->kabupaten_id)->pluck('nama')->first();
        }
        else{
            $provinsi = '-';
            $kabupaten = '-';
        }
        $status_login = '';
        if($partner->user_id){
            $status_login = DB::table('users')->where('id', $partner->user_id)->pluck('status')->first();
        }

        return view('sistem.penduduk.detail', [
            'partner' => $partner,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'status_login' => $status_login,
        ]);

    }
    public function edit($id)
    {
        $partner = UsersPartner::find($id);
        list($provinsi) = $this->getProvinsi();
        list($agama) = $this->getAgama();
        list($pendidikan) = $this->getPendidikan();
        $user =  DB::table('users')->where('id', $partner->user_id)->first();
        return view('sistem.penduduk.edit', [
            'provinsi' => $provinsi,
            'agama' => $agama,
            'pendidikan' => $pendidikan,
            'partner' => $partner,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $partner = UsersPartner::find($id);

        $cek_user =  DB::table('users')->where('id', $partner->user_id)->first();

        $userLogin = User::find($partner->user_id);

        list($partner) = $this->field($request, $partner, $userLogin);

        $partner->write_uid = $user->id;
        $partner->write_date = now();
        $partner->save();
        
        return redirect()->route('partner_detail', $partner->id)->with('success', 'Data Penduduk Diperbarui');
    }
}