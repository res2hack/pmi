@extends('layouts.admin') 

@section('title')
Kelola Data Lamaran
@endsection

@section('style')
@include('global.custom-style')
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-id-card font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Lamaran</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">
                Indeks
            </span>
        </div>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Lamaran</span>
@endsection


@section('content')

@include('global.notifikasi')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="p-3 mb-4 border border-form rounded shadow">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mt-2 text-right font-weight-bold text-dark font-15">Lowongan (SIP)</div>
                        </div>
                        <div class="col-md-10">
                            <select id="nmLowongan" name="nmLowongan" onchange="getLamaran();" class="d-inline form-control select2">
                                {{-- <option value="">Semua Yang Aktif</option> --}}
                                @foreach ($lowongan as $low)
                                    <option value="{{ $low->id }}" selected>
                                        ({{ $low->jabatan }} - {{ $low->negara }}) - {{ $low->agency}}
                                    </option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-2 table-responsive ">
                    <div class="float-left mr-2">
                        <a href="{{ route('lamaran_create')}}" class="btn btn-primary font-15 py-2" title="Buat Data Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                    </div>
                    <table id="dt-pelamar" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-14">Nama</th>
                                <th class="font-14">Pendidikan</th>
                                <th class="font-14">Tgl. Registrasi</th>
                                <th class="font-13 text-center">Kompetensi</th>
                                <th class="font-13 text-center">Sehat</th>
                                <th class="font-13 text-center">Dokumen</th>
                                <th style="width:8%;"></th>
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
    @include('sistem.lamaran.modal-del')
@endsection

@section('script')
    <script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    @include('sistem.lamaran.table')

    <script>
         setTimeout(function()
        { 
            $("#nmLowongan").trigger('change');
        }, 500);
    </script>
@endsection