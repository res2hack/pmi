@extends('layouts.admin') 

@section('title')
Kelola Data Jadwal Petugas - Buat Baru
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('theme/node_modules/select2/dist/css/select2.min.css') }}">
<style>
.modal-backdrop {
        z-index: 0;
}
.select2-container--default .select2-selection--single, .select2-selection--multiple{
    background-color: #F5F3FF !important;
    border-color: #C4B5FD !important;
    /* padding-top: 6px !important; */
    font-weight:500 !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #aaa;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    margin-right:8px;
    color:#ffffff;
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
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Jadwal Kedatangan Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('jadwal_kedatangan_index')}}"><u>Jadwal Kedatangan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('jadwal_kedatangan_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmStatus" value="baru">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Pesawat</div>
                    <div class="col-md-8">
                        <select name="nmPesawat" id="nmPesawat" class="form-control select2 w-100" required>
                            <option value="">- Pilih -</option>
                            @foreach ($pesawat as $pes)
                                <option value="{{ $pes->jenis_id }}">[{{ $pes->kode }}] - {{ $pes->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">No. Penerbangan</div>
                    <div class="col-md-8">
                        <input type="text" class="form-control font-weight-500 border-form bg-form h-45"
                            name="nmNoPenerbangan" value="{{ old('nmNoPenerbangan') }}" required>
                        <small class="text-danger">{{ $errors->first('nmNoPenerbangan') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Jadwal</div>
                    <div class="col-md-8">
                        <input type="datetime-local" class="form-control font-weight-500
                            border-form bg-form h-45" name="nmJadwal">
                        <small class="text-danger">{{ $errors->first('nmKode') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Keterangan</div>
                    <div class="col-md-8">
                        <textarea class="form-control font-weight-500
                            border-form bg-form h-45" name="nmKeterangan">{{ old('nmKeterangan') }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmKeterangan') }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-12 font-15 font-weight-bold text-dark mb-2">Bandara Asal</div>
                    <div class="col-md-12">
                        <select name="nmBandaraAsal" id="nmBandaraAsal" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($bandara as $bd_asal)
                                <option value="{{ $bd_asal->jenis_id }}">
                                    [{{ $bd_asal->kode }}] - {{ $bd_asal->bandara }} - {{ $bd_asal->kota }} - {{ $bd_asal->negara }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 font-15 font-weight-bold text-dark mb-2">Bandara Tujuan</div>
                    <div class="col-md-12">
                        <select name="nmBandaraTujuan" id="nmBandaraTujuan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($bandara as $bd_tujuan)
                                <option value="{{ $bd_tujuan->jenis_id }}">
                                    [{{ $bd_tujuan->kode }}] - {{ $bd_tujuan->bandara }} - {{ $bd_tujuan->kota }} - {{ $bd_tujuan->negara }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>

</form>

@endsection

@section('script')
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>

@endsection