@extends('layouts.admin') 

@section('title')
Kelola Data Pengaduan
@endsection

@section('style')
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
    }
    .selectric{
        background-color: #F5F3FF;
        border-color: #C4B5FD;
        font-weight:500;
    }
</style>
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-comments font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengaduan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Pengaduan</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Pengaduan TKI</span>
@endsection


@section('content')

@include('global.notifikasi')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <div class="float-left mr-3">
                        <a href="{{ route('pengaduan_create')}}" class="btn btn-primary font-15 py-2" title="Buat Data Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                        <a href="{{ route('pengaduan_sampah')}}" class="btn btn-danger font-15 py-2 ml-2" 
                            title="Keranjang Sampah - @if($jumlahSampah !== 0) Ada {{ $jumlahSampah }} artikel dalam keranjang sampah @else Tidak Ada Sampah @endif">
                            <i class="fas fa-trash"></i> <span class="font-10 bg-dark rounded px-1 ml-1">{{ $jumlahSampah }}</span>
                        </a>
                    </div>
                    
                    <table id="dt-master" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">No. Aduan</th>
                                <th class="font-15">Nama Pengadu</th>
                                <th class="font-15">Nama TKI</th>
                                <th class="font-15">Nama Majikan</th>
                                <th class="font-15">Status</th>
                                <th style="width:5%;"></th>
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
    @include('sistem.pengaduan.modal-del')
@endsection

@section('script')

    @include('sistem.pengaduan.table')
{{-- 
    <script>
        setTimeout(function()
        { 
            getKedatangan();
        }, 1000);
    </script> --}}
@endsection