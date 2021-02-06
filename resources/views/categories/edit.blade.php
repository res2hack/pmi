@extends('layouts.admin') 

@section('title')
Kelola Kategori Artikel - Edit
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Kategori Artikel</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Kategori Yang Telah Dibuat</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('category_index')}}"><u>Kategori</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Edit</span>
@endsection


@section('content')

@include('global.notifikasi')

<div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('category_update', $category->id)}}">
            @csrf
            <div class="card shadow border-top5 border-form ">
                <div class="font-weight-bold font-20 text-dark p-3 bg-light2">
                    <i class="fas fa-edit text-primary font-16 mx-3"></i>Ubah Kategori
                </div>  
            <div class="card-body mt-0 pb-1 ">
                <div class="form-group">
                    <div class="font-weight-bold font-16 mb-2 text-dark">Nama Kategori</div>
                    <input type="text"  id="nmKategori" name="nmKategori" 
                    class="form-control bg-form h-45 border-form font-weight-bold" value="{{ $category->name }}" 
                    onChange="$('#nmJenisKategori').val($('#nmKategori').val().toLowerCase().replace(/\s/g, '-'));" required>
                    <small class="text-danger">{{ $errors->first('nmKategori') }}</small>
                </div>
                <div class="form-group">
                    <div class="font-weight-bold font-16 mb-2 text-dark">Deskripsi</div>
                    <textarea type="text" name="nmDeskripsi" class="form-control bg-form h-45 border-form" rows="2">{{ $category->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <div class="font-weight-bold font-16 mb-2 text-dark">Slug</div>
                    <input type="text" id="nmJenisKategori" name="nmJenisKategori" class="form-control bg-form h-45 border-form" value="{{ $category->slug }}" >
                    <small class="text-danger">{{ $errors->first('nmJenisKategori') }}</small>
                </div>
            </div>
            <div class="card-footer border-top mt-2 py-3 text-center">
                <button type="submit" class="btn btn-lg btn-dark w-75">
                    <i class="fas fa-check mr-3 font-16"></i><span class="font-18">Perbarui</span></button>
            </div>
        </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('category_search')}}" class="d-inline ">
                    <span class="pl-2 border  rounded bg-light" style="opacity:0.7;padding-top:10px;padding-bottom:11px;">
                        <input type="text" name="search" class="font-14 font-weight-bold border-0 bg-transparent" value="{{ $search }}">
                        <button class="btn"  type="submit"><i class="fas fa-search"></i></button>
                    </span>
                    </form>
                </div>
                <div class="col-md-6">
                    <span class="float-right">{{ $cat_simple->links() }}</span> 
                </div>
                
            </div>

            @if($cat_paginate->total() < 11)
                <div class="table-responsive mt-3">
            @else
                <div class="table-responsive mt-1">
            @endif
                <table class="table table-striped">
                    <thead>
                        <th class="font-15">Nama Kategori</th>
                        <th class="font-15">Deskripsi</th>
                        <th class="">Slug</th>
                        <th class="font-15"></th>
                    </thead>
                    <tbody>
                        @foreach($cat_paginate as $x)
                        <tr>
                            <td class="py-2 font-15 text-dark font-weight-500">
                                {{ $x->name }}
                            </td>
                            <td class="py-2 font-14">{{ $x->deskripsi }}</td>
                            <td class="py-2">/{{ $x->slug }}</td>
                            <td class="py-2 font-14">
                                <a class="mr-1" href="{{ route('category_edit', $x->id )}}"><i class="fas fa-edit"></i></a>
                            </td>
                            
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {{ $cat_paginate->links() }}
                </div>
                <div class="col-md-6 text-right pt-2">
                    @if($cat_paginate->count() > 0)
                    <span class="font-weight-bold">
                    Menampilkan {{ ($cat_paginate->currentpage()-1)* $cat_paginate->perpage() + 1 }}-{{ ($cat_paginate->currentpage()-1)* $cat_paginate->perpage() + $cat_paginate->count()  }} dari {{ $cat_paginate->total() }} Kategori
                    </span>
                    @endif
                </div>
            </div>
            </div>
            
        </div>
    </div>
    
</div>

@endsection

@section('modal')

<form method="POST" action="{{ route('category_delete_index')}}">
    @csrf
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle font-15 text-warning mr-2"></i> KONFIRMASI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda Yakin Ingin Menghapus Data Ini?
                <input id="idDelete" name="idDelete" type="hidden" value="{{ $category->id }}">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-danger">Ya Hapus</button>
            </div>
        
            </div>
        </div>

    </div>
</form>
@endsection


@section('script')

    @include('global.datatable')

@endsection
