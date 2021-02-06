@extends('layouts.admin') 

@section('title')
Kelola Data Jadwal Petugas - Ubah Data
@endsection

@section('style')
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
    }
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Jadwal Petugas</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span>
        
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('jadwal_petugas_create')}}" class="text-success dropdown-item" title="Buat Data Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="{{ route('jadwal_petugas_detail', $petugas->id)}}" class="text-primary dropdown-item" title="Lihat Detail"><i class="far fa-file-alt  mr-2 font-12"></i>Detail
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Ubah Data Jabatan  
            <i class="fas fa-edit align-top ml-2"></i>
        </span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('jadwal_petugas_index')}}"><u>Jadwal Petugas</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
@endsection


@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('jadwal_petugas_update')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmStatus" value="edit">
<input type="hidden" name="nmID" value="{{ $petugas->id }}">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="text-right">
            <a href="{{ route('jadwal_petugas_detail', $petugas->id)}}" title="Batal Ubah Data">
                <i class="fas fa-times font-16 text-abu"></i>
            </a>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Petugas</div>
                    <div class="col-md-9">
                        <textarea id="nmPetugas" name="nmPetugas" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2">{{ $petugas->nama }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmPetugas') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Jadwal</div>
                    <div class="col-md-9">
                        <input type="datetime-local" class="form-control font-weight-500
                            border-form bg-form h-45" name="nmJadwal" value="{{ \Carbon\Carbon::parse($petugas->jadwal)->format('Y-m-d\TH:i:s')}}">
                        <small class="text-danger">{{ $errors->first('nmKode') }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kontak</div>
                    <div class="col-md-9">
                        <textarea id="nmKet1" name="nmKet1" 
                            class="form-control border-form bg-form font-weight-500" 
                            rows="2">{{ $petugas->ket1 }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmKet1') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Keterangan</div>
                    <div class="col-md-9">
                        <textarea id="nmKet2" name="nmKet2" 
                            class="form-control border-form bg-form font-weight-500" 
                            rows="2">{{ $petugas->ket2 }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmKet2') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Perbarui</span>
        </button>
    </div>
</div>

</form>

@endsection


@section('script')


@endsection