@extends('layouts.admin') 

@section('title')
Kelola Data Pengirim - Detail
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
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengirim</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('pengirim_create')}}" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="{{ route('pengirim_edit', $pengirim->id)}}" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Pengirim <i class="far fa-file-alt ml-2"></i></span>
        
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pengirim_index')}}"><u>Pengirim</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Detail</span>
@endsection

@section('content')

@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="{{ route('pengirim_index')}}" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="{{ route('pengirim_edit', $pengirim->id)}}" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="{{ route('pengirim_delete')}}" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val({{ $pengirim->id }});" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kode</div>
            <div class="py-2 col-9 font-weight-500 text-primary">
                {{ $pengirim->kode }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pengirim</div>
            <div class="py-2 col-9 font-weight-500 text-primary">
                {{ $pengirim->nama }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pemilik</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pengirim->pemilik }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Keputusan</div>
            <div class="py-2 col-9 font-weight-500">
                {{ $pengirim->keputusan }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Telepon</div>
            <div class="py-2 col-9 font-weight-500">
                {{ $pengirim->telepon }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Fax</div>
            <div class="py-2 col-9 font-weight-500">
                {{ $pengirim->fax }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Alamat</div>
            <div class="py-2 col-9 font-weight-500">
                {{ $pengirim->alamat }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">A. Penampungan</div>
            <div class="py-2 col-9 font-weight-500">
                {{ $pengirim->alamat_penampungan }}
            </div>
        </div>
       
    </div>
</div>

@endsection

@section('modal')

<form method="POST" action="{{ route('pengirim_delete')}}">
    @csrf
    @include('sistem.master.pengirim.modal-del')
</form>
@endsection