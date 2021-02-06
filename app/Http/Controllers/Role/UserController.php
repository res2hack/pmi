<?php

namespace App\Http\Controllers\Role;
use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Arr;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('tipe', ['superadmin','admin'])->get();
        $roles = DB::table('roles')->select('roles.*', 'model_has_roles.*')
                ->join('model_has_roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->where('name', '<>' ,'superadmin')
                ->get();

        return view('users.user.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function cek_username(Request $request)
    {
        $cek_username = User::where('username', $request->nmUsername)->pluck('username')->first();
        return json_encode($cek_username);
    }

    public function cek_email(Request $request)
    {
        $cek_email = User::where('email', $request->nmEmail)->pluck('email')->first();
        return json_encode($cek_email);
    }

    public function create()
    {
    
        $role = Role::get();
        return view('users.user.create', [
        
            'role' => $role,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $user = User::whereNotIn('tipe', ['superadmin','admin'])->find($id);

        $user_roles = DB::table('model_has_roles')->where('model_id', $id)->pluck('role_id');
        $user_roles = arr::flatten($user_roles);
        $role = DB::table('roles')->select('id', 'name', 'deskripsi')
                ->where('name', '<>' ,'superadmin')
                ->get();
    
        return view('users.user.edit', [
            'user' => $user,
            'user_roles' => $user_roles,
            'role' => $role,
        ]);
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $this->validate(request(), [
                'nmNamaLengkap' => 'required',
                'Email' => 'required|email',
                'password' => 'required|confirmed',
            ]);

            $user = new User();
            $user->name = $request->nmNamaLengkap;
            $user->username = $request->nmUsername;
            $user->email = $request->Email;
            $user->password = Hash::make($request->password);
            $user->jk = $request->nmJK;
            $user->tgl_lahir = $request->nmTglLahir;
            $user->alamat = $request->nmAlamat;
            $user->kontak = $request->nmKontak;
            $user->keterangan = $request->nmKeterangan;
            $user->status = $request->nmStatusAktif;
            $user->save();

            $role = $request->nmRole;

            if($role){
                foreach($role as $x => $value){
                    $user->assignRole($value);
                }
            }
            
            return redirect()->route('user_index')->with('success', 'User Baru Telah Dibuat');

        });
    }

    public function update(Request $request, $id)
    {
    
        return DB::transaction(function () use ($request, $id) {

            $user = User::find($id);

            if(isset($request->cbGantiPassword)){
                $validated = $request->validate([
                    'nmNamaLengkap' => 'required',
                    'Email' => 'required|email',
                    'old_password' => [
                        'required',
                        function ($attribute, $value, $fail) use ($user) {
                            if (!Hash::check($value, $user->password)) {
                                $fail('Password Lama Anda Salah');
                            }
                        }
                    ],
                    'new_password' => [
                        'required', 'min:6', 'confirmed', 'different:old_password'
                    ]
                ]);
            }
            else{
                $this->validate(request(), [
                    'nmNamaLengkap' => 'required',
                    'Email' => 'required|email',
                ]);
            }
            
            $user->name = $request->nmNamaLengkap;
            $user->email = $request->Email;
            
            if(isset($request->cbGantiPassword)){
                $user->password = Hash::make($request->new_password);
            }
            $user->jk = $request->nmJK;
            $user->tgl_lahir = $request->nmTglLahir;
            $user->alamat = $request->nmAlamat;
            $user->kontak = $request->nmKontak;
            $user->keterangan = $request->nmKeterangan;
            $user->status = $request->nmStatusAktif;
            $user->save();

            $role = $request->nmRole;
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            if($role){
                foreach($role as $x => $value){
                    $user->assignRole($value);
                }
            }
            
            return redirect()->route('user_index')->with('success', 'Data User Telah Diperbarui');

        });

    }

}
