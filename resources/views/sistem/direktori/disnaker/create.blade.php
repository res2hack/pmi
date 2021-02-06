@extends('layouts.admin') 

@section('title')
Kelola Data Disnaker - Buat Baru
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


</style>

@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Disnaker</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Buat Data Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('disnaker_index')}}"><u>Disnaker</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('disnaker_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmTipe" value="create">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Dinas</div>
                    <div class="col-md-9">
                        <textarea id="nmDirektori" name="nmDirektori" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="{{ old('nmDirektori') }}" rows="2"></textarea>
                        <small class="text-danger">{{ $errors->first('nmDirektori') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea id="nmAlamat" name="nmAlamat" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="{{ old('nmAlamat') }}" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-16 font-weight-bold text-dark mb-2">Kontak</div>
                    <div class="col-md-9">
                        <textarea id="nmKontak" name="nmKontak" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="{{ old('nmKontak') }}" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 my-1 font-weight-bold text-dark">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="cbTampil" name="nmTampil"
                                    class="custom-control-input" value="1" checked>
                            <label class="custom-control-label" for="cbTampil" style="cursor:pointer;">Tampil</label>
                        </div>
                        <div class="ml-3 custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="cbValid" name="nmValid" 
                                    class="custom-control-input" value="1" checked>
                            <label class="custom-control-label" for="cbValid" style="cursor:pointer;">Valid</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="font-16 font-weight-bold text-dark mb-2">Detail</div>
                <textarea id="summernote" name="nmDetail" class="summernote"></textarea>
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