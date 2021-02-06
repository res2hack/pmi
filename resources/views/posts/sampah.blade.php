@extends('layouts.admin') 

@section('title')
Kelola Berita & Artikel
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-align-left font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Berita & Artikel</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Sampah</span></div>
            
        <span class="font-weight-500">Daftar Artikel Yang Telah Dihapus <i class="fas fa-trash text-danger ml-2"></i></span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('post_index')}}"><u>Artikel</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Sampah</span>
{{-- <a href="{{ route('post_index')}}">Artikel</a> --}}
@endsection

@section('content')
@include('global.notifikasi')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">

                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="{{ route('post_create')}}" class="btn btn-dark font-15 py-2" title="Kembali ke Halaman Indeks">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <form action="{{ route('post_search_sampah')}}" class="d-inline ">
                            <input type="hidden" name="idpost" value="sampah">
                            <span class="ml-2  pl-2 border  rounded bg-light" style="opacity:0.7;padding-top:10px;padding-bottom:11px;">
                                <input type="text" name="search" class="font-14 font-weight-bold border-0 bg-transparent" value="{{ $search }}">
                                <button class="btn"  type="submit"><i class="fas fa-search"></i></button>
                            </span>
                            </form>
                            @if($post_simple->count() > 0)
                                <span class="align-middle font-weight-bold ml-2 border rounded px-2" style="padding-top:10px;padding-bottom:10px;">
                                    {{ ($post_simple->currentpage()-1)* $post_simple->perpage() + 1 }}-{{ ($post_simple->currentpage()-1)* $post_simple->perpage() + $post_simple->count()  }} dari {{ $post_paginate->total() }} artikel
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <span class="float-right">{{ $post_simple->links() }}</span> 
                        </div>
                        
                    </div>
                    @if($post_simple->count() > 0)
                    <div class="table-responsive mt-2">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="font-15" >Judul</th>
                                    <th class="font-15" style="width:15%;">Status</th>
                                    <th class="font-15" style="width:13%;">SEO Meta</th>
                                    <th class="font-15" style="width:16%;">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($post_paginate as $x)
                                <tr>
                                    <td class="py-2">
                                        <strong class="font-15 text-dark">{{ $x->title }}</strong> 
                                        <br>
                                        <small class="font-11">/{{ $x->slug }}</small>
                                        <div class="mt-1">
                                            <small class="ml-2"><a href="{{ route('post_edit', $x->id )}}" class="font-12"><i class="fas fa-angle-right mr-2"></i>Detail</a></small>
                                            <small class="ml-2">
                                                <a href="" onclick="$('#idRestore').val({{ $x->id }});" title="Kembalikan Artikel" 
                                                data-toggle="modal" data-target="#modalRestore" class="font-12 text-success"><i class="fas fa-reply mr-2"></i>Restore</a>
                                            </small>
                                            <small class="ml-2">
                                                <a href="" onclick="$('#idDelete').val({{ $x->id }});" title="Hapus Permanen" 
                                                data-toggle="modal" data-target="#modalHapus" class="font-12 text-danger"><i class="fas fa-times mr-2"></i>Hapus Permanen</a>
                                            </small>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        @if($x->status === "draft")
                                            <i class="fas fa-circle mr-1 font-10 text-warning"></i>
                                            <span class="text-capitalize font-weight-bold text-warning">
                                                {{ $x->status }}
                                            </span>
                                        @elseif($x->status === "terbit")
                                            <i class="fas fa-circle mr-2 font-9 text-primary"></i>
                                            <span class="text-capitalize font-weight-bold font-12 text-primary">
                                                {{ $x->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2">
                                        <div class="font-12">Title : @if($x->meta_title) <i class="ml-1 fas fa-check text-success"></i> @else <i class="ml-1 fas fa-minus"></i> @endif</div>
                                        <div class="font-12">Desc: @if($x->meta_description) <i class="ml-1 fas fa-check text-success"></i> @else <i class="ml-1 fas fa-minus"></i> @endif</div>
                                    </td>
                                    <td class="text-capitalize py-2">
                                        <span class="font-12 font-weight-bold text-dark">{{ \Carbon\Carbon::parse($x->published_date)->format('d-m-Y') }}</span>
                                        <br>
                                        <small> oleh {{ Auth::user()->name }}</small>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="card-body text-center">
                            <h5>Tidak ada artikel</h5>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            {{ $post_paginate->links() }}
                        </div>
                        <div class="col-md-4 text-right pt-2">
                            @if($post_paginate->count() > 0)
                            <span class="font-weight-bold">
                            Menampilkan {{ ($post_paginate->currentpage()-1)* $post_paginate->perpage() + 1 }}-{{ ($post_paginate->currentpage()-1)* $post_paginate->perpage() + $post_paginate->count()  }} dari {{ $post_paginate->total() }} artikel
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('posts.modal-sampah')

