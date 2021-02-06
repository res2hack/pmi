@extends('layouts.admin') 

@section('title')
Kelola Data Disnaker - Detail
@endsection

@section('style')
<style>
    .dropdown-toggle::after {
    display: none !important;
}
</style>
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Disnaker</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('disnaker_create')}}" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="{{ route('disnaker_edit', $direktori->id)}}" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Data Disnaker <i class="far fa-file-alt ml-2"></i></span>
        
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('disnaker_index')}}"><u>Disnaker</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Detail</span>
<input type="hidden" name="jenisDirektori" value="disnaker">
@endsection

@section('content')

@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="{{ route('disnaker_index')}}" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="{{ route('disnaker_edit', $direktori->id)}}" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="{{ route('disnaker_delete')}}" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val({{ $direktori->id }});" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Nama Dinas</div>
            <div class="py-2 col-9 font-weight-500 text-primary">
                {{ $direktori->nama }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Alamat</div>
            <div class="py-2 col-9 font-weight-500">
                {{ $direktori->alamat }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kontak</div>
            <div class="py-2 col-9 font-weight-500">
                {{ $direktori->kontak }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Tampil</div>
            <div class="py-2 col-9 font-weight-500 ">
                @if($direktori->sts_tampil == 0)
                    <i class="font-15 far fa-times-circle text-danger"></i>
                @else
                    <i class="font-15 far fa-check-circle text-success"></i>
                @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Valid</div>
            <div class="py-2 col-9 font-weight-500 ">
                @if($direktori->sts_valid == 0)
                    <i class="font-15 far fa-times-circle text-danger"></i>
                @else
                    <i class="font-15 far fa-check-circle text-success"></i>
                @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Detail</div>
            <div class="py-2 col-9 font-weight-500">
                {!! $direktori->detail !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

<form method="POST" action="{{ route('disnaker_delete')}}">
    @csrf
    @include('sistem.direktori.modal-del')
</form>
@endsection