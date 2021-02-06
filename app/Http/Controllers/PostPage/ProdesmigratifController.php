<?php

namespace App\Http\Controllers\PostPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prodesmigratif as Prodesmigratif;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Category as Category;
use Conner\Tagging\Model\Tagged as Tagged;
use Illuminate\Support\Facades\Auth;

class ProdesmigratifController extends Controller
{


    public function getKategori()
    {
        $kategori = DB::table('master_kategori_line')
                        ->where('jenis', 'm_prodesmigratif')
                        ->get();

        return [$kategori];
    }

    public function getData()
    {
        
        $get_prodes = DB::table('prodesmigratif')
                        ->select('prodesmigratif.*','master_kategori_line.name as kategori')
                        ->join('master_kategori_line', 'master_kategori_line.jenis_id', '=', 'prodesmigratif.kategori_id')
                        ->where('jenis', 'm_prodesmigratif');

        return [$get_prodes];
    }

    
    public function index()
    {
        
        list($get_prodes) = $this->getData();
        $prodesmigratif_simple = $get_prodes->simplePaginate(10);
        $prodesmigratif_paginate = $get_prodes->paginate(10);
        $search = '';
       
        return view('prodesmigratif.index', [
            'prodesmigratif_paginate' => $prodesmigratif_paginate,
            'prodesmigratif_simple' => $prodesmigratif_simple,
            'search' => $search,
        ]);
    }

    public function search(Request $request)
    {
    
        $search = $request->search;

        $query_prodes = DB::table('prodesmigratif')->select('prodesmigratif.*','master_kategori_line.name as kategori')
                ->join('master_kategori_line', 'master_kategori_line.jenis_id', '=', 'prodesmigratif.kategori_id')
                ->where('master_kategori_line.jenis', 'm_prodesmigratif')
                ->where(function($query) use ($search) {
                    $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('prodesmigratif.pemilik', 'like', '%' . $search . '%')
                    ->orWhere('prodesmigratif.kontak', 'like', '%' . $search . '%')
                    ->orWhere('prodesmigratif.alamat', 'like', '%' . $search . '%')
                    ->orWhere('prodesmigratif.keterangan', 'like', '%' . $search . '%')
                    ->orWhere('prodesmigratif.kontak', 'like', '%' . $search . '%')
                    ->orWhere('master_kategori_line.name', 'like', '%' . $search . '%');
                });
       
        $prodesmigratif_simple = $query_prodes->simplePaginate(10)->withQueryString();
        $prodesmigratif_paginate = $query_prodes->paginate(10)->withQueryString();
        
        return [$search, $prodesmigratif_simple, $prodesmigratif_paginate];
    }

    public function search_index(Request $request)
    {
        list($search, $prodesmigratif_simple, $prodesmigratif_paginate) = $this->search($request);
       
        return view('prodesmigratif.index', [
            'search' => $search,
            'prodesmigratif_paginate' => $prodesmigratif_paginate,
            'prodesmigratif_simple' => $prodesmigratif_simple,
        ]);
    }

   

    public function create()
    {
        list($kategori) = $this->getKategori();
        return view('prodesmigratif.create', [
            'kategori' => $kategori,
        ]);
    }

    public function edit($id)
    {
        $prodesmigratif = Prodesmigratif::find($id);
        list($kategori) = $this->getKategori();
        return view('prodesmigratif.edit', [
            'prodesmigratif' => $prodesmigratif,
            'kategori' => $kategori,
        ]);
    }

