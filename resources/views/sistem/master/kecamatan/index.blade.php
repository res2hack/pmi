@extends('layouts.admin') 

@section('title')
Kelola Data Master Kecamatan
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('theme/node_modules/select2/dist/css/select2.min.css') }}">
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
    }

    .select2-container--default .select2-selection--single {
            background-color: #F5F3FF;
            border-color:#C4B5FD;
            font-weight:500;
    }
</style>

@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Master Data Kecamatan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Kecamatan</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Provinsi</span>
@endsection


@section('content')
@include('global.notifikasi')
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('kecamatan_store')}}">
            @csrf
            <input type="hidden" name="nmStatus" value="baru">
            <div class="card shadow border-top5 border-form ">
                <div class="card-body mt-0 pb-1 ">

                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Nama Kecamatan</div>
                        <textarea  id="nmKecamatan" name="nmKecamatan"
                                class="form-control bg-form h-45 font-weight-500 border-form" required></textarea>
                        <small class="text-danger">{{ $errors->first('nmKecamatan') }}</small>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Kabupaten / Kota</div>
                        <select name="nmKabKota" id="nmKabKota" class="form-control select2">
                            @foreach ($kabkota as $x)
                                <option value="{{ $x->id}}">{{ $x->nama }}</option>
                            @endforeach
                        </select>
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
                                <th class="font-15">Kecamatan</th>
                                <th class="font-15">Kabupaten / Kota</th>
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
    @include('sistem.master.kecamatan.modal-del')
@endsection

@section('script')
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.min.js') }}"></script>
    @include('sistem.master.kecamatan.table')
@endsection