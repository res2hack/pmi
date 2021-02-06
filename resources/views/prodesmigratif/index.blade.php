@extends('layouts.admin') 

@section('title')
Kelola Prodesmigratif
@endsection

{{-- @section('style')
<link rel="stylesheet" href="{{ asset('theme/assets/css/datatable/dataTables.bootstrap4.min.css') }}">
@endsection --}}

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-hand-holding-heart font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Prodesmigratif</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Prodesmigratif</span>
        <span class="mx-2">
            /
        </span>
        <a href="{{ route('prodesmigratif_front')}}" target="_blank" title="Tampilan Depan Prodesmigratif"
            class="text-dark"><i class="fas fa-external-link-alt mr-1"></i>
            <u>Tampilan Depan</u>
        </a>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Prodesmigratif</span>
{{-- <a href="{{ route('prodesmigratif_index')}}">Artikel</a> --}}
@endsection

@section('content')
@include('global.notifikasi')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="{{ route('prodesmigratif_create')}}" class="btn btn-primary font-15 py-2" title="Buat Data Baru">
                                <i class="fas fa-plus mr-2"></i>Baru
                            </a>
                            <form action="{{ route('prodesmigratif_search')}}" class="d-inline ">
                                <input type="hidden" name="idProdesmigratif" value="index">
                                <span class="ml-2  pl-2 border  rounded bg-light" style="opacity:0.7;padding-top:10px;padding-bottom:11px;">
                                    <input type="text" name="search" class="font-14 font-weight-bold border-0 bg-transparent" value="{{ $search }}">
                                    <button class="btn"  type="submit"><i class="fas fa-search"></i></button>
                                </span>
                            </form>
                            @if($prodesmigratif_simple->count() > 0)
                                <span class="align-middle font-weight-bold ml-2 border rounded px-2" style="padding-top:10px;padding-bottom:10px;">
                                    {{ ($prodesmigratif_simple->currentpage()-1)* $prodesmigratif_simple->perpage() + 1 }}-{{ ($prodesmigratif_simple->currentpage()-1)* $prodesmigratif_simple->perpage() + $prodesmigratif_simple->count()  }} dari {{ $prodesmigratif_paginate->total() }} data
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <span class="float-right">{{ $prodesmigratif_simple->links() }}</span> 
                        </div>
                        
                    </div>

                    @if($prodesmigratif_simple->count() > 0)
                    <div class="table-responsive mt-2">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="font-15" >Nama Usaha / Produk</th>
                                    <th class="font-15" >Pemilik</th>
                                    <th class="font-15" style="width:15%;">Status</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($prodesmigratif_paginate as $x)
                                <tr>
                                    <td class="py-2">
                                        <strong class="font-15 text-dark">{{ $x->judul }}</strong> 
                                        <br>
                                        <small class="font-12 font-weight-bold text-abu">Kategori: {{ $x->kategori }}</small>
                                        <div class="mt-1">
                                            <small><a href="{{ route('prodesmigratif_show', $x->slug )}}" target="_blank" class="font-12 text-success"><i class="fas fa-link mr-2"></i>Lihat</a></small>
                                            <small class="ml-2"><a href="{{ route('prodesmigratif_edit', $x->id )}}" class="font-12"><i class="fas fa-edit mr-2"></i>Edit</a></small>
                                            <small class="ml-2">
                                                <a href="" onclick="$('#idDelete').val({{ $x->id }});" title="Hapus Data" 
                                                data-toggle="modal" data-target="#modalHapus" class="font-12 text-danger"><i class="fas fa-times mr-2"></i>Hapus</a>
                                            </small>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <strong class="font-15 text-dark">{{ $x->pemilik }}</strong> 
                                        <br>
                                        <div class="font-12">{{ $x->alamat }}</div>
                                        <div class="font-12">{{ $x->kontak }}</div>
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
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="card-body text-center">
                            <h5>Tidak Ada Data</h5>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            {{ $prodesmigratif_paginate->links() }}
                        </div>
                        <div class="col-md-4 text-right pt-2">
                            @if($prodesmigratif_paginate->count() > 0)
                            <span class="font-weight-bold">
                            Menampilkan {{ ($prodesmigratif_paginate->currentpage()-1)* $prodesmigratif_paginate->perpage() + 1 }}-{{ ($prodesmigratif_paginate->currentpage()-1)* $prodesmigratif_paginate->perpage() + $prodesmigratif_paginate->count()  }} dari {{ $prodesmigratif_paginate->total() }} data
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
@include('prodesmigratif.modal')

@endsection

@section('script')

@endsection