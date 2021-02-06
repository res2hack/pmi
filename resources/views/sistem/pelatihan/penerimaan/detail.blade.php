@extends('layouts.admin') 

@section('title')
Penerimaan Peserta Pelatihan - {{ $pelatihan->name }}
@endsection

@section('style')
@include('sistem.pelatihan.style-detail')
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-check font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Pelatihan - Penerimaan Peserta</h4> 
            <span class="ml-2 font-11 bg-primary rounded text-white 
                align-top py-1 px-2 font-weight-bold ">Detail
            </span>
        </div>
            
        <span class="font-weight-bold">Penerimaan Peserta</span>
        <i class="mx-2 fas fa-caret-right"></i>
        <span class="font-weight-500 text-primary">
            <a href="{{ route('pelatihan_detail', $pelatihan->id)}}">{{ $pelatihan->name }}</a>
        </span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pelatihan_detail', $pelatihan->id)}}"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('penerimaan_index')}}"><u>Penerimaan</u></a>
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
                        @if($pelatihan->jml_peserta > 0 && ($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai"))
                        <a href="{{ route('pelatihan_kelulusan_detail', $pelatihan->id)}}"
                            class="font-weight-bold text-white" title="Proses Kelulusan Peserta Pelatihan">
                            <u class="font-14"><i class="far fa-check-circle mr-2"></i>Proses Kelulusan</u>
                        </a>
                        @endif
                        <div class="btn-group dropleft ml-3 " title="Menu Lainnya">
                            <a type="button" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v text-white"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('pelatihan_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Detail Pelatihan" target="_blank">
                                    <i class="fas fa-diagnoses font-14 mx-2"></i>Detail Pelatihan 
                                </a>
                                <a href="{{ route('pelatihan_pendaftaran_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Kembali Ke Pendaftaran Peserta"><i class="fas fa-caret-left font-14 mx-2"></i>Pendaftaran 
                                </a>
                                @if($pelatihan->jml_peserta > 0 && ($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai"))
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
        <div class="form-group row  m-0 ">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jumlah Pendaftar</div>
            <div class="py-2 col-9 font-weight-bold text-primary">
                <span id="jmlPendaftar" class="text-primary">0 Orang</span>
                <span id="DetailPendaftar" class="text-dark"></span> 
            </div> 
        </div>
        <div class="form-group row  m-0 ">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Diterima</div>
            <div class="py-2 col-9 font-weight-bold text-primary">
                <span id="jmlDiterima" class="text-primary">0</span>
                <span id="DetailDiterima" class="text-dark"></span> 
            </div> 
        </div>

        {{-- Cek Status Pelatihan Valid Atau Selesai--}}

        @if($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai")

        <form method="POST" action="{{ route('pelatihan_penerimaan_update')}}" id="formPenerimaan">
        @csrf
            <div id="dataIsi" class="mt-3 table-responsive">
                <div class="float-left font-weight-bold">
                    <div class="pt-2">
                        <i class="fas fa-user-check text-dark font-12 align-middle mr-2"></i> 
                        <span class="text-dark text-ungu font-18 align-middle">Penerimaan Peserta</span>
                    </div> 
                </div>

                @if($pelatihan->status_pelatihan === "valid")
                <div class="float-right">
                    <a id="btnUbah" onclick="KlikUbah();" 
                        class="iconStatus btn btn-primary text-white font-14 py-2" 
                        title="Ubah Penerimaan Peserta" style="cursor:pointer;">
                        <i class="fas fa-edit mr-2"></i>Ubah Penerimaan
                    </a>
                    <a id="btnBatal" onclick="KlikBatal();" 
                        class="ubahCheckbox btn btn-secondary text-dark font-14 py-2" 
                        title="Batal" style="cursor:pointer;display:none;">
                        <i class="fas fa-times"></i>
                    </a>
                    <a class="btnSimpan ubahCheckbox btn btn-dark text-white font-14 py-2 ml-2" 
                        title="Batal" style="cursor:pointer;display:none;">
                        <i class="fas fa-check mr-2"></i>Simpan
                    </a>
                </div>
                @endif

                <table id="dt-penerimaan" class="table  w-100">
                    <thead>
                        <tr>
                            <th class="py-2" style="width:5%;">#</th>
                            <th class="py-2 font-14">Nama</th>
                            <th class="py-2 font-14 ">NIK</th>
                            <th class="py-2 font-14 ">JK</th>
                            <th class="py-2 font-14">Alamat</th>
                            <th class="py-2 font-14 ">Tgl. Daftar</th>
                            <th class="py-2 font-14 ">No. Daftar</th>
                            <th class="py-2 font-14" style="width:5%;">
                                <span class="iconStatus">Diterima</span>
                                <div class="text-center">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label for="selectAll" class="ubahCheckbox custom-control-label font-14 
                                        font-weight-500 align-top text-primary" style="cursor:pointer;display:none;"></label>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>

                @if($pelatihan->status_pelatihan === "valid")
                <div class="float-right">
                    <a id="btnUbah" onclick="KlikUbah();" 
                        class="iconStatus btn btn-primary text-white font-14 py-2" 
                        title="Ubah Penerimaan Peserta" style="cursor:pointer;">
                        <i class="fas fa-edit mr-2"></i>Ubah Penerimaan
                    </a>
                    <a id="btnBatal" onclick="KlikBatal();" 
                        class="ubahCheckbox btn btn-secondary text-dark font-14 py-2" 
                        title="Batal" style="cursor:pointer;display:none;">
                        <i class="fas fa-times"></i>
                    </a>
                    <a class="btnSimpan ubahCheckbox btn btn-dark text-white font-14 py-2 ml-2" 
                    title="Batal" style="cursor:pointer;display:none;">
                    <i class="fas fa-check mr-2"></i>Simpan
                </a>
                </div>
                @endif
            </div>
        </form>

        @else
        <h5 class="mt-5 text-center">Penerimaan Tidak Bisa Dilakukan 
            Sebelum Status Pelatihan = <strong class="text-ungu">Valid</strong></h5>
        <h6 class="mt-2 font-weight-normal text-center">Tinjau detail Pelatihan dan lakukan validasi 
            <a href="{{ route('pelatihan_detail', $pelatihan->id)}}"><u>di sini</u></a></h6>
        @endif
    </div>
</div>

@endsection

@section('modal')
   @include('sistem.pelatihan.penerimaan.modal-status')
@endsection

@section('script')
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>

@include('sistem.pelatihan.penerimaan.detail-table')

@include('sistem.pelatihan.penerimaan.script')


<script>
      setTimeout(function(){ 
        jumlahPendaftar();
        dataPendaftar();
    }, 1000);
</script>


@endsection

