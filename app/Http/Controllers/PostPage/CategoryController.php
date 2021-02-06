<?php

namespace App\Http\Controllers\PostPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category as Category;
use Arr;


class CategoryController extends Controller
{

    public function getData()
    {
        $cat_simple = Category::simplePaginate(10);
        $cat_paginate = Category::paginate(10);
        $search = '';

        return [$cat_simple, $cat_paginate, $search];
    }

    public function index()
    {
        list($cat_simple, $cat_paginate, $search) = $this->getData();

        return view('categories.index', [
            'cat_simple' => $cat_simple,
            'cat_paginate' => $cat_paginate,
            'search' => $search,
        ]);
    }

    public function search(Request $request){

        $search = $request->search;

        $category = Category::where('name', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');

        $cat_simple = $category->simplePaginate(10)->withQueryString();
        $cat_paginate = $category->paginate(10)->withQueryString();

        return view('categories.index', [
            'cat_simple' => $cat_simple,
            'cat_paginate' => $cat_paginate,
            'search' => $search,
        ]);
    }

    public function create()
    {
        
        return view('categories.create', [
        
        ]);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        list($cat_simple, $cat_paginate, $search) = $this->getData();

        return view('categories.edit', [
            'category' => $category,
            'cat_simple' => $cat_simple,
            'cat_paginate' => $cat_paginate,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, 
                ['nmKategori' => 'unique:post_category,name',
                    'nmJenisKategori' => 'unique:post_category,slug'],
                ['nmKategori.unique' => '* Kategori Sudah Ada',
                    'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh kategori lainnya']
            );

        $category = new Category();
        $category->name = $request->nmKategori;
        $category->deskripsi = $request->nmDeskripsi;
        $category->slug = $request->nmJenisKategori;

        $category->save();

        return redirect()->back()->with('success', 'Kategori Ditambahkan');
    
    }

    public function update(Request $request, $id)
    {
    
        $this->validate($request, 
            ['nmKategori' => 'unique:post_category,name,' . $id,
                'nmJenisKategori' => 'unique:post_category,slug,' . $id],
            ['nmKategori.unique' => '* Kategori Sudah Ada',
                'nmJenisKategori.unique' => '* Slug ini sudah digunakan oleh kategori lainnya']
        );

        $category = Category::find($id);
        $category->name = $request->nmKategori;
        $category->deskripsi = $request->nmDeskripsi;
        $category->slug = $request->nmJenisKategori;

        $category->save();
        return redirect()->route('category_index')->with('success', 'Kategori Diperbarui');
    }

    public function delete_index(Request $request)
    {
        $cek_post = DB::table('post_pages')->where('category_id', $request->idDelete)->count();

        if($cek_post < 1){
            Category::find($request->idDelete)->delete();
            return redirect()->route('category_index')->with('success', 'Kategori telah dihapus');
        }
        else{
            return redirect()->back()->with('error', 'Kategori Tidak Bisa Dihapus Karena Masih Terkait Dengan Beberapa Artikel.');
        }
        
        return redirect()->back();
    }

   

}
