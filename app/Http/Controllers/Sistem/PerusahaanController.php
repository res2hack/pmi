<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perusahaan as Perusahaan;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;

use DataTables;

class PerusahaanController extends Controller
{

    public function getData()
    {
        $get_perusahaan = DB::table('pmi_perusahaan');

        return [$get_perusahaan];
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

    public function index(){

        return view('sistem.perusahaan.index');
    }

    public function index_json(Request $request)
    {
        list($get_perusahaan) = $this->getData();
        
        $perusahaan = $get_perusahaan->orderByRaw('trim(pmi_perusahaan.nama) asc')->get();

        if ($request->ajax()) {
            return Datatables::of($perusahaan)
            ->editColumn('nama', function($data) {
                return  '<input id="idPerusahaan" type="hidden" value="' . $data->id . '"></input>
                        <a class="font-weight-bold font-14" href="' . route('perusahaan_detail', $data->id) .'">'
                        . $data->nama . '</a><br>
                        <div class="font-weight-500 font-12">' . $data->alamat . ' </div>
                        <div class="font-weight-500 font-12">' . $data->contact_telp . ' </div>
                        <div class="font-weight-500 font-12">' . $data->email . ' </div>';
            })
            ->editColumn('contact_telp', function ($data){
                return ' <span class="text-dark">' . $data->contact_telp . '</span>';
            })
            ->editColumn('user_id', function($data){
                if($data->user_id){
                    return  '<div class="text-center">
                            <i class="font-18 far fa-check-circle text-success" 
                            title="Memiliki Hak Akses Login Sistem"></i></div>';
                }
                else{
                    return  '<div class="text-center">
                    <i class="font-18 far fa-times-circle text-danger" 
                    title="Tidak Memiliki Hak Akses Login Sistem"></i></div>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail/Ubah/Hapus">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('perusahaan_detail', $data->id) . '"><i class="far fa-file-alt font-14 mr-2"></i> Detail</a>
                    <a class="dropdown-item text-primary" href="' . route('perusahaan_edit', $data->id) . '"> <i class="fas fa-edit font-13 mr-2"></i>Ubah</a>
                    <a class="dropdown-item text-danger" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter" >
                    <i class="fas fa-times font-15 mr-2"></i> Hapus</a>
                </div>';
            })
            ->rawColumns(['nama', 'contact_telp', 'user_id','action'])
            ->toJson();
        }

    }
    public function create()
    {
        list($provinsi) = $this->getProvinsi();
        return view('sistem.perusahaan.create', [
            'provinsi' => $provinsi,
        ]);
    }

    public function saveData(Request $request)
    {

        return DB::transaction(function () use ($request) {

        $user = Auth::user();

        $this->validate($request, 
        ['nmPerusahaan' => 'required'],
        ['nmPerusahaan.required' => '* No. SIP harus diisi']
        );

        if($request->nmTipe == "create"){
            // Baru
            $perusahaan = new Perusahaan();
            $perusahaan->create_uid = $user->id;
            $perusahaan->create_date = now();
            $cek_user = null;
            $userLogin = new User();
        }
        else{
            // Update
            $perusahaan = Perusahaan::find($request->idPerusahaan);
            $perusahaan->write_uid = $user->id;
            $perusahaan->write_date = now();
            $cek_user =  DB::table('users')->where('id', $perusahaan->user_id)->first();

            if($cek_user !== null){
                $userLogin = User::find($perusahaan->user_id);
            }else{
                $userLogin = new User();
            }
            
        }

        
        if(isset($request->nmBeriLogin)){

                $userLogin->name = $request->nmPerusahaan;
                $userLogin->tipe = 'perusahaan';
                $userLogin->username = $request->nmUsername;

                if($request->nmEmailLogin){
                    $userLogin->email = $request->nmEmailLogin;
                }
                else{
                    $userLogin->email = $request->nmEmail;
                }
                
                $userLogin->password = Hash::make($request->nmPassword);
                $userLogin->alamat = $request->nmAlamat;
                $userLogin->kontak = $request->nmTelp;
                $userLogin->sct = $request->nmPassword;
                $userLogin->status = $request->nmStatusAktif;
                $userLogin->save();

                DB::table('model_has_roles')->where('model_id', $perusahaan->user_id)->delete();
                
                // Set Role sebagai User atau user
                $role_id = DB::table('roles')->where('name', 'Perusahaan')
                ->orWhere('name', 'perusahaan')->pluck('id')
                ->first();

                $userLogin->assignRole($role_id);

                $perusahaan->user_id = $userLogin->id;
        }
        else{
            $userLogin->delete();
            DB::table('model_has_roles')->where('model_id', $perusahaan->user_id)->delete();
            $perusahaan->user_id = null;
        }

        $perusahaan->nama = $request->nmPerusahaan;
        $perusahaan->provinsi_id = $request->nmProvinsi;
        $perusahaan->kabkota_id = $request->nmKabKota;
        $perusahaan->kecamatan_id = $request->nmKecamatan;
        $perusahaan->alamat = $request->nmAlamat;
        $perusahaan->contact_nama = $request->nmCP;
        $perusahaan->contact_telp = $request->nmTelp;
        $perusahaan->contact_wa = $request->nmWhatsapp;
        $perusahaan->email = $request->nmEmail;

        $profil = $request->nmProfil;

        if($profil){
            $dom = new \DomDocument();
            $profil_filter = str_replace("\0", '', $profil);

            @$dom->loadHtml($profil_filter, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);  

            $profil_filter = $dom->saveHTML();
            $perusahaan->profil = $profil_filter;
        }
        else{
            $perusahaan->profil = null;
        }
        
        $perusahaan->save();

        return [$perusahaan];

        });

    }

    public function store(Request $request)
    {
        list($perusahaan) = $this->saveData($request);
        return redirect()->route('perusahaan_edit', $perusahaan->id)->with('success', 'Perusahaan Baru Telah Ditambahkan');
    }

    public function update(Request $request)
    {
        list($perusahaan) = $this->saveData($request);
        return redirect()->route('perusahaan_detail', $perusahaan->id)->with('success', 'Data Telah Diperbarui');
    }

    public function detail($id)
    {
        list($get_perusahaan) = $this->getData();
        $perusahaan = $get_perusahaan->where('pmi_perusahaan.id', $id)->first();
        if($perusahaan){
            $provinsi = DB::table('pmi_provinsi')->where('id', $perusahaan->provinsi_id)->pluck('nama')->first();
            $kabupaten = DB::table('pmi_kabupaten')->where('id', $perusahaan->kabkota_id)->pluck('nama')->first();
        }
        else{
            $provinsi = '-';
            $kabupaten = '-';
        }
        $status_login = '';
        if($perusahaan->user_id){
            $status_login = DB::table('users')->where('id', $perusahaan->user_id)->pluck('status')->first();
        }
        $sip = DB::table('pmi_sip')->select('pmi_sip.*',
                    'pmi_jabatan.nama as jabatan', 'pmi_negara.negara as negara')
                    ->leftjoin('pmi_jabatan', 'pmi_jabatan.id', '=', 'pmi_sip.jabatan_id')
                    ->leftjoin('pmi_negara', 'pmi_negara.id', '=', 'pmi_sip.negara_id')
                    ->where('perusahaan_id', $id)
                    ->orderBy('pmi_sip.id', 'desc')
                    ->limit(50)
                    ->get();

        return view('sistem.perusahaan.detail', [
            'perusahaan' => $perusahaan,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'sip' => $sip,
            'status_login' => $status_login,
        ]);

    }

    public function edit($id)
    {
        list($get_perusahaan) = $this->getData();
        list($provinsi) = $this->getProvinsi();

        $perusahaan = $get_perusahaan->where('pmi_perusahaan.id', $id)->first();

        $user =  DB::table('users')->where('id', $perusahaan->user_id)->first();
        
        // $user_roles = DB::table('model_has_roles')->where('model_id', $perusahaan->user_id)->pluck('role_id');
        // $user_roles = arr::flatten($user_roles);

        // $role = Role::where('name', '<>' ,'superadmin')->get();

        return view('sistem.perusahaan.edit', [
            'perusahaan' => $perusahaan,
            'provinsi' => $provinsi,
            'user' => $user,
            // 'user_roles' => $user_roles,
            // 'role' => $role,
        ]);
    }

    public function delete(Request $request)
    {
        $persuahaan = Perusahaan::find($request->idDelete);
        $persuahaan->delete();
        return redirect()->route('persuahaan_index')->with('success', 'Data Telah Dihapus Permanen');
    }

}