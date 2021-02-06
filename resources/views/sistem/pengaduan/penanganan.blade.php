@extends('layouts.admin') 

@section('title')
Kelola Data Pengaduan TKI - Ubah Pengaduan
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.css') }}">
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
#loadingku{
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -50px;
    margin-left: -50px;
    width: 300px;
    height: 150px;
    background:#433675;
    z-index: 1;    
}
#spinku{
    right: 8px;
    width: 27px;
    height: 27px;
    background-color: #b9a8f5;
    border-radius: 50%;
    -webkit-animation: pulsate 2s ease-out;
    animation: pulsate 1s ease-out;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    opacity: 1;
}
</style>

@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-comments font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengaduan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Tindak Lanjut</span></div>
            
        <span class="font-weight-500 text-success">Proses Tindak Lanjut Pengaduan</span>
        <i class="fas fa-rocket ml-2 align-top"></i>
        <span class="mx-2">/</span>
        <span class="text-danger font-weight-bold">#{{ $pengaduan->no_pengaduan }}</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pengaduan_index')}}"><u>Pengaduan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pengaduan_detail', $pengaduan->id)}}"><u>#{{ $pengaduan->no_pengaduan }}</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Tindak Lanjut</span>
@endsection

@section('content')

<div id="loadingku" class="rounded text-white text-center p-4" style="display:none;">
    <div class="text-warning font-18 font-weight-bold">Memperbarui Data...</div>
    <div id="spinku" class="mt-3 mx-auto"></div>
    <div class="mt-3 text-white font-14">Harap Menunggu</div>    
</div>

@include('global.notifikasi')

<form id="formPengaduan" method="post" action="{{ route('pengaduan_penanganan_store', $pengaduan->id )}}" enctype="multipart/form-data">
@csrf
{{-- 
<input type="hidden" name="nmStatus" value="lanjut">
<input type="hidden" name="nmID" value="{{ $pengaduan->id }}"> --}}

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        
        <ul class="nav nav-tabs" id="myTab5" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="tahapAwal" data-toggle="tab" href="#Awal" role="tab" aria-controls="home" aria-selected="true">
                <i class="fas fa-hourglass-start"></i> Tahap Awal</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="tahapProses" data-toggle="tab" href="#Proses" role="tab" aria-controls="profile" aria-selected="false">
                <i class="fas fa-hourglass-half"></i> Tahap Proses</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="tahapAkhir" data-toggle="tab" href="#Akhir" role="tab" aria-controls="contact" aria-selected="false">
                <i class="fas fa-check"></i> Tahap Akhir</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent5">
            <div class="tab-pane fade show active" id="Awal" role="tabpanel" aria-labelledby="tahapAwal">
                <div class="mt-2">
                    <p class="font-weight-bold px-2">Tuliskan rincian penanganan pengaduan <span class="text-info">tahap awal</span>.</p>
                </div>
                <div>
                    <textarea id="nmTahapAwal" name="nmTahapAwal" 
                    class="summernote">{{ $pengaduan->tahap_awal }}</textarea>
                </div>
            
                <div class="row">
                    <div class="col-md-6">
                        @include('sistem.pengaduan.file-tahap-awal')
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="Proses" role="tabpanel" aria-labelledby="tahapProses">
                <div class="mt-2">
                    <p class="font-weight-bold px-2">Tuliskan rincian penanganan pengaduan <span class="text-primary">tahap proses</span>.</p>
                </div>
                <div>
                    <textarea id="nmTahapProses" name="nmTahapProses" 
                    class="summernote">{{ $pengaduan->tahap_proses }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @include('sistem.pengaduan.file-tahap-proses')
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="Akhir" role="tabpanel" aria-labelledby="tahapAkhir">
                <div class="mt-2">
                    <p class="font-weight-bold px-2">Tuliskan rincian penanganan pengaduan <span class="text-success">tahap akhir</span>.</p>
                </div>
                <div>
                    <textarea id="nmTahapAkhir" name="nmTahapAkhir" 
                    class="summernote">{{ $pengaduan->tahap_akhir }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @include('sistem.pengaduan.file-tahap-akhir')
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>

        <hr>
        <div class="row mt-4 pt-2">
            <div class="col-md-6 mx-auto">
                <div class="row">
                    <div class="col-md-3 pt-3">
                        <div class="font-weight-bold">Lampiran Foto</div> 
                        <small class="text-danger">Max: 2MB.</small>
                    </div>
                    <div class="col-md-9">
                        @include('sistem.pengaduan.file-tahap-foto')
                        
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3 pt-2">
                         <span class="font-weight-bold text-dark font-16">Status</span> 
                    </div>
                    <div class="col-md-9">
                        <select id="nmStatusKasus" name="nmStatusKasus" 
                        class="form-control bg-form border-form font-weight-bold" >
                            <option value="B" @if($pengaduan->status_kasus === "B") selected @endif>Belum Diproses</option>
                            <option value="P" @if($pengaduan->status_kasus === "P") selected @endif>Sedang Diproses</option>
                            <option value="S" @if($pengaduan->status_kasus === "S") selected @endif>Selesai</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top mt-4">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark" onclick="loadingku();">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>


</form>


@endsection

@section('script')
<script>
    function loadingku() {
        $(document).ready(function() {
                $("#loadingku").show();
            })
        }; 
</script>
@include('sistem.pengaduan.script-tahap-awal')
@include('sistem.pengaduan.script-tahap-proses')
@include('sistem.pengaduan.script-tahap-akhir')
@include('sistem.pengaduan.script-tahap-foto')

<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('#nmTahapAwal').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['style','bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 210
});
</script>

<script>
    $('#nmTahapProses').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['style','bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 210
});
</script>

<script>
    $('#nmTahapAkhir').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['style','bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 210
});
</script>

@endsection