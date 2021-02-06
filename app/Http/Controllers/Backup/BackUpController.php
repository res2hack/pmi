<?php

namespace App\Http\Controllers\Backup;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Arr;
// use Spatie\Backup\BackupDestination;
use Illuminate\Support\Facades\Storage;

class BackUpController extends Controller
{
    public function backup(Request $request)
    {
      
        $jenis = $request->jenisBackup;
        
        $eksekusi = \Illuminate\Support\Facades\Artisan::call('backup:run --only-'. $jenis . ' --disable-notifications');
        // dd($eksekusi);
       
        return redirect()->route('backup_index');
    }

    public function index()
    {
        $file_details = [];
        $files = Storage::allFiles('Laravel');
        foreach ($files as $key => $file) {
            $file_details[$key]['name'] = $file;
            $file_details[$key]['size'] =  round(Storage::size($file) / 1000000, 3);
            $file_details[$key]['date'] =  gmdate("d-m-Y, H:i:s", Storage::lastModified($file) + (3600*7));
            // $file_details[$key]['path'] =  preg_replace('/public/','',url('/')) . 'storage/app/'. $file;
            }
            // dd($file_details);
        //   $file_details =collect($file_details));
          return view('backup.list',[
            'file_details' => $file_details,
          ]);
         
    }

    public function download($filename)
    {
        // dd($filename);
      Storage::download(storage_path('/app/' . $filename));
    //   dd($tes);
        // return response()->download(storage_path($filename));
    }

    public function delete(Request $request)
    {
      
        // dd($request->idDelete);
        Storage::delete($request->idDelete);
     
        return redirect()->route('backup_index');
    }

    

}
