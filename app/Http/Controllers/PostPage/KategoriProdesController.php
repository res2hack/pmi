<?php

namespace App\Http\Controllers\PostPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterKategoriLine as MasterKategoriLine;
use Arr;


class KategoriProdesController extends Controller
{

    public function getKategori()
    {
        $kategori = DB::table('master_kategori_line')
                        ->where('jenis', 'm_prodesmigratif');
        return [$kategori];
    }

    
    public function index()
    {
        
        list($kategori) = $this->getKategori();
        $kat_paginate = $kategori->paginate(10);
        $kat_simple = $kategori->simplePaginate(10);
        $search = '';
        return view('prodesmigratif.kategori', [
            'kat_paginate' => $kat_paginate,
            'kat_simple' => $kat_simple,
            'search' => $search,
        ]);
    }

    public function search(Request $request)
    {
    
        $search = $request->search;
        list($kategori) = $this->getKategori();
        
        $query_kategori = DB::table('master_kategori_line')
                ->where('jenis', 'm_prodesmigratif')
                ->where('name', 'like', '%' . $search . '%');

        $kat_simple = $query_kategori->simplePaginate(10)->withQueryString();
        $kat_paginate = $query_kategori->paginate(10)->withQueryString();
        
        return [$search, $kat_simple, $kat_paginate];
    }

    public function search_index(Request $request)
    {
        list($search, $kat_simple, $kat_paginate) = $this->search($request);
    
        return view('prodesmigratif.kategori', [
            'search' => $search,
            'kat_paginate' => $kat_paginate,
            'kat_simple' => $kat_simple,
        ]);
    }


    public function edit($id)
    {
        $kat = MasterKategoriLine::find($id);

        list($kategori) = $this->getKategori();
        $kat_paginate = $kategori->paginate(10);
        $kat_simple = $kategori->simplePaginate(10);
        $search = '';
        return view('prodesmigratif.kategori-edit', [
            'kategori' => $kategori,
            'kat_simple' => $kat_simple,
            'kat_paginate' => $kat_paginate,
            'kat' => $kat,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {
        $max_jenis_id = DB::table('master_kategori_line')
        ->where('jenis', 'm_prodesmigratif')
        ->orderBy('jenis_id', 'desc')
        ->pluck('jenis_id')
        ->first();

        $kategori = new MasterKategoriLine();
        $kategori->jenis = 'm_prodesmigratif';
        $kategori->jenis_id = $max_jenis_id + 1;
        $kategori->name = $request->nmKategori;
        $kategori->save();

        return redirect()->back()->with('success', 'Kategori Ditambahkan');
    
    }

    public function update(Request $request, $id)
    {
    
        $kategori = MasterKategoriLine::find($id);
        $kategori->name = $request->nmKategori;
        $kategori->save();
        
        return redirect()->route('kategori_prodesmigratif')->with('success', 'Kategori Diperbarui');
    }

    public function delete(Request $request)
    {
        $cek_post = DB::table('prodesmigratif')->where('kategori_id', $request->idDelete)->count();

        if($cek_post < 1){
            MasterKategoriLine::find($request->idDelete)->delete();
            return redirect()->route('kategori_prodesmigratif')->with('success', 'Kategori telah dihapus');
        }
        else{
            return redirect()->back()->with('error', 'Kategori Tidak Bisa Dihapus Karena Masih Terkait Dengan Beberapa Artikel.');
        }
        
        return redirect()->back();
    }


}
