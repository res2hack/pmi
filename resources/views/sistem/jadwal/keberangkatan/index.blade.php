@extends('layouts.admin') 

@section('title')
Kelola Data Jadwal Keberangkatan
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
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Jadwal Keberangkatan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Jadwal Keberangkatan</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Jadwal Keberangkatan</span>
@endsection


@section('content')

@include('global.notifikasi')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <div class="float-left form-group row mb-2">
                        <div class="col-6 mr-2">
                            <select name="nmBulan" id="nmBulan" onchange="getKeberangkatan();" class="form-control
                            bg-form font-15 rounded font-weight-bold" style="width:120px;">
                            @foreach($bulan as $x)
                            <option value="{{ '0' . $x->jenis_id }}" 
                                    @if(now()->format('m') == '0' . $x->jenis_id) selected @endif >
                                {{ $x->name }}
                            </option>
                            @endforeach
                        </select>
                        </div>

                        <div class="col-4 px-2">
                            @php $years = []; 
                                for ($year= 2015; $year <= now()->year ; $year++) 
                                $years[$year] = $year;
                            @endphp
                            <select id="nmTahun" name="nmTahun" onchange="getKeberangkatan();" class="form-control 
                                bg-form font-15 rounded font-weight-bold" style="width:80px;">

                                @foreach ($years as $tahun)
        
                                <option class="font-weight-bold" value="{{ $tahun }}" 
                                    @if(now()->format('Y') == $tahun) selected @endif>

                                    {{ $tahun }}
                                </option>
                                
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="float-right ml-2">
                        <a href="{{ route('jadwal_keberangkatan_create')}}" class="btn btn-primary font-15 py-2" title="Buat Data Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                    </div>
                    <table id="dt-master" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15" style="width:20%;">No. Penerbangan</th>
                                <th class="font-15" style="width:20%;">Jadwal Keberangkatan</th>
                                <th class="font-15">Bandara</th>
                                <th class="font-15">Status</th>
                                <th style="width:10%;"></th>
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
    @include('sistem.jadwal.keberangkatan.modal-del')
@endsection

@section('script')

    @include('sistem.jadwal.keberangkatan.table')

    <script>
        setTimeout(function()
        { 
            getKeberangkatan();
        }, 1000);
    </script>
@endsection