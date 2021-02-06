@extends('layouts.admin') 

@section('title')
Pelatihan - Penempatan (Indeks)
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
        <i class="fas fa-id-card-alt font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Pelatihan - Penempatan</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">Indeks</span></div>
            
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pelatihan_index')}}"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Penempatan</span>
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
                    <table id="dt-penempatan" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">Nama Program</th>
                                <th class="font-15">Kejuruan</th>
                                <th class="font-15">Pelaksanaan</th>
                                <th class="font-15 text-center">Sertifikasi</th>
                                <th class="font-15 text-center">Penempatan</th>
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
{{-- @include('sistem.pelatihan.pendaftaran.modal-status') --}}

@endsection

@section('script')

    @include('sistem.pelatihan.penempatan.table')
    <script>
        setTimeout(function()
        { 
            getPelatihan();
        }, 500);
    </script>
@endsection