<?php

namespace App\Http\Controllers\Role;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Arr;
class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::where('name', '<>' ,'superadmin')->get();
        $permissions = Permission::get();
        $role_permissions = DB::table('role_has_permissions')
                    ->select('role_has_permissions.*', 'permissions.name')
                    ->leftjoin('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->get();
        $role_permissions = arr::flatten($role_permissions);
        // dd($role_permissions);
        return view('users.role.index', [
            'roles' => $roles,
            'permissions' => $permissions,
            'role_permissions' => $role_permissions,
        ]);
    }

    public function create()
    {
        $roles = Role::where('name', '<>' ,'superadmin')->get();
        $permissions = Permission::orderByRaw('trim(name) asc')->get();
        return view('users.role.create', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function edit($id)
    {
        $role = Role::where('name', '<>' ,'superadmin')->where('id', $id)->first();
        $role_permissions = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id');
        $role_permissions = arr::flatten($role_permissions);
        $permissions = Permission::orderByRaw('trim(name) asc')->get();
        
        return view('users.role.edit', [
            'role' => $role,
            'role_permissions' => $role_permissions,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
    
        $this->validate($request, 
        ['nmRole' => 'required|unique:roles,name'],
        ['nmRole.required' => '* Kolom ini wajib diisi',
         'nmRole.unique' => '* Role ini sudah digunakan']
        );

        $role_create = Role::create([
            'name' => $request->nmRole,
            'deskripsi' => $request->nmDeskripsi,
            'guard_name' => 'web'
            ]);
        $permission = $request->nmPermission;
        if($permission){
            foreach($permission as $x => $value){
                $role_create->givePermissionTo($value);
            }
        }
        
        return redirect()->route('role_index')->with('success', 'Role User Baru Dibuat');
    }

    public function update(Request $request, $id)
    {
    
        $this->validate($request, 
            ['nmRole' => 'required|unique:roles,name,' . $id, ],
            ['nmRole.required' => '* Kolom ini wajib diisi',
                'nmRole.unique' => '* Role ini sudah digunakan']
            );

        $role_update = Role::find($id)->update([
            'name' => $request->nmRole,
            'deskripsi' => $request->nmDeskripsi,
            'guard_name' => 'web'
            ]);

        DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->delete();

        $permission = $request->nmPermission;
        if($permission){
            foreach($permission as $x => $value){
                Role::find($id)->givePermissionTo($value);
            }
        }
        
        return redirect()->route('role_index')->with('success', 'Role User Telah Diperbarui');
    }

    public function delete_index(Request $request)
    {
        Role::find($request->idDelete)->delete();
        return redirect()->back();
    }


}