    public function saveProdesmigratif(Request $request)
    {

        return DB::transaction(function () use ($request) {

        $user = Auth::user();


        if($request->prodesmigratif_tipe == "baru"){
            $prodesmigratif = new Prodesmigratif();
        }else{
            $prodesmigratif = Prodesmigratif::find($request->idProdesmigratif);;
        }
            
            $prodesmigratif->kategori_id = $request->nmKategori;
            $prodesmigratif->judul = $request->nmJudul;
            $prodesmigratif->slug = $request->nmJenisKategori;
            $prodesmigratif->pemilik = $request->nmPemilik;
            $prodesmigratif->kontak = $request->nmKontak;
            $prodesmigratif->alamat = $request->nmAlamat;

            $keterangan = $request->nmKeterangan;
        
            if($keterangan){
                $dom = new \DomDocument();
                $keterangan_filter = str_replace("\0", '', $keterangan);

                @$dom->loadHtml($keterangan_filter, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD); 
                
                $images = $dom->getElementsByTagName('img');

                foreach($images as $k => $img){

                    $src = $img->getAttribute('src');

                    if(preg_match('/data:image/', $src)){                
                        // get the mimetype
                        preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                        $mimetype = $groups['mime'];
                                        
                        $filename = uniqid();
                        $filepath = "/uploads/file/prodesmigratif/$filename.$mimetype";  
                        $image = Image::make($src)
                        ->encode($mimetype, 100)  // encode file to the specified mimetype
                        ->save(public_path($filepath));                
                        $new_src = asset($filepath);
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $new_src);
                    } 
                    
                }

                $keterangan_filter = $dom->saveHTML();
                $prodesmigratif->keterangan = $keterangan_filter;
            }
            else{
                $prodesmigratif->keterangan = $keterangan;
            }

        
        if($request->statusFeatured == "hapus")
        {
            // File::delete($prodesmigratif->img_featured);
            $prodesmigratif->img_featured = null;
        }

        if($request->hasFile('featuredImage')){

            $featuredImage = $request->file('featuredImage');
            $filename_featured = uniqid() . '.' . $featuredImage->getClientOriginalExtension();
            $filepath_featured = "uploads/file/prodesmigratif"; 
            $featuredImage->move($filepath_featured, $filename_featured);
            $prodesmigratif->img_featured = $filepath_featured . '/' . $filename_featured;
        }

        if($request->statusThumbnail == "hapus")
        {
            // File::delete($prodesmigratif->img_thumbnail);
            $prodesmigratif->img_thumbnail = null;
        }

        if($request->hasFile('thumbnailImage')){

            $thumbnailImage = $request->file('thumbnailImage');
            $filename_thumbnail = uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();
            $filepath_thumbnail = "uploads/file/prodesmigratif/thumbnails"; 
            $thumbnailImage->move($filepath_thumbnail, $filename_thumbnail);
            $prodesmigratif->img_thumbnail = $filepath_thumbnail . '/' . $filename_thumbnail;
        }
    
        $prodesmigratif->status = $request->nmStatus;


        $prodesmigratif->save();

        return [$prodesmigratif];

        });

    }

    public function store(Request $request)
    {
    
        list($prodesmigratif) = $this->saveProdesmigratif($request);
        $cek_status = $prodesmigratif->status;

        if($cek_status == "draft"){
            $status = "Detail Telah Disimpan";
        }
        else if($cek_status == "terbit"){
            $status = "Detail Telah Disimpan dan Diterbitkan";
        }

        return redirect()->route('prodesmigratif_edit', $prodesmigratif->id)->with('success', $status);
    }

    public function preview($id){

        $prodesmigratif = Prodesmigratif::where('id', $id)
                ->where('status', 'draft')
                ->first();

        if($prodesmigratif == null){
            $prodesmigratif = Prodesmigratif::where('id', $id)
                    ->first();
            return redirect()->route('prodesmigratif_show', $prodesmigratif->slug);
        }
        else{
            return view('pengumuman.preview', [
                'pengumuman' => $prodesmigratif,
            ]);
        }
        
    }

    
    public function update(Request $request, $id)
    {
        $this->savePengumuman($request);
        return redirect()->back()->with('success', 'Data Telah Diperbarui');
    }

    public function show($slug)
    {
        list($get_prodes) = $this->getData();
        $prodesmigratif = $get_prodes->where('slug', $slug)->where('status', 'terbit')->first();
        // $prodesmigratif = Prodesmigratif::where('slug', $slug)
        //                 ->where('status', 'terbit')
        //                 ->first();
        // dd($prodesmigratif);
        if($prodesmigratif == null){
            return redirect()->route('home');
        }
        else{
            return view('prodesmigratif.show', [
                'prodesmigratif' => $prodesmigratif,
            ]);
        }
    }


    public function delete(Request $request)
    {
        $prodesmigratif = Prodesmigratif::find($request->idDelete);
        $prodesmigratif->delete();
        return redirect()->route('prodesmigratif_index')->with('success', 'Data Telah Dihapus Permanen');
    }

    public function front()
    {
        list($get_prodes) = $this->getData();
        $deskripsi = DB::table('deskripsi')->where('kategori', 'prodesmigratif')->first();
        $prodesmigratif_paginate = $get_prodes->paginate(10);
        $search = '';
        $cat = '';
        list($kategori) = $this->getKategori();

        return view('prodesmigratif.front', [
            'deskripsi' => $deskripsi,
            'prodesmigratif_paginate' => $prodesmigratif_paginate,
            'search' => $search,
            'kategori' => $kategori,
            'cat' => $cat,
        ]);
    }

    public function search_front(Request $request)
    {
        list($search, $prodesmigratif_simple, $prodesmigratif_paginate) = $this->search($request);
        $deskripsi = DB::table('deskripsi')->where('kategori', 'prodesmigratif')->first();
        list($kategori) = $this->getKategori();
        $cat = '';
        return view('prodesmigratif.front', [
            'kategori' => $kategori,
            'search' => $search,
            'deskripsi' => $deskripsi,
            'prodesmigratif_paginate' => $prodesmigratif_paginate,
            'cat' => $cat,
        ]);
    }

    public function kategori_front(Request $request)
    {
        $deskripsi = DB::table('deskripsi')->where('kategori', 'prodesmigratif')->first();
        list($kategori) = $this->getKategori();

        $cat = $request->kategori;
        $search = '';
        $query_kategori = DB::table('prodesmigratif')->select('prodesmigratif.*','master_kategori_line.name as kategori')
                ->join('master_kategori_line', 'master_kategori_line.jenis_id', '=', 'prodesmigratif.kategori_id')
                ->where('master_kategori_line.jenis', 'm_prodesmigratif');
                
        if($cat)
        {
            $prodesmigratif_paginate = $query_kategori
                    ->where('prodesmigratif.kategori_id', $cat)->paginate(10);
        }else{
            $prodesmigratif_paginate = $query_kategori->paginate(10);
        }
        

// dd($cat);
        return view('prodesmigratif.front', [
            'kategori' => $kategori,
            'search' => $search,
            'cat' => $cat,
            'deskripsi' => $deskripsi,
            'prodesmigratif_paginate' => $prodesmigratif_paginate,
        ]);
    }
    

}
