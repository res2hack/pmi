@extends('layouts.admin') 

@section('title')
Kelola Data Master Sektor Pekerjaan
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Master Data Sektor Pekerjaan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Sektor Pekerjaan</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Sektor</span>
@endsection


@section('content')
@include('global.notifikasi')
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('master_store')}}">
            @csrf
            <div class="card shadow border-top5 border-form ">
                <div class="card-body mt-0 pb-1 ">

                    <input type="hidden" name="nmStatus" value="baru">
                    <input type="hidden" name="nmRedirect" value="back">
                    <input type="hidden" name="nmJenisKategori" value="m_sektor">

                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Nama Sektor</div>
                        <input type="text"  id="nmName" name="nmName" class="form-control bg-form h-42 border-form" required>
                        <small class="text-danger">{{ $errors->first('nmName') }}</small>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Keterangan</div>
                        <textarea name="nmKeterangan1" class="form-control bg-form border-form" rows="3"></textarea>
                    </div>
                </div>
                <div class="card-footer border-top mt-2 py-3 text-center">
                    <button type="submit" class="btn btn-lg btn-dark w-75">
                        <i class="fas fa-check mr-3 font-14"></i><span class="font-16">Tambah</span></button>
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
                                <th class="font-15">Nama Sektor</th>
                                <th class="font-15">Keterangan</th>
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
    @include('sistem.master.sektor.table')
@endsection