@extends('layouts.admin') 

@section('title')
Kelola Data LSP - Ubah
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('theme/node_modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.css') }}">
<style>
    .select2-container--default .select2-selection--single {
    background-color: #F5F3FF !important;
    border-color: #C4B5FD !important;
    padding-top: 6px !important;
    font-weight:500 !important;
}
.note-editor.note-frame {
    border: 1px solid #C4B5FD;
}
.modal-backdrop {
    z-index: 0;
}
.dropdown-toggle::after {
    display: none !important;
}

</style>

@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data LSP</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('lsp_create')}}" class="text-success dropdown-item" title="Buat Data Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="{{ route('lsp_detail', $direktori->id)}}" class="text-primary dropdown-item" title="Lihat Detail Data LSP"><i class="far fa-file-alt  mr-2 font-12"></i>Detail
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
        <i class="fas fa-edit ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('lsp_index')}}"><u>LSP</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
@endsection

@section('content')

@include('global.notifikasi')


    

<form method="post" action="{{ route('lsp_update', $direktori->id)}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmTipe" value="edit">
<input type="hidden" name="idDirektori" value="{{ $direktori->id }}">

<div class="card shadow  border-top5 border-form">
    
    <div class="card-body">
        <div class="text-right">
            <a href="{{ route('lsp_detail', $direktori->id)}}" title="Batal Ubah Data">
                <i class="fas fa-times font-16 text-abu"></i>
            </a>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama LSP</div>
                    <div class="col-md-9">
                        <textarea id="nmDirektori" name="nmDirektori" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="{{ old('nmDirektori') }}" rows="2">{{ $direktori->nama }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmDirektori') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea id="nmAlamat" name="nmAlamat" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="{{ old('nmAlamat') }}" rows="3">{{ $direktori->alamat }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-16 font-weight-bold text-dark mb-2">Kontak</div>
                    <div class="col-md-9">
                        <textarea id="nmKontak" name="nmKontak" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="{{ old('nmKontak') }}" rows="3">{{ $direktori->kontak }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 my-1 font-weight-bold text-dark">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="cbTampil" name="nmTampil"
                                    class="custom-control-input" value="1" @if($direktori->sts_tampil === 1) checked @endif>
                            <label class="custom-control-label" for="cbTampil" style="cursor:pointer;">Tampil</label>
                        </div>
                        <div class="ml-3 custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="cbValid" name="nmValid" 
                                    class="custom-control-input" value="1" @if($direktori->sts_valid === 1) checked @endif>
                            <label class="custom-control-label" for="cbValid" style="cursor:pointer;">Valid</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="font-16 font-weight-bold text-dark mb-2">Detail</div>
                <textarea id="summernote" name="nmDetail" class="summernote">{{ $direktori->detail }}</textarea>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-16"><i class="fas fa-check mr-3"></i>Perbarui</span>
        </button>
    </div>
</div>

</form>

@endsection


@section('script')

<script src="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    
    $('#summernote').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link', 'picture']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 200
});
</script>

@endsection