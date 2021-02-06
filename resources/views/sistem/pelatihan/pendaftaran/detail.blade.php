@extends('layouts.admin') 

@section('title')
Pendaftaran Peserta Pelatihan -  {{ $pelatihan->name }}
@endsection

@section('style')
    @include('sistem.pelatihan.style-detail')
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-friends font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Pelatihan - Pendaftaran Peserta</h4> 
            <span class="ml-2 font-11 bg-primary rounded text-white 
                align-top py-1 px-2 font-weight-bold ">Detail
            </span>
        </div>
            
        <span class="font-weight-bold">Pendaftaran Peserta</span>
        <i class="mx-2 fas fa-caret-right"></i>
        <span class="font-weight-500">
            <a href="{{ route('pelatihan_detail', $pelatihan->id)}}">{{ $pelatihan->name }}</a></span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pelatihan_detail', $pelatihan->id)}}"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pendaftaran_index')}}"><u>Pendaftaran</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">{{ $pelatihan->name }}</span>
@endsection

@section('content')

@include('global.notifikasi')
<input type="hidden" name="nmIDpelatihan" value="{{ $pelatihan->id }}">
<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="form-group row mb-0 mx-0">
            <div class="col-12 py-3 bg-detail">
                <div class="row">
                    <div class="col-md-6">
                        <span class="font-15 text-uppercase font-weight-bold bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-diagnoses font-14 mr-2 text-white"></i>  {{ $pelatihan->name }}
                        </span>
                    </div>
                    @if($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai")
                    <div class="col-md-6 text-right">
                        <a href="{{ route('pelatihan_penerimaan_detail', $pelatihan->id)}}"
                            class="font-weight-bold text-white" title="Proses Penerimaan Pendaftar">
                            <u class="font-14"><i class="fas fa-user-check mr-2"></i>Proses Penerimaan</u>
                        </a>
                        <div class="btn-group dropleft ml-3 " title="Menu Lainnya">
                            <a type="button" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-white"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('pelatihan_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Detail Pelatihan" target="_blank">
                                    <i class="fas fa-diagnoses font-14 mx-2"></i>Detail Pelatihan 
                                </a>
                                @if($pelatihan->jml_peserta > 0 && ($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai"))
                                <a href="{{ route('pelatihan_kelulusan_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Kelulusan Peserta"><i class="fas fa-caret-right font-14 mx-2"></i>Kelulusan 
                                </a>
                                <a href="{{ route('pelatihan_sertifikasi_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Sertifikasi"><i class="fas fa-caret-right font-14 mx-2"></i>Sertifikasi 
                                </a>
                                <a href="{{ route('pelatihan_penempatan_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Penempatan"><i class="fas fa-caret-right font-14 mx-2"></i>Penempatan 
                                </a>
                                @endif
                                <a href="{{ route('pelatihan_create')}}" class="text-success dropdown-item" 
                                    title="Buat Program Pelatihan Baru"><i class="fas fa-plus mr-2 font-12"></i>Pelatihan Baru 
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 pt-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kejuruan</div>
            <div class="py-2 col-9 pt-3">
                <span class="text-dark font-weight-bold font-14">{{ $sub_kejuruan}} ({{ $kejuruan }})</span>   
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Durasi</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pelatihan->jam_pelajaran }} Jam <span class="mx-2">/</span> Kuota: {{ $pelatihan->kuota_peserta }} Peserta
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jadwal</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-primary">
                {{ \Carbon\Carbon::parse($pelatihan->tgl_mulai)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($pelatihan->tgl_selesai)->format('d-m-Y') }}
            </div>
        </div>
        <div class="form-group row  m-0 ">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jumlah Pendaftar</div>
            <div class="py-2 col-9 font-weight-bold text-primary">
                <div id="jmlPendaftar">Loading Data...</div> 
            </div> 
        </div>
        <div class="form-group row  m-0 ">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pelatihan
            </div>
            <div class="py-2 col-9 font-weight-bold text-primary">
                <span class="@if($pelatihan->status_pelatihan === "valid") bg-ungu 
                    @elseif($pelatihan->status_pelatihan === "selesai") bg-success
                    @elseif($pelatihan->status_pelatihan === "draft") bg-warning
                    @elseif($pelatihan->status_pelatihan === "batal") bg-danger @endif
                    px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">

                    @if($pelatihan->status_pelatihan === "valid")
                        <i class="fas fa-check mr-1 font-11"></i>
                    @elseif($pelatihan->status_pelatihan === "selesai")
                        <i class="far fa-check-circle mr-1 font-11"></i>
                    @endif
                    {{ $pelatihan->status_pelatihan }}
                </span>
            </div> 
        </div>

        @if($pelatihan->status_pelatihan === "valid") 
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pendaftaran
            </div>
            <div class="py-2 col-9">
                <span class="@if($pelatihan->status_pendaftaran === "tutup") bg-danger 
                    @else bg-success @endif
                    px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">
                    @if($pelatihan->status_pendaftaran === "tutup")
                        <i class="fas fa-lock mr-1 font-11"></i>
                    @else
                        <i class="fas fa-lock-open mr-1 font-11"></i>
                    @endif
                    {{ $pelatihan->status_pendaftaran }}
                </span>

                @if($pelatihan->status_pelatihan === "valid")
                    <span class="ml-3">
                        @if($pelatihan->status_pendaftaran === "buka")
                        <a href="#" class="text-danger"
                            data-toggle="modal" data-target="#modalUbahStatus" 
                            onclick="$('#idUbahStatus').val({{ $pelatihan->id }});" title="Tutup Kolom Tanya Jawab">
                            <u class="font-14"><i class="fas fa-lock mr-1"></i> Tutup Pendaftaran
                            </u>
                        </a>
                        @else
                            <a href="#" class="text-success"
                                data-toggle="modal" data-target="#modalUbahStatus" 
                                onclick="$('#idUbahStatus').val({{ $pelatihan->id }});" title="Buka Kolom Tanya Jawab">
                                <u class="font-14"><i class="fas fa-lock-open mr-1"></i> Buka Pendaftaran
                                </u>
                            </a>
                        @endif
                    </span>
                @endif
            </div>
        </div>
        @endif

        {{-- Cek Status Pelatihan Valid Atau Selesai--}}

        @if($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai")
        <div id="dataKosong" class="text-center">
            <p class="mt-3 font-15 font-weight-bold">
                @if($pelatihan->jml_pendaftar > 0)
                    Loading Data...
                @else
                    Belum Ada Pendaftar
                @endif
            </p>
            @if($pelatihan->status_pendaftaran === "buka" && $pelatihan->jml_pendaftar < 1)
            <a href="" class="btn btn-primary font-14 py-2 mr-2" 
                title="Pendaftaran Peserta Baru" data-toggle="modal" data-target="#modalDaftar">
                <i class="fas fa-plus mr-2"></i>Peserta Baru
            </a>
            @endif
        </div>
        <div id="dataIsi" class="mt-3 table-responsive" style="display:none;">
            <div class="float-left font-weight-bold">
                <div class="pt-2">
                    <i class="fas fa-user-friends text-dark font-12 align-middle mr-2"></i> 
                    <span class="text-dark text-ungu font-18 align-middle">Detail Pendaftar</span>
                </div> 
            </div>
            @if($pelatihan->status_pelatihan === "valid" && $pelatihan->status_pendaftaran === "buka")
                <div class="float-right">
                    <a href="" class="btn btn-primary font-14 py-2" 
                        title="Pendaftaran Peserta Baru" data-toggle="modal" data-target="#modalDaftar">
                        <i class="fas fa-plus mr-2"></i>Peserta Baru
                    </a>
                </div>
            @endif
            <table id="dt-pendaftaran" class="table  w-100">
                <thead>
                    <tr>
                        <th class="py-2" style="width:5%;">#</th>
                        <th class="py-2 font-15">Nama</th>
                        <th class="py-2 font-15 ">NIK</th>
                        <th class="py-2 font-15 ">JK</th>
                        <th class="py-2 font-15">Alamat</th>
                        <th class="py-2 font-15 ">Tgl. Daftar</th>
                        <th class="py-2 font-15 ">No. Daftar</th>
                        <th class="py-2" style="width:10%;">
                            @if($pelatihan->status_pelatihan === "selesai")
                                Diterima
                            @endif
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        @else
            <h5 class="mt-5 text-center">Pendaftaran Tidak Bisa Dilakukan 
                Sebelum Status Pelatihan = <strong class="text-ungu">Valid</strong></h5>
            <h6 class="mt-2 font-weight-normal text-center">Tinjau detail Pelatihan dan lakukan validasi 
                <a href="{{ route('pelatihan_detail', $pelatihan->id)}}"><u>di sini</u></a></h6>
        @endif
    </div>
</div>
@endsection

@section('modal')
    @include('sistem.pelatihan.pendaftaran.modal-daftar')
    @include('sistem.pelatihan.pendaftaran.modal-edit')
    @include('sistem.pelatihan.pendaftaran.modal-del')
    {{-- @include('sistem.pelatihan.pendaftaran.modal-status') --}}
@endsection

@section('script')
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>

@include('sistem.pelatihan.pendaftaran.detail-table')
@include('sistem.pelatihan.pendaftaran.script')

<script>
     setTimeout(function(){ 
        jumlahPendaftar();
        dataPendaftar();
    }, 1000);
</script>
<script>
    function beriLogin() {
    var checkBox = document.getElementById("cbBeriLogin");
    if (checkBox.checked == true){
        $('#detailLogin').show();
        cekUsername();
        cekEmail();
    } else {
        $('#detailLogin').hide();
        $('#btn-simpan').prop('disabled', false);
    }
}
</script>

@include('global.script-partner')

@endsection

