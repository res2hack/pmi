<?php

namespace App\Http\Controllers\PostPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostPage as Post;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Category as Category;
use Conner\Tagging\Model\Tagged as Tagged;
use Illuminate\Support\Facades\Auth;
use DataTables;

class PostController extends Controller
{

    public function typeId()
    {
        $get_tipe = DB::table('post_type')->where('name', 'post')->pluck('id')->first();
        return $get_tipe;
    }

    public function getData(){

        $type_id = $this->typeId();

        $get_post = DB::table('post_pages')
        ->select('post_pages.*', 'post_category.id as id_kategori', 
            'post_category.name as kategori', 'post_category.slug as slug_kategori')
        ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
        ->where('post_pages.type_id', $type_id);

        return [$type_id, $get_post];
        
    }

    public function countSampah()
    {
        $type_id = $this->typeId();
        $count_sampah = Post::where('post_pages.type_id', $type_id)
                        ->whereNotNull('post_pages.delete_date')
                        ->count();
                        
        return $count_sampah;
    }

    public function index()
    {
        list($type_id, $get_post) = $this->getData();
        
        $post = $get_post->whereNull('post_pages.delete_date')
                ->orderBy('id', 'Desc');
    
        $post_simple = $post->simplePaginate(20);
        $post_paginate = $post->paginate(20);
        $search = '';

        $jumlahSampah = $this->countSampah();

        $create_uid = $post_simple->pluck('create_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $create_uid)
                ->get();
        
        $arr_user = arr::flatten($user);
        
        return view('posts.index', [
            'post_paginate' => $post_paginate,
            'post_simple' => $post_simple,
            'search' => $search,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function search(Request $request)
    {
        $type_id = $this->typeId();

        $search = $request->search;

        $query_post = DB::table('post_pages')
                ->select('post_pages.*', 'post_category.id as id_kategori', 
                    'post_category.name as kategori', 'post_category.slug as slug_kategori')
                ->where('post_pages.type_id', $type_id)
                ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
                ->where(function($query) use ($search) {
                            $query->where('title', 'like', '%' . $search . '%')
                            ->orWhere('content', 'like', '%' . $search . '%')
                            ->orWhere('status', 'like', '%' . $search . '%')
                            ->orWhere('create_date', 'like', '%' . $search . '%');
                        });

        if($request->idpost == "index")
        {
            $post = $query_post->whereNull('delete_date')
                    ->orderBy('delete_date', 'Desc');
        }
        else{
            $post = $query_post->whereNotNull('delete_date')
            ->orderBy('delete_date', 'Desc');
        }

        $post_simple = $post->simplePaginate(10)->withQueryString();
        $post_paginate = $post->paginate(10)->withQueryString();
        $jumlahSampah = $this->countSampah();

        $create_uid = $post_simple->pluck('create_uid');
        $user = DB::table('users')->select('id','name')
                ->whereIn('id', $create_uid)
                ->get();
        
        $arr_user = arr::flatten($user);

        return [$search, $post_simple, $post_paginate, $jumlahSampah, $arr_user];
    }

    public function search_index(Request $request){

        list($search, $post_simple, $post_paginate,
            $jumlahSampah, $arr_user) = $this->search($request);

        return view('posts.index', [
            'post_paginate' => $post_paginate,
            'post_simple' => $post_simple,
            'search' => $search,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function cari(Request $request)
    {
        $type_id = $this->typeId();
        $search = $request->search;
        $post = DB::table('post_pages')
        ->select('post_pages.*', 'post_category.id as id_kategori', 
            'post_category.name as kategori', 'post_category.slug as slug_kategori')
        ->where('post_pages.type_id', $type_id)
        ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
        ->where(function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('create_date', 'like', '%' . $search . '%');
                })
        ->paginate(10)->withQueryString();

            //    dd($post);
        list($recent_posts) = $this->recent_post();

        return view('posts.cari', [
            'post' => $post,
            'recent_posts' => $recent_posts,
            'search' => $search,
        ]);
    }

    public function search_sampah(Request $request)
    {
        list($search, $post_simple, $post_paginate, 
            $jumlahSampah, $arr_user) = $this->search($request);
            
        return view('posts.sampah', [
            'search' => $search,
            'post_paginate' => $post_paginate,
            'post_simple' => $post_simple,
            'jumlahSampah' => $jumlahSampah,
            'arr_user' => $arr_user,
        ]);
    }

    public function create()
    {
        
        $category = Category::get();
        return view('posts.create', [
            'category' => $category,
        ]);
    }

    public function edit($id)
    {
        // $post = Post::find($id);

        $post = DB::table('post_pages')
        ->select('post_pages.*', 'post_category.id as id_kategori', 
            'post_category.name as kategori', 'post_category.slug as slug_kategori')
        ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
        ->where('post_pages.id', $id)
        ->first();

        $category = Category::get();
        $cek_tags = DB::table('tagging_tagged')
                ->where('taggable_type', 'App\Models\PostPage')
                ->where('taggable_id', $id)
                ->get();
        $post_tags=[];
        foreach($cek_tags as $x){
            array_push($post_tags, $x->tag_name);
        }

        $tags = implode(',', $post_tags); 

        return view('posts.edit', [
            'post' => $post,
            'category' => $category,
            'tags' => $tags,
        ]);
    }

    public function saveArtikel(Request $request)
    {

        return DB::transaction(function () use ($request) {

        $user = Auth::user();


        if($request->post_tipe == "baru"){
            // Artikel Baru
            $this->validate($request, 
                ['nmJudul' => 'unique:post_pages,title',
                    'nmJenisKategori' => 'unique:post_pages,slug'],
                ['nmJudul.unique' => '* Judul ini sudah digunakan oleh artikel lainnya',
                    'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh artikel lainnya']
            );

            $type_id = $this->typeId();

            $post = new Post();
            $post->type_id = $type_id;
            $post->create_uid = $user->id;
            $post->create_date = now();
        }
        else{
            // Update Artikel
            $post = Post::find($request->idArtikel);
            $this->validate($request, 
            ['nmJudul' => 'unique:post_pages,title,' . $request->idArtikel,
            'nmJenisKategori' => 'unique:post_pages,slug,' . $request->idArtikel],
            ['nmJudul.unique' => '* Judul ini sudah digunakan oleh artikel lainnya',
            'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh artikel lainnya']
        );
            $post->write_uid = $user->id;
            $post->write_date = now();
            
        }

        $konten = $request->nmKonten;
        
        $post->title = $request->nmJudul;
        
        $post->slug = $request->nmJenisKategori;

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
                      /* ->resize(300, 200) */
                    ->encode($mimetype, 100)  // encode file to the specified mimetype
                    ->save(public_path($filepath));                
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                } 
                
            }

            $konten_filter = $dom->saveHTML();

            $post->content = $konten_filter;
        }
        
        if($request->statusFeatured == "hapus")
        {
            // File::delete($post->img_featured);
            $post->img_featured = null;
        }

        if($request->hasFile('featuredImage')){

            $featuredImage = $request->file('featuredImage');
            // $mimetype_featured = $featuredImage->getMimeType();
            $filename_featured = uniqid() . '.' . $featuredImage->getClientOriginalExtension();
        
            $filepath_featured = "uploads/$tahun"; 

            $featuredImage->move($filepath_featured, $filename_featured);

            $post->img_featured = $filepath_featured . '/' . $filename_featured;
        }

        if($request->statusThumbnail == "hapus")
        {
            // File::delete($post->img_thumbnail);
            $post->img_thumbnail = null;
        }

        if($request->hasFile('thumbnailImage')){

            $thumbnailImage = $request->file('thumbnailImage');
            // $mimetype_featured = $featuredImage->getMimeType();
            $filename_thumbnail = uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();
        
            $filepath_thumbnail = "uploads/$tahun/thumbnails"; 

            $thumbnailImage->move($filepath_thumbnail, $filename_thumbnail);

            $post->img_thumbnail = $filepath_thumbnail . '/' . $filename_thumbnail;
        }
        
        $post->meta_title = $request->metaTitle;
        $post->meta_description = $request->metaDescription;

        $post->status = $request->nmStatus;
        $post->category_id = $request->nmKategori;

        if(!$request->nmTerbitDate){
            $post->published_date = now();
        }

        $post->save();

        // Save Tags
        
        if($request->post_tipe !== "baru"){
            // Jika Update, tag lama dihapus dulu
            $faketags = explode(",", $request->tagsfake);
            $post->untag($faketags);
        }

        $tags = explode(",", $request->tags);
        $post->tag($tags);

        return [$post, $tags];

        });

    }

    public function store(Request $request)
    {
        list($post, $tags) = $this->saveArtikel($request);
        $cek_status = $post->status;
        if($cek_status == "draft"){
            $status = "Artikel Telah Disimpan";
        }
        else if($cek_status == "terbit"){
            $status = "Artikel Telah Disimpan dan diterbitkan";
        }

        return redirect()->route('post_edit', $post->id)->with('success', $status);
    }

    public function recent_post()
    {
        $type_id = $this->typeId();

        $recent_posts =  DB::table('post_pages')
                ->select('post_pages.id', 'post_pages.title', 'post_pages.slug', 'post_pages.img_featured',
                        'post_pages.img_thumbnail', 'post_pages.published_date',
                        'post_category.id as id_kategori', 
                        'post_category.name as kategori', 'post_category.slug as slug_kategori')
                ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
                ->where('post_pages.type_id', $type_id)
                ->where('post_pages.status', 'terbit')
                ->orderBy('post_pages.id', 'desc')
                ->limit(5)
                ->get();

        // harus array (get)
        return [$recent_posts];

    }

    public function preview($id){

        $post = DB::table('post_pages')
                ->select('post_pages.*', 'post_category.id as id_kategori', 
                    'post_category.name as kategori', 'post_category.slug as slug_kategori')
                ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
                ->where('post_pages.id', $id)
                ->where('post_pages.status', 'draft')
                ->first();

        if($post == null){
            $post = Post::where('post_pages.id', $id)
                    ->first();
            return redirect()->route('post_show', $post->slug);
        }
        else{
            $related =  DB::table('post_pages')
            ->select('post_pages.*', 'post_category.id as id_kategori', 
                'post_category.name as kategori', 'post_category.slug as slug_kategori')
            ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
            ->where('post_category.slug', $post->slug_kategori)
            ->where('post_pages.status', 'terbit')
            ->where('post_pages.id', '<>', $post->id)
            ->orderBy('post_pages.id', 'desc')
            ->limit(4)
            ->get();
    
            list($recent_posts) = $this->recent_post();
            
            return view('posts.preview', [
                'post' => $post,
                'related' => $related,
                'recent_posts' => $recent_posts,
            ]);
        }
    }

    public function show($kategori, $slug)
    {
        $post = DB::table('post_pages')
                ->select('post_pages.*', 'post_category.id as id_kategori', 
                    'post_category.name as kategori', 'post_category.slug as slug_kategori')
                ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
                ->where('post_category.slug', $kategori)
                ->where('post_pages.slug', $slug)
                ->where('post_pages.status', 'terbit')
                ->first();

        if($post == null){
            return redirect()->route('home');
        }
        else{
            $category = DB::table('post_category')->where('id', $post->id_kategori)->first();

            $cek_tags = DB::table('tagging_tagged')
            ->where('taggable_type', 'App\Models\PostPage')
            ->where('taggable_id', $post->id)
            ->get();

            $tags=[];
            foreach($cek_tags as $x){
                array_push($tags, $x->tag_name);
            }

            // $tags = implode(',', $post_tags); 
            

            $related =  DB::table('post_pages')
            ->select('post_pages.*', 'post_category.id as id_kategori', 
                'post_category.name as kategori', 'post_category.slug as slug_kategori')
            ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
            ->where('post_category.slug', $kategori)
            ->where('post_pages.status', 'terbit')
            ->where('post_pages.id', '<>', $post->id)
            ->orderBy('post_pages.id', 'desc')
            ->limit(4)
            ->get();

            list($recent_posts) = $this->recent_post();
            return view('posts.show', [
                'post' => $post,
                'category' => $category,
                'related' => $related,
                'recent_posts' => $recent_posts,
                'tags' => $tags,
            ]);
        }
    }

    public function post_category($kategori)
    {
        $type_id = $this->typeId();

        $post = DB::table('post_pages')
                ->select('post_pages.*', 'post_category.id as id_kategori', 
                    'post_category.name as kategori', 'post_category.slug as slug_kategori')
                ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
                ->where('post_pages.type_id', $type_id)
                ->where('post_category.slug', $kategori)
                ->orderBy('id', 'Desc')
                ->paginate(10);
        
        $category = DB::table('post_category')
                    ->where('slug', $kategori)->first();

        return view('posts.bykategori', [
            'post' => $post,
            'category' => $category,
        ]);
    }

    public function update(Request $request)
    {
        $this->saveArtikel($request);
        return redirect()->back()->with('success', 'Artikel Telah Diperbarui');
    }

    public function softdelete(Request $request)
    {
        $user = Auth::user();
        $post = Post::find($request->idDelete);
        $post->delete_uid = $user->id;
        $post->delete_date = now();
        $post->save();

        return redirect()->back()->with('success', 'Artikel telah dihapus dan dimasukkan keranjang sampah');
    }

    public function sampah(){
        list($type_id, $get_post) = $this->getData();

        $post = $get_post->whereNotNull('post_pages.delete_date')
                ->orderBy('id', 'Desc');

        $post_simple = $get_post->simplePaginate(20);
        $post_paginate = $get_post->paginate(20);
        $search = '';

        return view('posts.sampah', [
            'post_paginate' => $post_paginate,
            'post_simple' => $post_simple,
            'search' => $search,
        ]);
    }

    public function restore(Request $request)
    {
        $user = Auth::user();
        $post = Post::find($request->idRestore);
        $post->delete_uid = null;
        $post->delete_date = null;
        $post->save();
        return redirect()->route('post_index')->with('success', 'Artikel Telah Di-Restore');
    }

    public function delete(Request $request)
    {
        $post = Post::find($request->idDelete);
        $post->delete();
        return redirect()->route('post_index')->with('success', 'Artikel Telah Dihapus Permanen');
    }


    public function portal()
    {
        $type_id = $this->typeId();

        $post = DB::table('post_pages')
        ->select('post_pages.*', 'post_category.id as id_kategori', 
            'post_category.name as kategori', 'post_category.slug as slug_kategori')
        ->join('post_category', 'post_category.id', '=', 'post_pages.category_id')
        ->where('post_pages.type_id', $type_id)
        ->orderBy('id', 'Desc')
        ->limit(10)
        ->get();

        $id_pengumuman = DB::table('post_type')->where('name', 'pengumuman')->pluck('id')->first();

        $pengumuman = DB::table('post_pages')
        ->where('post_pages.type_id', $id_pengumuman)
        ->orderBy('id', 'Desc')
        ->limit(5)
        ->get();

        // dd($pengumuman);
        return view('posts.portal', [
            'post' => $post,
            'pengumuman' => $pengumuman,
        ]);
    }

}
