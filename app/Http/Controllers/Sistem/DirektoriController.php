<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Direktori as Direktori;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use DataTables;

class DirektoriController extends Controller
{

    public function getDisnaker()
    {
        $get_disnaker = DB::table('pmi_direktori')->where('kategori', 'disnaker');
        return [$get_disnaker];
    }

    public function getP3mi()
    {
        $get_p3mi = DB::table('pmi_direktori')->whereIn('kategori', ['p3mi-pusat', 'p3mi-cabang']);
        return [$get_p3mi];
    }

    public function getBlk()
    {
        $get_blk = DB::table('pmi_direktori')->whereIn('kategori', ['blk-swasta', 'blk-negeri']);
        return [$get_blk];
    }

    public function getKbri()
    {
        $get_kbri = DB::table('pmi_direktori')->where('kategori', 'kbri');
        return [$get_kbri];
    }

    public function getLsp()
    {
        $get_lsp = DB::table('pmi_direktori')->where('kategori', 'lsp');
        return [$get_lsp];
    }

    public function saveData(Request $request)
    {

        return DB::transaction(function () use ($request) {

        $user = Auth::user();

        $this->validate($request, 
        ['nmDirektori' => 'required'],
        ['nmDirektori.required' => '* Nama Dinas harus diisi']
        );

        if($request->nmTipe == "create"){
            // Baru
            $direktori = new Direktori();
            $direktori->create_uid = $user->id;
            $direktori->create_date = now();
        }
        else{
            // Update
            $direktori = Direktori::find($request->idDirektori);
            $direktori->write_uid = $user->id;
            $direktori->write_date = now();
        }

        $direktori->nama = $request->nmDirektori;
        $direktori->alamat = $request->nmAlamat;
        $direktori->kontak = $request->nmKontak;
        $direktori->sts_tampil = $request->nmTampil;
        $direktori->sts_valid = $request->nmValid;

        $detail = $request->nmDetail;

        $folder =  public_path().'/uploads/file/direktori';

        if (! File::exists($folder)) {
            File::makeDirectory($folder, 0777,true);
        }

        if($detail){
            $dom = new \DomDocument();
            $detail_filter = str_replace("\0", '', $detail);

            @$dom->loadHtml($detail_filter, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    

            $images = $dom->getElementsByTagName('img');

            foreach($images as $k => $img){
                $src = $img->getAttribute('src');
                if(preg_match('/data:image/', $src)){                
                    // get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];
                                    
                    // Random filename
                    $filename = uniqid();
                    $filepath = "/uploads/file/direktori/$filename.$mimetype";   
                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                      // resize if required
                      /* ->resize(300, 200) */
                    ->encode($mimetype, 100)  // encode file to the specified mimetype
                    ->save(public_path($filepath));                
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                } 
                
            }

            $detail_filter = $dom->saveHTML();
            $direktori->detail = $detail_filter;
        }
    
        return [$direktori];

        });

    }


    public function direktori_json(Request $request)
    {
        $jenis = $request->jenisDirektori;

        if($jenis == "disnaker"){
            list($get_disnaker) = $this->getDisnaker();
            $direktori = $get_disnaker->orderBy('id', 'desc')->get();
        }
        if($jenis == "p3mi"){
            list($get_p3mi) = $this->getP3mi();
            $direktori = $get_p3mi->orderBy('id', 'desc')->get();
        }
        if($jenis == "blk"){
            list($get_blk) = $this->getBlk();
            $direktori = $get_blk->orderBy('id', 'desc')->get();
        }
        if($jenis == "kbri"){
            list($get_kbri) = $this->getKbri();
            $direktori = $get_kbri->orderBy('id', 'desc')->get();
        }
        if($jenis == "lsp"){
            list($get_lsp) = $this->getLsp();
            $direktori = $get_lsp->orderBy('id', 'desc')->get();
        }
        
        
        if ($request->ajax()) {
            return Datatables::of($direktori)
            ->editColumn('nama', function ($data) use ($jenis) {
                if($jenis == 'blk')
                {
                    if($data->kategori == 'blk-swasta'){
                        return '<a class="font-14" href="' . route($jenis . '_detail', $data->id) . 
                                '">' . $data->nama . '</a><div class="font-12 font-weight-500 text-danger">
                                Swasta</div>';
                    }
                    else{
                        return '<a class="font-14" href="' . route($jenis . '_detail', $data->id) . 
                                '">' . $data->nama . '</a><div class="font-12 font-weight-500 text-success">
                                Pemerintah</div>';
                    }
                }
                if($jenis == 'p3mi')
                {
                    if($data->kategori == 'p3mi-pusat'){
                        return '<a class="font-14" href="' . route($jenis . '_detail', $data->id) . 
                                '">' . $data->nama . '</a><div class="font-12 font-weight-500 text-success">Pusat</div>';
                    }
                    else{
                        return '<a class="font-14" href="' . route($jenis . '_detail', $data->id) . 
                                '">' . $data->nama . '</a><div class="font-12 font-weight-500 text-danger">Cabang</div>';
                    }
                }
                else{
                    return '<a class="font-14" href="' . route($jenis . '_detail', $data->id) . '">' . $data->nama . '</a>';
                }
            })
            ->editColumn('alamat', function($data){
                return  '<span class="text-dark">' . $data->alamat . '</span>';
            })
            ->editColumn('kontak', function($data){
                return  '<span class="text-dark">' . $data->kontak . '</span>';
            })
            ->editColumn('sts_tampil', function($data){
                if($data->sts_tampil == 0){
                    return '<div class="text-center"><span class="d-none">tampil</span>
                            <i class="font-18 far fa-times-circle text-danger"></i></div>';
                }
                else{
                    return '<div class="text-center"><span class="d-none">tidak</span>
                            <i class="font-18 far fa-check-circle text-success"></i></div>';
                }
            })
            ->editColumn('sts_valid', function($data) use ($jenis){
                if($data->sts_valid == 0){
                    if($jenis == 'blk'){
                        return '<div class="text-center"><span class="d-none">Ilegal</span>
                                <i class="font-18 far fa-times-circle text-danger" 
                                title="Tidak Legal (Ilegal)"></i></div>';
                    }else{
                        return '<div class="text-center"><span class="d-none">tidak</span>
                                <i class="font-18 far fa-times-circle text-danger"
                                title="Tidak Valid"></i></div>';
                    }
                }
                else{
                    if($jenis == 'blk'){
                        return '<div class="text-center"><span class="d-none">legal</span>
                            <i class="font-18 far fa-check-circle text-success"
                            title="Legal"></i></div>';
                    }else{
                        return '<div class="text-center"><span class="d-none">valid</span>
                        <i class="font-18 far fa-check-circle text-success"
                        title="Valid"></i></div>';
                    }
                }
            })
            ->addColumn('action', function ($data) use ($jenis) {
                return '<div class="btn-group dropleft mr-2" title="Detail/Ubah/Hapus">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route($jenis . '_detail', $data->id) . '"><i class="far fa-file-alt font-14 mr-2"></i> Detail</a>
                    <a class="dropdown-item text-primary" href="' . route($jenis . '_edit', $data->id) . '"> <i class="fas fa-edit font-13 mr-2"></i>Ubah</a>
                    <a class="dropdown-item text-danger" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter" >
                    <i class="fas fa-times font-15 mr-2"></i> Hapus</a>
                </div>';
            })
            ->rawColumns(['nama', 'alamat', 'kontak', 'sts_tampil', 'sts_valid', 'action'])
            ->toJson();
        }

    }

    public function EditDetailData($id)
    {
        $direktori = DB::table('pmi_direktori')->where('id', $id)->first();
        return [$direktori];
    }

    public function deleteData(Request $request)
    {
        $direktori = Direktori::find($request->idDelete);
        $direktori->delete();
        
    }

    // DISNAKER

    public function disnaker_index(){
        $tipe = 'disnaker';
        return view('sistem.direktori.disnaker.index', [
            'tipe' => $tipe
        ]);
    }

    public function disnaker_create()
    {
        return view('sistem.direktori.disnaker.create');
    }

    public function disnaker_edit($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.disnaker.edit', [
            'direktori' => $direktori,
        ]);
    }

    public function disnaker_detail($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.disnaker.detail', [
            'direktori' => $direktori,
        ]);
    }

    public function disnaker_store(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->kategori = 'disnaker';
        $direktori->save();
        return redirect()->route('disnaker_edit', $direktori->id)->with('success', 'Data Telah Disimpan');
    }

    public function disnaker_update(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->save();
        return redirect()->route('disnaker_edit', $direktori->id)->with('success', 'Data Telah Diperbarui');
    }

    public function disnaker_delete(Request $request)
    {
        $this->deleteData($request);
        return redirect()->route('disnaker_index')->with('success', 'Data Telah Dihapus Permanen');
    }

    // BLK

    public function blk_index(){
        $tipe = 'blk';
        return view('sistem.direktori.blk.index', [
            'tipe' => $tipe
        ]);
    }

    public function blk_create()
    {
        return view('sistem.direktori.blk.create');
    }

    public function blk_edit($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.blk.edit', [
            'direktori' => $direktori,
        ]);
    }

    public function blk_detail($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.blk.detail', [
            'direktori' => $direktori,
        ]);
    }

    public function blk_store(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->kategori = $request->nmPengelola;
        $direktori->save();
        return redirect()->route('blk_edit', $direktori->id)->with('success', 'Data Telah Disimpan');
    }

    public function blk_update(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->kategori = $request->nmPengelola;
        $direktori->save();
        return redirect()->route('blk_edit', $direktori->id)->with('success', 'Data Telah Diperbarui');
    }

    public function blk_delete(Request $request)
    {
        $this->deleteData($request);
        return redirect()->route('blk_index')->with('success', 'Data Telah Dihapus Permanen');
    }

    // KBRI

    public function kbri_index(){
        $tipe = 'kbri';
        return view('sistem.direktori.kbri.index', [
            'tipe' => $tipe
        ]);
    }

    public function kbri_create()
    {
        return view('sistem.direktori.kbri.create');
    }

    public function kbri_edit($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.kbri.edit', [
            'direktori' => $direktori,
        ]);
    }

    public function kbri_detail($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.kbri.detail', [
            'direktori' => $direktori,
        ]);
    }

    public function kbri_store(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->kategori = 'kbri';
        $direktori->save();
        return redirect()->route('kbri_edit', $direktori->id)->with('success', 'Data Telah Disimpan');
    }

    public function kbri_update(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->kategori = 'kbri';
        $direktori->save();
        return redirect()->route('kbri_edit', $direktori->id)->with('success', 'Data Telah Diperbarui');
    }

    public function kbri_delete(Request $request)
    {
        $this->deleteData($request);
        return redirect()->route('kbri_index')->with('success', 'Data Telah Dihapus Permanen');
    }

    // P3MI

    public function p3mi_index(){
        $tipe = 'p3mi';
        return view('sistem.direktori.p3mi.index', [
            'tipe' => $tipe
        ]);
    }

    public function p3mi_create()
    {
        return view('sistem.direktori.p3mi.create');
    }

    public function p3mi_edit($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.p3mi.edit', [
            'direktori' => $direktori,
        ]);
    }

    public function p3mi_detail($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.p3mi.detail', [
            'direktori' => $direktori,
        ]);
    }

    public function p3mi_store(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->kategori = $request->nmKantor;
        $direktori->save();
        return redirect()->route('p3mi_edit', $direktori->id)->with('success', 'Data Telah Disimpan');
    }

    public function p3mi_update(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->kategori = $request->nmKantor;
        $direktori->save();
        return redirect()->route('p3mi_edit', $direktori->id)->with('success', 'Data Telah Diperbarui');
    }

    public function p3mi_delete(Request $request)
    {
        $this->deleteData($request);
        return redirect()->route('p3mi_index')->with('success', 'Data Telah Dihapus Permanen');
    }

    // LSP

    public function lsp_index(){
        $tipe = 'lsp';
        return view('sistem.direktori.lsp.index', [
            'tipe' => $tipe
        ]);
    }

    public function lsp_create()
    {
        return view('sistem.direktori.lsp.create');
    }

    public function lsp_edit($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.lsp.edit', [
            'direktori' => $direktori,
        ]);
    }

    public function lsp_detail($id)
    {
        list($direktori) = $this->EditDetailData($id);

        return view('sistem.direktori.lsp.detail', [
            'direktori' => $direktori,
        ]);
    }

    public function lsp_store(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->kategori = 'lsp';
        $direktori->save();
        return redirect()->route('lsp_edit', $direktori->id)->with('success', 'Data Telah Disimpan');
    }

    public function lsp_update(Request $request)
    {
        list($direktori) = $this->saveData($request);
        $direktori->save();
        return redirect()->route('lsp_edit', $direktori->id)->with('success', 'Data Telah Diperbarui');
    }

    public function lsp_delete(Request $request)
    {
        $this->deleteData($request);
        return redirect()->route('lsp_index')->with('success', 'Data Telah Dihapus Permanen');
    }

}