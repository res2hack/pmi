@extends('layouts.admin') 

@section('title')
Kelola Data Jadwal Kedatangan - Detail
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Jadwal Kedatangan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('jadwal_kedatangan_create')}}" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="{{ route('jadwal_kedatangan_edit', $jdkedatangan->id)}}" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Kedatangan <i class="far fa-file-alt ml-2"></i></span>
        <span class="mx-2">/</span>
        <span class="font-weight-bold text-dark">#{{ $jdkedatangan->no_penerbangan?:"-" }}</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('jadwal_kedatangan_index')}}"><u>Jadwal Kedatangan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Detail</span>
@endsection

@section('content')

@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="{{ route('jadwal_kedatangan_index')}}" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="{{ route('jadwal_kedatangan_edit', $jdkedatangan->id)}}" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="{{ route('jadwal_kedatangan_delete')}}" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val({{ $jdkedatangan->id }});" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">No. Penerbangan</div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                {{ $jdkedatangan->no_penerbangan }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pesawat</div>
            <div class="py-2 col-9 font-weight-bold text-primary">
               [{{ $detail_pesawat->kode }}] - {{ $detail_pesawat->name }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Jadwal Kedatangan</div>
            <div class="py-2 col-9 font-weight-500 text-success">
                {{ \Carbon\Carbon::parse($jdkedatangan->jadwal)->format('d-m-Y') }}
                <span class="mx-2">/</span>
                {{ \Carbon\Carbon::parse($jdkedatangan->jadwal)->format('H:i:s') }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Bandara Asal</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($bandara_asal)
                [{{ $bandara_asal->kode }}] - {{ $bandara_asal->name }} 
                <span class="mx-2">/</span> {{ $bandara_asal->tag1 }} - {{ $negara_asal }}
                @else
                -
                @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Bandara Tujuan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($bandara_asal)
                    [{{ $bandara_tujuan->kode }}] - {{ $bandara_tujuan->name }}
                    <span class="mx-2">/</span> {{ $bandara_tujuan->tag1 }} - {{ $negara_tujuan }}
                @else
                -
                @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Keterangan</div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                {{ $jdkedatangan->keterangan?:"-" }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

<form method="POST" action="{{ route('jadwal_kedatangan_delete')}}">
    @csrf
    @include('sistem.jadwal.petugas.modal-del')
</form>
@endsection