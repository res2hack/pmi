<?php

namespace App\Http\Controllers\PostPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostPage as Pengumuman;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Category as Category;
use Conner\Tagging\Model\Tagged as Tagged;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{


    public function typeId()
    {
        $get_tipe = DB::table('post_type')->where('name', 'pengumuman')->pluck('id')->first();
        return $get_tipe;
    }

    public function getData()
    {
        $type_id = $this->typeId();
        $get_pengumuman = Pengumuman::where('type_id', $type_id);

        return [$type_id, $get_pengumuman];
    }

    public function countSampah()
    {
        $count_sampah = Pengumuman::whereNotNull('post_pages.delete_date')->count();
        return $count_sampah;
    }

    public function index()
    {
        
        list($type_id, $get_pengumuman) = $this->getData();
        
        $pengumuman = $get_pengumuman->whereNull('post_pages.delete_date')
                    ->orderBy('id', 'Desc');
        
        $pengumuman_simple = $pengumuman->simplePaginate(10);
        $pengumuman_paginate = $pengumuman->paginate(10);
        $search = '';

        $jumlahSampah = $this->countSampah();

        $create_uid = $pengumuman_simple->pluck('create_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $create_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return view('pengumuman.index', [
            'pengumuman_paginate' => $pengumuman_paginate,
            'pengumuman_simple' => $pengumuman_simple,
            'search' => $search,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function search(Request $request)
    {
        $type_id = $this->typeId();

        $search = $request->search;

        $query_pengumuman = DB::table('post_pages')->where('type_id', $type_id)
        ->where(function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('create_date', 'like', '%' . $search . '%');
                });
            
        if($request->idPengumuman == "index")
        {
            $pengumuman = $query_pengumuman->whereNull('delete_date')
                        ->orderBy('delete_date', 'Desc');
        }
        else{
            $pengumuman = $query_pengumuman->whereNotNull('delete_date')
                        ->orderBy('delete_date', 'Desc');
        }
        
        $pengumuman_simple = $pengumuman->simplePaginate(10)->withQueryString();
        $pengumuman_paginate = $pengumuman->paginate(10)->withQueryString();
        $jumlahSampah = $this->countSampah();

        $create_uid = $pengumuman_simple->pluck('create_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $create_uid)
                ->get();
        
        $arr_user = arr::flatten($user);
        
        return [$search, $pengumuman_simple, $pengumuman_paginate, $jumlahSampah, $arr_user];
    }

    public function search_index(Request $request)
    {
        list($search, $pengumuman_simple, $pengumuman_paginate, $jumlahSampah, $arr_user) = $this->search($request);

        return view('pengumuman.index', [
            'search' => $search,
            'pengumuman_paginate' => $pengumuman_paginate,
            'pengumuman_simple' => $pengumuman_simple,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function search_sampah(Request $request)
    {
        list($search, $pengumuman_simple, $pengumuman_paginate, $jumlahSampah, $arr_user) = $this->search($request);
            
        return view('pengumuman.sampah', [
            'search' => $search,
            'pengumuman_paginate' => $pengumuman_paginate,
            'pengumuman_simple' => $pengumuman_simple,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function create()
    {
        
        return view('pengumuman.create', [
        
        ]);
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::find($id);

        return view('pengumuman.edit', [
            'pengumuman' => $pengumuman,
        ]);
    }

    public function savePengumuman(Request $request)
    {

        return DB::transaction(function () use ($request) {

        $user = Auth::user();


        if($request->pengumuman_tipe == "baru"){
            // Pengumuman Baru
            $this->validate($request, 
                ['nmJudul' => 'unique:post_pages,title',
                    'nmJenisKategori' => 'unique:post_pages,slug'],
                ['nmJudul.unique' => '* Judul ini sudah digunakan oleh pengumuman lainnya',
                    'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh pengumuman lainnya']
            );

            $type_id = $this->typeId();

            $pengumuman = new Pengumuman();
            $pengumuman->type_id = $type_id;
            $pengumuman->create_uid = $user->id;
            $pengumuman->create_date = now();
        }
        else{
            // Update Penumuman
            $pengumuman = Pengumuman::find($request->idPengumuman);
            $this->validate($request, 
            ['nmJudul' => 'unique:post_pages,title,' . $request->idPengumuman,
            'nmJenisKategori' => 'unique:post_pages,slug,' . $request->idPengumuman],
            ['nmJudul.unique' => '* Judul ini sudah digunakan oleh pengumuman lainnya',
            'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh pengumuman lainnya']
        );
            $pengumuman->write_uid = $user->id;
            $pengumuman->write_date = now();
            
        }

        $konten = $request->nmKonten;
        
        $pengumuman->title = $request->nmJudul;
        $pengumuman->slug = $request->nmJenisKategori;
        $tahun = now()->format('Y');
        
        if($konten){
            $dom = new \DomDocument();
            $konten_filter = str_replace("\0", '', $konten);

            @$dom->loadHtml($konten_filter, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    

            $images = $dom->getElementsByTagName('img');

            foreach($images as $k => $img){

                $src = $img->getAttribute('src');

                if(preg_match('/data:image/', $src)){                
                    // get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];
                                    
                    // Random filename
                    $filename = uniqid();
                    $filepath = "/uploads/$tahun/$filename.$mimetype";    
                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                      // resize if required
                      /* ->resize(300, 100) */
                    ->encode($mimetype, 100)  // encode file to the specified mimetype
                    ->save(public_path($filepath));                
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                } 
                
            }

            $konten_filter = $dom->saveHTML();

            $pengumuman->content = $konten_filter;
        }
        else{
            $pengumuman->content = $konten;
        }
        
        if($request->statusFeatured == "hapus")
        {
            // File::delete($pengumuman->img_featured);
            $pengumuman->img_featured = null;
        }

        if($request->hasFile('featuredImage')){

            $featuredImage = $request->file('featuredImage');
            // $mimetype_featured = $featuredImage->getMimeType();
            $filename_featured = uniqid() . '.' . $featuredImage->getClientOriginalExtension();
        
            $filepath_featured = "uploads/$tahun"; 

            $featuredImage->move($filepath_featured, $filename_featured);

            $pengumuman->img_featured = $filepath_featured . '/' . $filename_featured;
        }

        if($request->statusThumbnail == "hapus")
        {
            // File::delete($pengumuman->img_thumbnail);
            $pengumuman->img_thumbnail = null;
        }

        if($request->hasFile('thumbnailImage')){

            $thumbnailImage = $request->file('thumbnailImage');
            // $mimetype_featured = $featuredImage->getMimeType();
            $filename_thumbnail = uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();
        
            $filepath_thumbnail = "uploads/$tahun/thumbnails"; 

            $thumbnailImage->move($filepath_thumbnail, $filename_thumbnail);

            $pengumuman->img_thumbnail = $filepath_thumbnail . '/' . $filename_thumbnail;
        }
        
        $pengumuman->meta_title = $request->metaTitle;
        $pengumuman->meta_description = $request->metaDescription;

        $pengumuman->status = $request->nmStatus;

        if(!$request->nmTerbitDate){
            $pengumuman->published_date = now();
        }

        $pengumuman->save();

        return [$pengumuman];

        });

    }

    public function store(Request $request)
    {
    
        list($pengumuman) = $this->savePengumuman($request);
        $cek_status = $pengumuman->status;
        if($cek_status == "draft"){
            $status = "Pengumuman Telah Disimpan";
        }
        else if($cek_status == "terbit"){
            $status = "Pengumuman Telah Disimpan dan diterbitkan";
        }

        return redirect()->route('pengumuman_edit', $pengumuman->id)->with('success', $status);
    }

    public function preview($id){

        $pengumuman = Pengumuman::where('post_pages.id', $id)
                ->where('post_pages.status', 'draft')
                ->first();

        if($pengumuman == null){
            $pengumuman = Pengumuman::where('post_pages.id', $id)
                    ->first();
            return redirect()->route('pengumuman_show', $pengumuman->slug);
        }
        else{
            return view('pengumuman.preview', [
                'pengumuman' => $pengumuman,
            ]);
        }
        
    }

    public function show($slug)
    {
        $type_id = $this->typeId();
        $pengumuman = Pengumuman::where('type_id', $type_id)->where('slug', $slug)->where('post_pages.status', 'terbit')->first();
        
        if($pengumuman == null){
            return redirect()->route('home');
        }
        else{
            return view('pengumuman.show', [
                'pengumuman' => $pengumuman,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->savePengumuman($request);
        return redirect()->back()->with('success', 'Pengumuman Telah Diperbarui');
    }

    public function softdelete(Request $request)
    {
        $user = Auth::user();
        $pengumuman = Pengumuman::find($request->idDelete);
        $pengumuman->delete_uid = $user->id;
        $pengumuman->delete_date = now();
        $pengumuman->save();

        return redirect()->back()->with('success', 'Pengumuman telah dihapus dan dimasukkan keranjang sampah');
    }

    public function sampah(){
        list($type_id, $get_page) = $this->getData();

        $pengumuman = $get_page->whereNotNull('post_pages.delete_date')
                ->orderBy('id', 'Desc');

        $pengumuman_simple = $get_page->simplePaginate(10);
        $pengumuman_paginate = $get_page->paginate(10);
        $search = '';
        
        $delete_uid = $pengumuman->pluck('delete_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $delete_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return view('pengumuman.sampah', [
            'pengumuman_paginate' => $pengumuman_paginate,
            'pengumuman_simple' => $pengumuman_simple,
            'search' => $search,
            'arr_user' => $arr_user,
        ]);
    }

    public function restore(Request $request)
    {
        $user = Auth::user();
        $pengumuman = Pengumuman::find($request->idRestore);
        $pengumuman->delete_uid = null;
        $pengumuman->delete_date = null;
        $pengumuman->save();
        return redirect()->route('pengumuman_index')->with('success', 'Pengumuman Telah Di-Restore');
    }

    public function delete(Request $request)
    {
        $pengumuman = Pengumuman::find($request->idDelete);
        $pengumuman->delete();
        return redirect()->route('pengumuman_index')->with('success', 'Pengumuman Telah Dihapus Permanen');
    }

    public function front()
    {
        $type_id = $this->typeId();
        
        $pengumuman = Pengumuman::where('post_pages.type_id', $type_id)
                ->orderBy('id', 'Desc')
                ->paginate(5);
    
        $last =  DB::table('post_pages')->select('id')
                    ->where('post_pages.type_id', $type_id)
                    ->orderBy('id', 'Desc')
                    ->first();  
        
        return view('pengumuman.front', [
            'pengumuman' => $pengumuman,
            'last' => $last,
        ]);
    }

}
