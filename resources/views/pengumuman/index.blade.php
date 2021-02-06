@extends('layouts.admin') 

@section('title')
Kelola Pengumuman
@endsection

{{-- @section('style')
<link rel="stylesheet" href="{{ asset('theme/assets/css/datatable/dataTables.bootstrap4.min.css') }}">
@endsection --}}

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-thumbtack font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Pengumuman</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Pengumuman Yang Telah Dibuat</span>
        <span class="mx-2">
            /
        </span>
        <a href="{{ route('pengumuman_front')}}" target="_blank" title="Tampilan Depan Pengumuman"
            class="text-dark"><i class="fas fa-external-link-alt mr-1"></i>
            <u>Tampilan Depan</u>
        </a>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Pengumuman</span>
{{-- <a href="{{ route('pengumuman_index')}}">Artikel</a> --}}
@endsection

@section('content')
@include('global.notifikasi')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="{{ route('pengumuman_create')}}" class="btn btn-primary font-15 py-2" title="Buat Pengumuman Baru">
                                <i class="fas fa-plus mr-2"></i>Baru
                            </a>
                            <a href="{{ route('pengumuman_sampah')}}" class="btn btn-danger font-15 py-2 ml-2" 
                                title="Keranjang Sampah - @if($jumlahSampah !== 0) Ada {{ $jumlahSampah }} pengumuman dalam keranjang sampah @else Tidak Ada Sampah @endif">
                                <i class="fas fa-trash"></i> <span class="font-10 bg-dark rounded px-1 ml-1">{{ $jumlahSampah }}</span>
                            </a>
                            <form action="{{ route('pengumuman_search')}}" class="d-inline ">
                                <input type="hidden" name="idpengumuman" value="index">
                                <span class="ml-2  pl-2 border  rounded bg-light" style="opacity:0.7;padding-top:10px;padding-bottom:11px;">
                                    <input type="text" name="search" class="font-14 font-weight-bold border-0 bg-transparent" value="{{ $search }}">
                                    <button class="btn"  type="submit"><i class="fas fa-search"></i></button>
                                </span>
                            </form>
                            @if($pengumuman_simple->count() > 0)
                                <span class="align-middle font-weight-bold ml-2 border rounded px-2" style="padding-top:10px;padding-bottom:10px;">
                                    {{ ($pengumuman_simple->currentpage()-1)* $pengumuman_simple->perpage() + 1 }}-{{ ($pengumuman_simple->currentpage()-1)* $pengumuman_simple->perpage() + $pengumuman_simple->count()  }} dari {{ $pengumuman_paginate->total() }} pengumuman
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <span class="float-right">{{ $pengumuman_simple->links() }}</span> 
                        </div>
                        
                    </div>

                    @if($pengumuman_simple->count() > 0)
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
                                @foreach($pengumuman_paginate as $x)
                                <tr>
                                    <td class="py-2">
                                        <strong class="font-15 text-dark">{{ $x->title }}</strong> 
                                        <br>
                                        <small class="font-11">/{{ $x->slug }}</small>
                                        <div class="mt-1">
                                            <small><a href="{{ route('pengumuman_show', $x->slug )}}" target="_blank" class="font-12 text-success"><i class="fas fa-link mr-2"></i>Lihat</a></small>
                                            <small class="ml-2"><a href="{{ route('pengumuman_edit', $x->id )}}" class="font-12"><i class="fas fa-edit mr-2"></i>Edit</a></small>
                                            <small class="ml-2">
                                                <a href="" onclick="$('#idDelete').val({{ $x->id }});" title="Hapus Pengumuman" 
                                                data-toggle="modal" data-target="#exampleModalCenter" class="font-12 text-danger"><i class="fas fa-times mr-2"></i>Hapus</a>
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
                                        <small>
                                            @foreach($arr_user as $user)
                                                @if($user->id === $x->create_uid)
                                                {{ $user->name }}
                                                @endif
                                            @endforeach
                                        </small>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="card-body text-center">
                            <h5>Tidak Ada Pengumuman</h5>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            {{ $pengumuman_paginate->links() }}
                        </div>
                        <div class="col-md-4 text-right pt-2">
                            @if($pengumuman_paginate->count() > 0)
                            <span class="font-weight-bold">
                            Menampilkan {{ ($pengumuman_paginate->currentpage()-1)* $pengumuman_paginate->perpage() + 1 }}-{{ ($pengumuman_paginate->currentpage()-1)* $pengumuman_paginate->perpage() + $pengumuman_paginate->count()  }} dari {{ $pengumuman_paginate->total() }} pengumuman
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

<form method="POST" action="{{ route('pengumuman_softdelete')}}">
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
                Anda Yakin Ingin Menghapus Pengumuman Ini?
                <input id="idDelete" name="idDelete" type="hidden">
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

@endsection