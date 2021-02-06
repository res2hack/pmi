<?php

namespace App\Http\Controllers\PostPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostPage as Galeri;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class GaleriController extends Controller
{

    public function typeId()
    {
        $get_tipe = DB::table('post_type')->where('name', 'galeri')->pluck('id')->first();
        return $get_tipe;
    }

    public function getData()
    {
        $type_id = $this->typeId();
        $get_galeri = Galeri::where('type_id', $type_id);

        return [$type_id, $get_galeri];
    }

    public function countSampah()
    {
        $count_sampah = Galeri::whereNotNull('post_pages.delete_date')->count();
        return $count_sampah;
    }

    public function index()
    {
        
        list($type_id, $get_galeri) = $this->getData();
        
        $galeri = $get_galeri->whereNull('post_pages.delete_date')
                ->orderBy('id', 'Desc');
        
        $galeri_simple = $get_galeri->simplePaginate(10);
        $galeri_paginate = $get_galeri->paginate(10);
        $search = '';

        $jumlahSampah = $this->countSampah();

        $create_uid = $galeri_simple->pluck('create_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $create_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return view('galeri.index', [
            'galeri_paginate' => $galeri_paginate,
            'galeri_simple' => $galeri_simple,
            'search' => $search,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function search(Request $request)
    {
        $type_id = $this->typeId();

        $search = $request->search;

        $query_galeri = DB::table('post_pages')->where('type_id', $type_id)
        ->where(function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('create_date', 'like', '%' . $search . '%');
                });

        if($request->idgaleri == "index")
        {
            $galeri = $query_galeri->whereNull('delete_date')
                    ->orderBy('delete_date', 'Desc');
        }
        else{
            $galeri = $query_galeri->whereNotNull('delete_date')
            ->orderBy('delete_date', 'Desc');
        }

        $galeri_simple = $galeri->simplePaginate(10)->withQueryString();
        $galeri_paginate = $galeri->paginate(10)->withQueryString();
        $jumlahSampah = $this->countSampah();

        $create_uid = $galeri_simple->pluck('create_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $create_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return [$search, $galeri_simple, $galeri_paginate, $jumlahSampah, $arr_user];
    }

    public function search_index(Request $request)
    {
        list($search, $galeri_simple, $galeri_paginate,
            $jumlahSampah, $arr_user) = $this->search($request);

        return view('galeri.index', [
            'search' => $search,
            'galeri_paginate' => $galeri_paginate,
            'galeri_simple' => $galeri_simple,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function search_sampah(Request $request)
    {
        list($search, $galeri_simple, $galeri_paginate, $jumlahSampah, $arr_user) = $this->search($request);
            
        return view('galeri.sampah', [
            'search' => $search,
            'galeri_paginate' => $galeri_paginate,
            'galeri_simple' => $galeri_simple,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function create()
    {
        
        return view('galeri.create', [
        
        ]);
    }

    public function edit($id)
    {
        $galeri = Galeri::find($id);

        return view('galeri.edit', [
            'page' => $galeri,
        ]);
    }

    public function saveGaleri(Request $request)
    {

        return DB::transaction(function () use ($request) {

        $user = Auth::user();


        if($request->page_tipe == "baru"){
            // Galeri Baru
            $this->validate($request, 
                ['nmJudul' => 'unique:post_pages,title',
                    'nmJenisKategori' => 'unique:post_pages,slug'],
                ['nmJudul.unique' => '* Judul ini sudah digunakan oleh galeri lainnya',
                    'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh galeri lainnya']
            );

            $type_id = $this->typeId();

            $galeri = new Page();
            $galeri->type_id = $type_id;
            $galeri->create_uid = $user->id;
            $galeri->create_date = now();
        }
        else{
            // Update Galeri
            $galeri = Galeri::find($request->idGaleri);
            $this->validate($request, 
            ['nmJudul' => 'unique:post_pages,title,' . $request->idGaleri,
            'nmJenisKategori' => 'unique:post_pages,slug,' . $request->idGaleri],
            ['nmJudul.unique' => '* Judul ini sudah digunakan oleh galeri lainnya',
            'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh galeri lainnya']
        );
            $galeri->write_uid = $user->id;
            $galeri->write_date = now();
            
        }

        $konten = $request->nmKonten;
        
        $galeri->title = $request->nmJudul;
        
        $galeri->slug = $request->nmJenisKategori;

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

            $galeri->content = $konten_filter;
        }
        
        if($request->statusFeatured == "hapus")
        {
            // File::delete($galeri->img_featured);
            $galeri->img_featured = null;
        }

        if($request->hasFile('featuredImage')){

            $featuredImage = $request->file('featuredImage');
            // $mimetype_featured = $featuredImage->getMimeType();
            $filename_featured = uniqid() . '.' . $featuredImage->getClientOriginalExtension();
        
            $filepath_featured = "uploads/$tahun"; 

            $featuredImage->move($filepath_featured, $filename_featured);

            $galeri->img_featured = $filepath_featured . '/' . $filename_featured;
        }

        if($request->statusThumbnail == "hapus")
        {
            // File::delete($galeri->img_thumbnail);
            $galeri->img_thumbnail = null;
        }

        if($request->hasFile('thumbnailImage')){

            $thumbnailImage = $request->file('thumbnailImage');
            // $mimetype_featured = $featuredImage->getMimeType();
            $filename_thumbnail = uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();
        
            $filepath_thumbnail = "uploads/$tahun/thumbnails"; 

            $thumbnailImage->move($filepath_thumbnail, $filename_thumbnail);

            $galeri->img_thumbnail = $filepath_thumbnail . '/' . $filename_thumbnail;
        }
        
        $galeri->meta_title = $request->metaTitle;
        $galeri->meta_description = $request->metaDescription;

        $galeri->status = $request->nmStatus;

        if(!$request->nmTerbitDate){
            $galeri->published_date = now();
        }

        $galeri->save();

        return [$galeri];

        });

    }

    public function store(Request $request)
    {
    
        list($galeri) = $this->saveGaleri($request);
        $cek_status = $galeri->status;
        if($cek_status == "draft"){
            $status = "Galeri Telah Disimpan";
        }
        else if($cek_status == "terbit"){
            $status = "Galeri Telah Disimpan dan diterbitkan";
        }

        return redirect()->route('galeri_edit', $galeri->id)->with('success', $status);
    }

    public function preview($id){

        $galeri = Galeri::where('post_pages.id', $id)
                ->where('post_pages.status', 'draft')
                ->first();

        if($galeri == null){
            $galeri = Galeri::where('post_pages.id', $id)
                    ->first();
            return redirect()->route('galeri_show', $galeri->slug);
        }
        else{
            return view('galeri.preview', [
                'page' => $galeri,
            ]);
        }
        
    }

    public function show($slug)
    {
        $type_id = $this->typeId();
        $galeri = Galeri::where('type_id', $type_id)->where('slug', $slug)->where('post_pages.status', 'terbit')->first();
        
        if($galeri == null){
            return redirect()->route('home');
        }
        else{
            return view('galeri.show', [
                'page' => $galeri,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->saveGaleri($request);
        return redirect()->back()->with('success', 'Galeri Telah Diperbarui');
    }

    public function softdelete(Request $request)
    {
        $user = Auth::user();
        $galeri = Galeri::find($request->idDelete);
        $galeri->delete_uid = $user->id;
        $galeri->delete_date = now();
        $galeri->save();

        return redirect()->back()->with('success', 'Galeri telah dihapus dan dimasukkan keranjang sampah');
    }

    public function sampah(){
        list($type_id, $get_galeri) = $this->getData();

        $galeri = $get_galeri->whereNotNull('post_pages.delete_date')
                ->orderBy('id', 'Desc');

        $galeri_simple = $get_galeri->simplePaginate(10);
        $galeri_paginate = $get_galeri->paginate(10);
        $search = '';
        
        $delete_uid = $galeri->pluck('delete_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $delete_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return view('galeri.sampah', [
            'galeri_paginate' => $galeri_paginate,
            'galeri_simple' => $galeri_simple,
            'search' => $search,
            'arr_user' => $arr_user,
        ]);
    }

    public function restore(Request $request)
    {
        $user = Auth::user();
        $galeri = Galeri::find($request->idRestore);
        $galeri->delete_uid = null;
        $galeri->delete_date = null;
        $galeri->save();
        return redirect()->route('galeri_index')->with('success', 'Galeri Telah Di-Restore');
    }

    public function delete(Request $request)
    {
        $galeri = Galeri::find($request->idDelete);
        $galeri->delete();
        return redirect()->route('galeri_index')->with('success', 'Galeri Telah Dihapus Permanen');
    }



}
