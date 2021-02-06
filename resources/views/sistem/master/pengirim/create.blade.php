@extends('layouts.admin') 

@section('title')
Kelola Data Pengirim - Buat Baru
@endsection

@section('style')
<style>
.modal-backdrop {
        z-index: 0;
}

</style>

@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengirim</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Buat Data Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pengirim_index')}}"><u>Pengirim</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('pengirim_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmStatus" value="baru">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-7">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kode</div>
                    <div class="col-md-9">
                        <input id="nmKode" name="nmKode" class="form-control h-45 
                                border-form bg-form font-weight-500" value="{{ old('nmKode') }}">
                        <small class="text-danger">{{ $errors->first('nmKode') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pengirim / Perusahaan</div>
                    <div class="col-md-9">
                        <textarea id="nmPengirim" name="nmPengirim" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2">{{ old('nmPengirim') }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmPengirim') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pemilik</div>
                    <div class="col-md-9">
                        <textarea id="nmPemilik" name="nmPemilik" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2">{{ old('nmPemilik') }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmPemilik') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Telepon</div>
                    <div class="col-md-9">
                        <textarea id="nmTelepon" name="nmTelepon" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2">{{ old('nmTelepon') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Fax</div>
                    <div class="col-md-9">
                        <textarea id="nmFax" name="nmFax" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2">{{ old('nmFax') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Keputusan</label>
                        <textarea id="nmKeputusan" name="nmKeputusan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2">{{ old('nmKeputusan') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</label>
                        <textarea id="nmAlamat" name="nmAlamat" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="3">{{ old('nmAlamat') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Alamat Penampungan</label>
                        <textarea id="nmPenampungan" name="nmPenampungan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="3">{{ old('nmPenampungan') }}</textarea>
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


@endsection