@extends('layouts.admin') 

@section('title')
Kelola Data Penduduk - {{ $partner->name }}
@endsection

@section('style')
<style>
    .dropdown-toggle::after {
    display: none !important;
}
.dropleft .dropdown-toggle::before {
    display: none !important;
    }
</style>
    
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Penduduk</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold
                    rounded text-white align-top py-1 px-2">Detail
            </span>
        </div>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('partner_index')}}"><u>Penduduk</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">{{ $partner->name }}</span>
@endsection

@section('content')

@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="form-group row mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-6">
                        <span class="font-14 text-uppercase font-weight-bold bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-user font-14 mr-2 text-white"></i>  
                            {{ $partner->name }}
                        </span>
                        <span class="ml-3 font-14 text-capitalize font-weight-bold text-white">
                            {{ $partner->jk ==="L"?"Laki-Laki":"Perempuan" }}
                            <span class="mx-2">/</span>
                            {{ \Carbon\Carbon::parse($partner->tgl_lahir)->format('d-m-Y') }}
                        </span>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('partner_edit', $partner->id)}}" 
                            class="bg-dark p-2 text-white border border-dark rounded" title="Ubah Data Perusahaan">
                            <i class="fas fa-edit mr-2 font-11"></i>Ubah
                        </a>
                        <a href="{{ route('partner_create')}}" 
                            class="bg-light p-2 text-dark border border-white rounded ml-2" title="Ubah Data Perusahaan">
                            <i class="fas fa-plus mr-2 font-11"></i>Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pb-2 pt-3 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">NIK</div>
            <div class="pb-2 pt-3 col-9 font-weight-500 text-dark">
                {{ $partner->nik }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">No. BPJS</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $partner->bpjs }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Agama</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $partner->agama_id }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Pendidikan</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $partner->pendidikan_id }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Alamat</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $partner->alamat }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Kab. / Kota</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $kabupaten }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Provinsi</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $provinsi }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Kontak (Telp.)</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $partner->kontak }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Email</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $partner->email?:"-" }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Keterangan</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                {{ $partner->keterangan?:"-" }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="col-3 py-2 bg-light text-primary font-weight-bold text-right font-16">
                Aksesbilitas
            </div>
            <div class="col-9 py-2 bg-light ">
                
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-3 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Login Sistem</div>
            <div class="pt-3 pb-2 col-9 font-weight-500 text-dark">
                @if($partner->user_id)
                    <i class="font-18 far fa-check-circle text-success mr-2" title="Ya"></i>Ya
                    <span class="ml-3 mr-2">Status:</span>
                    @if($status_login == "active")
                        <span class="bg-success px-2 py-1 rounded text-white ">Diterima (Aktif)</span>
                    @elseif($status_login == "pending")
                        <span class="bg-warning px-2 py-1 rounded text-white ">Ditunda</span>
                    @else
                        <span class="bg-danger px-2 py-1 rounded text-white ">Dilarang</span>
                    @endif
                @else
                    <i class="font-18 far fa-times-circle text-danger mr-2" title="Tidak"></i>Tidak
                @endif
            </div>
        </div>
        @if($partner->user_id && ($status_login == "active" || $status_login == "pending"))
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Konsultasi</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark text-capitalize">
                <i class="font-18 far @if($partner->status_konsultasi === "aktif") fa-check-circle text-success 
                    @else fa-times-circle text-danger @endif mr-2" title="Ya">
                </i>{{ $partner->status_konsultasi === "aktif"?"Aktif":"Tidak"}}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Pengaduan</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark text-capitalize">
                <i class="font-18 far @if($partner->status_pengaduan === "aktif") fa-check-circle text-success 
                    @else fa-times-circle text-danger @endif mr-2" title="Ya">
                </i>{{ $partner->status_pengaduan === "aktif"?"Aktif":"Tidak"}}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Lamaran Pkj.</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark text-capitalize">
                <i class="font-18 far @if($partner->status_lamaran === "aktif") fa-check-circle text-success 
                    @else fa-times-circle text-danger @endif mr-2" title="Ya">
                </i>{{ $partner->status_lamaran === "aktif"?"Aktif":"Tidak"}}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Pencaker</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark text-capitalize">
                <i class="font-18 far @if($partner->status_pencaker === "aktif") fa-check-circle text-success 
                    @else fa-times-circle text-danger @endif mr-2" title="Ya">
                </i>{{ $partner->status_pencaker === "aktif"?"Aktif":"Tidak"}}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('script')

@endsection
