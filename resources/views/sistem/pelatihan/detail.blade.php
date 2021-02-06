@extends('layouts.admin') 

@if(Auth::user()->tipe == "staf" && (auth()->user()->hasRole(['superadmin', 'admin']) || auth()->user()->can(['pelatihan'])))

@section('title')
Kelola Program Pelatihan - {{ $pelatihan->name }}
@endsection

@section('style')
<style>
.dropleft .dropdown-toggle::before {
    display: none !important;
    }
</style>
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-diagnoses font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Program Pelatihan</h4> 
            <span class="ml-2 font-11 bg-primary rounded text-white 
            align-top py-1 px-2 font-weight-bold ">Detail
        </span>
        </div>
            
        <span class="font-weight-bold">Detail Pelatihan</span>
        <i class="mx-2 fas fa-caret-right"></i>
        <span class="font-weight-500 text-primary">{{ $pelatihan->name }}</span> 
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pelatihan_index')}}"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">{{ $pelatihan->name }}</span>
@endsection

@section('content')

@include('global.notifikasi')

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
                    <div class="col-md-6 text-right">
                        <a href="{{ route('pelatihan_edit', $pelatihan->id)}}" class="font-weight-bold text-white">
                            <u class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</u>
                        </a>
                        <a href="{{ route('pelatihan_pendaftaran_detail', $pelatihan->id)}}" class="ml-3 font-weight-bold text-white">
                            <u class="font-14"><i class="fas fa-user-friends mr-2"></i>Pendaftaran</u>
                        </a>

                        <div class="btn-group dropleft ml-3 " title="Menu Lainnya">
                            <a type="button" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-white"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('pelatihan_penerimaan_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Penerimaan"><i class="fas fa-caret-right font-14 mx-2"></i>Penerimaan 
                                </a>
                                <a href="{{ route('pelatihan_kelulusan_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Kelulusan"><i class="fas fa-caret-right font-14 mx-2"></i>Kelulusan 
                                </a>
                                <a href="{{ route('pelatihan_sertifikasi_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Sertifikasi"><i class="fas fa-caret-right font-14 mx-2"></i>Sertifikasi 
                                </a>
                                <a href="{{ route('pelatihan_create')}}" class="text-success dropdown-item" 
                                    title="Buat Program Pelatihan Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                                </a>
                            </div>
                        </div>
                    </div>
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
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Anggaran</div>
            <div class="py-2 col-9">
                <span class="font-weight-bold font-15 text-success">{{ number_format(($pelatihan->anggaran),0,",",".")  }}</span>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Sumber Dana</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $sumber_dana }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Metode</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $metode }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Durasi</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pelatihan->jam_pelajaran }} Jam
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kuota</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pelatihan->kuota_peserta }} Peserta
            </div> 
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tanggal Pelatihan</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-primary">
                {{ \Carbon\Carbon::parse($pelatihan->tgl_mulai)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($pelatihan->tgl_selesai)->format('d-m-Y') }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pelatihan
            </div>
            <div class="py-2 col-9">
                <span class="@if($pelatihan->status_pelatihan === "batal") bg-danger 
                    @elseif($pelatihan->status_pelatihan === "draft") bg-warning
                    @elseif($pelatihan->status_pelatihan === "valid") bg-ungu2 @else bg-success @endif
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
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pendaftaran</div>
            <div class="py-2 col-9">
                @if($pelatihan->status_pendaftaran === "tutup") 
                    <span class="bg-danger px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">
                        <i class="fas fa-lock mr-1 font-11"></i> {{ $pelatihan->status_pendaftaran }}
                    </span>
                @else
                    <span class="bg-success px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">
                        <i class="fas fa-lock-open mr-1 font-11"></i> {{ $pelatihan->status_pendaftaran }}
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Tipe Pendaftaran *</div>
            <div class="py-2 col-9 font-weight-500 text-capitalize text-dark">
                    {{ $pelatihan->tipe_pendaftaran }} 
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Jumlah Pendaftar</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                @if($pelatihan->jml_pendaftar > 0)
                    <span class="text-primary">{{ $pelatihan->jml_pendaftar }} Orang</span>
                    <span class="mx-2">/</span>
                    <span class="text-dark">{{ $pelatihan->pendaftar_l }} Laki-Laki,
                        {{ $pelatihan->pendaftar_p }} Perempuan
                    </span>
                @else
                    -
                @endif
            </div>
        </div>
       
       
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Diterima (Peserta)</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                @if($pelatihan->jml_peserta > 0)
                <span class="text-primary">{{ $pelatihan->jml_peserta }} Orang</span>
                <span class="mx-2">/</span>
                <span class="text-dark">{{ $pelatihan->peserta_l }} Laki-Laki,
                    {{ $pelatihan->peserta_p }} Perempuan</span>
                @else
                    -
                @endif
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Kelulusan</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                @if($pelatihan->jml_lulusan > 0)
                    <span class="text-primary">{{ $pelatihan->jml_lulusan }} Peserta</span>
                    <span class="mx-2">/</span>
                    <span class="text-dark">{{ $pelatihan->lulusan_l }} Laki-Laki,
                        {{ $pelatihan->lulusan_p }} Perempuan</span>
                @else
                -
                @endif
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Sertifikasi</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                @if($pelatihan->jml_lulusan_sertifikasi > 0)
                    <span class="text-primary">{{ $pelatihan->jml_lulusan_sertifikasi }} Peserta</span>
                    <span class="mx-2">/</span>
                    <span class="text-dark">{{ $pelatihan->lulusan_sertifikasi_l }} Laki-Laki,
                        {{ $pelatihan->lulusan_sertifikasi_p }} Perempuan</span>
                @else
                -
                @endif
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Penempatan</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                @if($pelatihan->jml_penempatan > 0)
                    <span class="text-primary font-weight-bold">{{ $pelatihan->jml_penempatan }} Peserta</span>
                    <span class="mx-2">/</span>
                    <span class="text-dark">{{ $pelatihan->penempatan_l }} Laki-Laki,
                        {{ $pelatihan->penempatan_p }} Perempuan
                    </span>
                    <span class="mx-2">/</span>
                    <span class="text-dark">{{ $pelatihan->jml_penempatan_formal }} Formal,
                        {{ $pelatihan->jml_penempatan_informal }} Informal
                    </span>
                @else
                -
                @endif
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Keterangan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {!! $pelatihan->keterangan !!}
            </div>
        </div>
        <div class="mt-2 font-12 font-weight-500">
            <span class="text-danger">* Pendaftaran Tipe Terbuka:</span> 
            User yang memiliki akses login sistem bisa 
            melakukan pendaftaran mandiri
        </div>
    </div>
    
</div>

@endsection

@else
    @include('global.dilarang')
@endif