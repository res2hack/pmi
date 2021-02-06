@extends('layouts.admin') 

@section('title')
Kelola Data Master Jenis Pulang
@endsection

@section('style')
<style>
    .dropleft .dropdown-toggle::before {
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Master Data Jenis Pulang</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('master_index', 'jenis-pulang')}}"><u>Jenis Pulang</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
@endsection


@section('content')
@include('global.notifikasi')
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('master_update')}}">
            @csrf
            <div class="card shadow border-top5 border-form ">
                <div class="card-body mt-0 pb-1 ">

                    <input type="hidden" name="nmStatus" value="edit">
                    <input type="hidden" name="nmRedirect" value="index">
                    <input type="hidden" name="nmJenisKategori" value="kedatangan_jenis_pulang">
                    <input type="hidden" name="nmID" value="{{ $master->id }}">

                    
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Nama Jenis Pulang</div>
                        <textarea name="nmName" class="form-control font-weight-500 
                                    bg-form border-form" rows="3" required>{{ $master->name }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmName') }}</small>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Warna Label</div>
                        <select name="nmTag1" id="nmWarna" class="selectric">
                            <option value="dark" @if($master->tag1 === "dark") selected @endif>Gelap (dark)</option>
                            <option value="success" @if($master->tag1 === "success") selected @endif>Hijau (success)</option>
                            <option value="primary" @if($master->tag1 === "primary") selected @endif>Ungu (primary)</option>
                            <option value="info" @if($master->tag1 === "info") selected @endif>Biru Muda (info)</option>
                            <option value="warning" @if($master->tag1 === "warning") selected @endif>Kuning (warning)</option>
                            <option value="danger" @if($master->tag1 === "danger") selected @endif>Merah (danger)</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer border-top mt-2 py-3 text-center">
                    <button type="submit" class="btn btn-lg btn-dark w-75">
                        <i class="fas fa-check mr-3 font-14"></i><span class="font-16">Perbarui</span></button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <table id="dt-master" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">Nama Jenis Pulang</th>
                                <th class="font-15">Warna</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
        @include('sistem.master.modal-del')
@endsection

@section('script')
    @include('sistem.master.jenis-pulang.table')
@endsection