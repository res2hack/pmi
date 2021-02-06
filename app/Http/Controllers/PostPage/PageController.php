<?php

namespace App\Http\Controllers\PostPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostPage as Page;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public function typeId()
    {
        $get_tipe = DB::table('post_type')->where('name', 'page')->pluck('id')->first();
        return $get_tipe;
    }

    public function getData()
    {
        $type_id = $this->typeId();
        $get_page = Page::where('type_id', $type_id);

        return [$type_id, $get_page];
    }

    public function countSampah()
    {
        $count_sampah = Page::whereNotNull('post_pages.delete_date')->count();
        return $count_sampah;
    }

    public function index()
    {
        
        list($type_id, $get_page) = $this->getData();
        
        $page = $get_page->whereNull('post_pages.delete_date')
                ->orderBy('id', 'Desc');
        
        $page_simple = $page->simplePaginate(10);
        $page_paginate = $page->paginate(10);
        $search = '';

        $jumlahSampah = $this->countSampah();

        $create_uid = $page_simple->pluck('create_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $create_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return view('pages.index', [
            'page_paginate' => $page_paginate,
            'page_simple' => $page_simple,
            'search' => $search,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function search(Request $request)
    {
        $type_id = $this->typeId();

        $search = $request->search;

        $query_page = DB::table('post_pages')->where('type_id', $type_id)
        ->where(function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('create_date', 'like', '%' . $search . '%');
                });

        if($request->idpage == "index")
        {
            $page = $query_page->whereNull('delete_date')
                    ->orderBy('delete_date', 'Desc');
        }
        else{
            $page = $query_page->whereNotNull('delete_date')
            ->orderBy('delete_date', 'Desc');
        }

        $page_simple = $page->simplePaginate(10)->withQueryString();
        $page_paginate = $page->paginate(10)->withQueryString();
        $jumlahSampah = $this->countSampah();

        $create_uid = $page_simple->pluck('create_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $create_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return [$search, $page_simple, $page_paginate, $jumlahSampah, $arr_user];
    }

    public function search_index(Request $request)
    {
        list($search, $page_simple, $page_paginate,
            $jumlahSampah, $arr_user) = $this->search($request);

        return view('pages.index', [
            'search' => $search,
            'page_paginate' => $page_paginate,
            'page_simple' => $page_simple,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function search_sampah(Request $request)
    {
        list($search, $page_simple, $page_paginate, $jumlahSampah, $arr_user) = $this->search($request);
            
        return view('pages.sampah', [
            'search' => $search,
            'page_paginate' => $page_paginate,
            'page_simple' => $page_simple,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function create()
    {
        
        return view('pages.create', [
        
        ]);
    }

    public function edit($id)
    {
        $page = Page::find($id);

        return view('pages.edit', [
            'page' => $page,
        ]);
    }

    public function saveHalaman(Request $request)
    {

        return DB::transaction(function () use ($request) {

        $user = Auth::user();


        if($request->page_tipe == "baru"){
            // Halaman Baru
            $this->validate($request, 
                ['nmJudul' => 'unique:post_pages,title',
                    'nmJenisKategori' => 'unique:post_pages,slug'],
                ['nmJudul.unique' => '* Judul ini sudah digunakan oleh halaman lainnya',
                    'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh halaman lainnya']
            );

            $type_id = $this->typeId();

            $page = new Page();
            $page->type_id = $type_id;
            $page->create_uid = $user->id;
            $page->create_date = now();
        }
        else{
            // Update Halaman
            $page = Page::find($request->idHalaman);
            $this->validate($request, 
            ['nmJudul' => 'unique:post_pages,title,' . $request->idHalaman,
            'nmJenisKategori' => 'unique:post_pages,slug,' . $request->idHalaman],
            ['nmJudul.unique' => '* Judul ini sudah digunakan oleh halaman lainnya',
            'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh halaman lainnya']
        );
            $page->write_uid = $user->id;
            $page->write_date = now();
            
        }

        $konten = $request->nmKonten;
        
        $page->title = $request->nmJudul;
        
        $page->slug = $request->nmJenisKategori;

        $tahun = now()->format('Y');
        
        $folder =  public_path().'/uploads/'.$tahun;

        if (! File::exists($folder)) {
            File::makeDirectory($folder, 0777,true);
        }
        
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

            $page->content = $konten_filter;
        }
        
        if($request->statusFeatured == "hapus")
        {
            // File::delete($page->img_featured);
            $page->img_featured = null;
        }

        if($request->hasFile('featuredImage')){

            $featuredImage = $request->file('featuredImage');
            // $mimetype_featured = $featuredImage->getMimeType();
            $filename_featured = uniqid() . '.' . $featuredImage->getClientOriginalExtension();
        
            $filepath_featured = "uploads/$tahun"; 

            $featuredImage->move($filepath_featured, $filename_featured);

            $page->img_featured = $filepath_featured . '/' . $filename_featured;
        }

        if($request->statusThumbnail == "hapus")
        {
            // File::delete($page->img_thumbnail);
            $page->img_thumbnail = null;
        }

        if($request->hasFile('thumbnailImage')){

            $thumbnailImage = $request->file('thumbnailImage');
            // $mimetype_featured = $featuredImage->getMimeType();
            $filename_thumbnail = uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();
        
            $filepath_thumbnail = "uploads/$tahun/thumbnails"; 

            $thumbnailImage->move($filepath_thumbnail, $filename_thumbnail);

            $page->img_thumbnail = $filepath_thumbnail . '/' . $filename_thumbnail;
        }
        
        $page->meta_title = $request->metaTitle;
        $page->meta_description = $request->metaDescription;

        $page->status = $request->nmStatus;

        if(!$request->nmTerbitDate){
            $page->published_date = now();
        }

        $page->save();

        return [$page];

        });

    }

    public function store(Request $request)
    {
    
        list($page) = $this->saveHalaman($request);
        $cek_status = $page->status;
        if($cek_status == "draft"){
            $status = "Halaman Telah Disimpan";
        }
        else if($cek_status == "terbit"){
            $status = "Halaman Telah Disimpan dan diterbitkan";
        }

        return redirect()->route('page_edit', $page->id)->with('success', $status);
    }

    public function preview($id){

        $page = Page::where('post_pages.id', $id)
                ->where('post_pages.status', 'draft')
                ->first();

        if($page == null){
            $page = Page::where('post_pages.id', $id)
                    ->first();
            return redirect()->route('page_show', $page->slug);
        }
        else{
            return view('pages.preview', [
                'page' => $page,
            ]);
        }
        
    }

    public function show($slug)
    {
        $type_id = $this->typeId();
        $page = Page::where('type_id', $type_id)->where('slug', $slug)->where('post_pages.status', 'terbit')->first();
        
        if($page == null){
            return redirect()->route('home');
        }
        else{
            return view('pages.show', [
                'page' => $page,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->saveHalaman($request);
        return redirect()->back()->with('success', 'Halaman Telah Diperbarui');
    }

    public function softdelete(Request $request)
    {
        $user = Auth::user();
        $page = Page::find($request->idDelete);
        $page->delete_uid = $user->id;
        $page->delete_date = now();
        $page->save();

        return redirect()->back()->with('success', 'Halaman telah dihapus dan dimasukkan keranjang sampah');
    }

    public function sampah(){
        list($type_id, $get_page) = $this->getData();

        $page = $get_page->whereNotNull('post_pages.delete_date')
                ->orderBy('id', 'Desc');

        $page_simple = $get_page->simplePaginate(10);
        $page_paginate = $get_page->paginate(10);
        $search = '';
        
        $delete_uid = $page->pluck('delete_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $delete_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return view('pages.sampah', [
            'page_paginate' => $page_paginate,
            'page_simple' => $page_simple,
            'search' => $search,
            'arr_user' => $arr_user,
        ]);
    }

    public function restore(Request $request)
    {
        $user = Auth::user();
        $page = Page::find($request->idRestore);
        $page->delete_uid = null;
        $page->delete_date = null;
        $page->save();
        return redirect()->route('page_index')->with('success', 'Halaman Telah Di-Restore');
    }

    public function delete(Request $request)
    {
        $page = Page::find($request->idDelete);
        $page->delete();
        return redirect()->route('page_index')->with('success', 'Halaman Telah Dihapus Permanen');
    }



}
