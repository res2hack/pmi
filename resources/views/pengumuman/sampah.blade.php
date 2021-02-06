@extends('layouts.admin') 

@section('title')
Kelola Pengumuman
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-thumbtack font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Pengumuman</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Sampah</span></div>
            
        <span class="font-weight-500">Daftar Pengumuman Yang Telah Dihapus <i class="fas fa-trash text-danger ml-2"></i></span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pengumuman_index')}}"><u>Pengumuman</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Sampah</span>
@endsection

@section('content')
@include('global.notifikasi')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">

                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="{{ route('pengumuman_index')}}" class="btn btn-dark font-15 py-2" title="Kembali ke Halaman Indeks">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <form action="{{ route('pengumuman_search_sampah')}}" class="d-inline ">
                                <input type="hidden" name="idpengumuman" value="sampah">
                                <span class="ml-2  pl-2 border  rounded bg-light" style="opacity:0.7;padding-top:10px;padding-bottom:11px;">
                                    <input type="text" name="search" class="font-14 font-weight-bold border-0 bg-transparent" value="{{ $search }}">
                                    <button class="btn"  type="submit"><i class="fas fa-search"></i></button>
                                </span>
                            </form>
                            @if($pengumuman_simple->count() > 0)
                                <span class="align-middle font-weight-bold ml-2 border rounded px-2" style="padding-top:10px;padding-bottom:10px;">
                                    {{ ($pengumuman_simple->currentpage()-1)* $pengumuman_simple->perpage() + 1 }}-{{ ($pengumuman_simple->currentpage()-1)* $pengumuman_simple->perpage() + $pengumuman_simple->count()  }} dari {{ $pengumuman_paginate->total() }} artikel
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
                                    <th class="font-15">Judul</th>
                                    <th class="font-15">Tanggal Dihapus</th>
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
                                            <small class="ml-2"><a href="{{ route('pengumuman_edit', $x->id )}}" class="font-12"><i class="fas fa-angle-right mr-2"></i>Detail</a></small>
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
                                    <td class="text-capitalize py-2">
                                        <span class="font-12 font-weight-bold text-dark">{{ \Carbon\Carbon::parse($x->delete_date)->format('d-m-Y') }}</span>
                                        <br>
                                        <small>
                                            @foreach($arr_user as $user)
                                                @if($user->id === $x->delete_uid)
                                                {{ $user->name }}
                                                @endif
                                            @endforeach
                                        </small>
                                        {{-- <small>@if (in_array($x->delete_uid, $arr_user["|".$x->id])) {{ $arr_user["|".$x->id] }} @endif</small> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="card-body text-center">
                                <h5>Tidak Ada Pengumuman</h5>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            {{ $pengumuman_paginate->links() }}
                        </div>
                        <div class="col-md-4 text-right pt-2">
                            @if($pengumuman_paginate->count() > 0)
                            <span class="font-weight-bold">
                            Menampilkan {{ ($pengumuman_paginate->currentpage()-1)* $pengumuman_paginate->perpage() + 1 }}-{{ ($pengumuman_paginate->currentpage()-1)* $pengumuman_paginate->perpage() + $pengumuman_paginate->count()  }} dari {{ $pengumuman_paginate->total() }} artikel
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection

@include('pengumuman.modal-sampah')

