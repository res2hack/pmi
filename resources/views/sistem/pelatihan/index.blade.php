@extends('layouts.admin') 

@if(Auth::user()->tipe == "staf" && (auth()->user()->hasRole(['superadmin', 'admin']) || auth()->user()->can(['pelatihan'])))

@section('title')
Kelola Program Pelatihan - Indeks
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
            <i class="fas fa-diagnoses font-24"></i>
        </div>
        <div class="col-11">
            <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Program Pelatihan</h4> 
                <span class="ml-2 font-11 bg-primary rounded 
                    font-weight-bold text-white align-top py-1 px-2">Indeks</span></div>
            <span class="font-weight-bold">Daftar Program Pelatihan</span>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
    <i class="fas fa-angle-right mx-2"></i>
    <span class="font-weight-bold text-dark">Pelatihan</span>
@endsection


@section('content')
@include('global.notifikasi')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <div class="float-left mr-2">
                        @php $years = []; 
                                for ($year= 2020; $year <= now()->year ; $year++) 
                                $years[$year] = $year;
                            @endphp
                            <select id="nmTahun" name="nmTahun" onchange="getPelatihan();" class="form-control 
                                bg-form border-form font-15 rounded font-weight-bold" style="width:135px;">

                                @foreach ($years as $tahun)
        
                                <option class="font-weight-bold" value="{{ $tahun }}" 
                                    @if(now()->format('Y') == $tahun) selected @endif>

                                    Periode: {{ $tahun }}
                                </option>
                                
                                @endforeach
                            </select>
                    </div>
                    <div class="float-right ml-2">
                        <a href="{{ route('pelatihan_create')}}" class="btn btn-primary font-15 py-2" title="Buat Data Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                    </div>
                    <table id="dt-pelatihan" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">Nama Program</th>
                                <th class="font-15">Jadwal</th>
                                <th class="font-15">Kejuruan</th>
                                <th class="font-15">Anggaran</th>
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
    @include('sistem.pelatihan.modal-del')
@endsection

@section('script')

    @include('sistem.pelatihan.table')
    <script>
        setTimeout(function()
        { 
            getPelatihan();
        }, 500);
    </script>
@endsection

@else
    @include('global.dilarang')
@endif
