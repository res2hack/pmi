@extends('layouts.admin') 

@section('title')
Ubah Konsultasi
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Konsultasi</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Form Ubah Konsultasi</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('konsultasi_index')}}"><u>Konsultasi</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('konsultasi_update')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmStatus" value="edit">
<input type="hidden" name="nmID" value="{{ $konsultasi->id }}">

<div class="row">
    <div class="col-md-8">
        <div class="card shadow  border-top5 border-form">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Subjek</div>
                    <div class="col-md-12">
                        <input type="text" class="form-control font-weight-500 border-form bg-form h-45"
                            name="nmJudul" value="{{ $konsultasi->judul }}{{ old('nmJudul') }}" required>
                        <small class="text-danger">{{ $errors->first('nmJudul') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Topik</div>
                    <div class="col-md-12">
                        <select name="nmKategori" id="nmKategori" class="form-control select2 w-100" required>
                            <option value="">- Pilih -</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->jenis_id }}" 
                                    @if($kat->jenis_id === $konsultasi->kategori_id) selected @endif>
                                    {{ $kat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Pertanyaan</div>
                    <div class="col-md-12">
                        <textarea id="nmPertanyaan" name="nmPertanyaan" rows="10"
                        class="form-control bg-form border-form">{{ $konsultasi->konten }}{{ old('nmPertanyaan') }}</textarea>
                        
                        <small class="text-danger">{{ $errors->first('nmKeterangan') }}</small>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center border-top">
                <button type="submit" class="btn btn-lg btn-dark">
                    <span class="font-16"><i class="fas fa-check mr-2"></i>Perbarui</span>
                </button>
            </div>
        </div>
    </div>
        <div class="col-md-4">
            
            
        </div>
    
</div>

</form>

@endsection

@section('script')
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>

@endsection