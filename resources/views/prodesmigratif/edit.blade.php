@extends('layouts.admin') 

@section('title')
Ubah Data Prodesmigratif
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('theme/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
<style>
    .bootstrap-tagsinput {
        background-color: #F5F3FF;
        border-color: #C4B5FD;
        font-weight:500;
        height: 43px;
    }
    .selectric{
        background-color: #F5F3FF;
        border-color: #C4B5FD;
        font-weight:500;
    }
</style>

<style>
    .note-toolbar.card-header {
        background: #F5F3FF;
    }
    .note-editor.note-frame .note-editing-area .note-editable{
        /* background:#fffcf1; */
        background:#ffffff;
    }
    .note-editor.note-frame {
        border-color:#C4B5FD;
    }
    .activities .activity:before {
        background:#a3a2a3;
        width: 1px;
    }
    
</style>
@endsection

@section('content')

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-hand-holding-heart font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Prodesmigratif</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('prodesmigratif_index')}}"><u>Prodesmigratif</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
@endsection

@include('global.notifikasi')

<form method="post" action="{{ route('prodesmigratif_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="prodesmigratif_tipe" value="edit">
<input type="hidden" name="idProdesmigratif" value="{{ $prodesmigratif->id }}">

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow border-top5 border-form" >
                <div class="card-body">
                    <div class="form-group row mt-3">
                        <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                            Nama Usaha
                            <br><span class="font-13 font-weight-500">(Produk)</span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="nmJudul" name="nmJudul" class="form-control h-45 border-form bg-form text-dark font-weight-500" 
                            value="{{ $prodesmigratif->judul }}{{ old('nmJudul') }}"
                            onChange="$('#nmJenisKategori').val($('#nmJudul').val().toLowerCase().replace(/\s/g, '-'));">
                            <small class="text-danger">{{ $errors->first('nmJudul') }}</small>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Slug</div>
                        <div class="col-md-9">
                        <input type="text" id="nmJenisKategori" name="nmJenisKategori" value="{{ $prodesmigratif->slug }}{{ old('nmJenisKategori') }}"
                            class="form-control h-45 border-form bg-form text-dark font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmJenisKategori') }}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kategori</div>
                        <div class="col-md-9">
                            <select name="nmKategori" id="nmKategori" class="form-control selectric">
                                <option value="">- Pilih -</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->jenis_id}}" 
                                        @if($kat->jenis_id === $prodesmigratif->kategori_id) selected @endif>
                                        {{ $kat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Pemilik</div>
                        <div class="col-md-9">
                            <input type="text" id="nmPemilik" name="nmPemilik" 
                            class="form-control h-45 border-form bg-form text-dark font-weight-500" 
                            value="{{ $prodesmigratif->pemilik }}{{ old('nmPemilik') }}">
                            <small class="text-danger">{{ $errors->first('nmPemilik') }}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                        <div class="col-md-9">
                            <textarea name="nmAlamat" class="form-control bg-form border-form font-weight-500" 
                            rows="3">{{ $prodesmigratif->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kontak</div>
                        <div class="col-md-9">
                            <textarea name="nmKontak" class="form-control bg-form border-form font-weight-500" rows="3">{{ $prodesmigratif->kontak }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 mt-2 font-15  text-dark mb-2">
                           <span class="font-weight-bold">Deskripsi</span>  <span class="font-weight-500">Usaha (Produk)</span> 
                        </div>
                        <div class="col-md-12">
                            <textarea id="summernote" name="nmKeterangan" class="summernote">{{ $prodesmigratif->keterangan }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row w-100" id="featuredImage" style="cursor:pointer !important;">
                        <div class="col-md-4 font-weight-bold font-15 text-dark">Foto Utama</div>
                        <div id="image-preview" class="col-md-8 image-preview w-100" @if($prodesmigratif->img_featured)  style="background-image: url('{{ url($prodesmigratif->img_featured) }}');" @endif>
                            <label for="image-upload" id="image-label" >Pilih Gambar</label>
                            <input type="file" name="featuredImage" id="image-upload" class="img-fluid border-form"  />
                        </div>
                        @if($prodesmigratif->img_featured)
                        <div class="mt-2 col-md-12 text-right">
                            <a id="hapusFeatured" class="text-primary" style="cursor:pointer;"
                                onClick="$('#image-preview').css('background-image','');$('#hapusFeatured').hide();
                                        $('#statusFeatured').val('hapus');">
                                <i class="fas fa-times text-danger font-15 mr-2"></i><u>Hapus foto</u>
                            </a>
                        </div>
                        <input type="hidden" id="statusFeatured" name="statusFeatured" value="0">
                    @endif
                       
                    </div>
                </div>
            </div>
          
        </div>

        <div class="col-md-4">
            
                @if($prodesmigratif->status === "terbit")
                <a class="card shadow font-weight-bold font-18" 
                    href="{{ route('prodesmigratif_show', $prodesmigratif->slug) }}" target="_blank" >
                    <div class="card-body text-center">
                            <i class="font-16 far fa-file-alt mr-2"></i><u>Lihat Halaman</u>
                            <span class="bg-success py-1 px-2 rounded text-white 
                            font-weight-bold font-11 align-top ml-2">Terbit
                        </span>
                    </div>
                </a>
                @else
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <span class="bg-warning py-1 px-2 rounded text-white 
                                font-weight-bold align-top ml-2">Draft
                            </span>
                        </div>
                    </div>
                @endif

            <div class="card shadow border-top5 border-form">
                <div class="card-body">
                    <div class="form-group w-100">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Thumbnail</div>
                        <div id="image-preview2" class="image-preview w-100" @if($prodesmigratif->img_thumbnail) style="background-image: url('{{ url($prodesmigratif->img_thumbnail) }}');background-repeat: no-repeat;background-size: cover;" @endif>
                            <label for="image-upload" id="image-label2">Pilih Gambar</label>
                            <input type="file" name="thumbnailImage" id="image-upload2" class="img-fluid" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Status</div>
                        <select name="nmStatus" id="nmStatus" class="form-control selectric" style="font-size:16px;" >
                            <option value="draft" @if($prodesmigratif->status === "draft") selected @endif>Draft</option>
                            <option value="terbit" @if($prodesmigratif->status === "terbit") selected @endif>Terbit</option>
                        </select>
                    </div>
                    <div class="form-group w-100 d-none">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Tags</div>
                        <input data-role="tagsinput" type="text" name="tags" class="form-control" >
                        
                    </div>
                    
                </div>
                <div class="card-footer py-3 border-top text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="" onclick="$('#idDelete').val({{ $prodesmigratif->id }});" title="Hapus Data" 
                                data-toggle="modal" data-target="#modalHapus" class="btn btn-lg btn-danger w-100">
                                <i class="fas fa-times mr-2"></i>Hapus
                            </a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-lg btn-dark font-weight-bold">
                                <i class="fas fa-check mr-2"></i>
                                <span id="btnSubmit">
                                    Perbarui
                                </span>
                            </button>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
        </div>
    </div>
</form>

@include('prodesmigratif.modal')

@endsection

@section('script')

<script>
    function cekFeatured() {
    // Get the checkbox
    var checkBox = document.getElementById("cbFeatured");
    if (checkBox.checked == true){
        $('#featuredImage').show();
    } else {
        $('#featuredImage').hide();
    }
    }
</script>

<script src="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('theme/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('theme/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/page/features-post-create.js') }}"></script>

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
    ['view', ['fullscreen', 'codeview', 'help']],
    ['height', ['height']]
    ],
    height: 300
});
</script>


<script>
    setTimeout(function () {
        $('#nmStatus').trigger('change');
        $('#metaTitle').trigger('change');
        $('#metaDescription').trigger('change');
    }, 1000);
</script>

@endsection