<?php

namespace App\Http\Controllers\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    

    public function dataPermission(){
        $permission = DB::table('permissions')->orderByRaw('trim(name) ASC')->get();
        return $permission;
    }

    public function index()
    {
        $permission = $this->dataPermission();
        return view('users.permission.index', [
            'permission' => $permission
        ]);
    }

    public function store(Request $request)
    {
    
        $this->validate($request, 
            ['nama' => 'required|unique:permissions,name'],
            ['nama.required' => '* Kolom ini wajib diisi',
                'nama.unique' => '* Hak Akses ini sudah digunakan']
            );

        Permission::create([
            'name' => $request->nama,
            'guard_name' => 'web',
            'grup' => $request->nmGrup,
            'keterangan' => $request->nmKeterangan,
            'deskripsi' => $request->nmDeskripsi,
            ]);
        return redirect()->back()->with('success', 'Hak Akses Baru Ditambahkan');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $dataPermission = $this->dataPermission();
        return view('users.permission.edit', [
            'permission' => $permission,
            'dataPermission' => $dataPermission,
        ]);
    
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, 
            ['nama' => 'required|unique:permissions,name,' . $id, ],
            ['nama.required' => '* Kolom ini wajib diisi',
             'nama.unique' => '* Hak Akses ini sudah digunakan']
            );

        Permission::find($id)->update([
            'name' => $request->nama,
            'grup' => $request->nmGrup,
            'keterangan' => $request->nmKeterangan,
            'deskripsi' => $request->nmDeskripsi,
            'guard_name' => 'web',
            ]);

        return redirect()->route('permission_index')->with('success', 'Hak Akses Diperbarui');
    }

    public function delete_index(Request $request)
    {
        Permission::find($request->idDelete)->delete();
        return redirect()->route('permission_index')->with('success', 'Hak Akses Dihapus');
    }
}
