@extends('layouts.admin') 

@section('title')
Kelola Lowongan (SIP) - {{ $sip->jabatan }} / {{ $sip->perusahaan }}
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
        <i class="fas fa-clipboard-list font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark">
            <h4 class="d-inline">Kelola Lowongan (SIP)</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold
                 rounded text-white align-top py-1 px-2">Detail
            </span>
        </div>
        <div class="font-weight-bold">
            {{ $sip->agency }}
        </div>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('sip_index')}}"><u>Lowongan (SIP)</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">{{ $sip->jabatan }}</span>
@endsection

@section('content')

@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        {{-- <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="{{ route('sip_edit', $sip->id)}}" class="btn btn-dark">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
            </div>
        </div> --}}
        <div class="form-group row mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-9">
                        <span class="bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="far fa-id-card font-14 mr-2 text-white"></i> 
                            <span class="font-15 text-uppercase font-weight-bold "> 
                                {{ $sip->jabatan }}
                            </span> 
                            <span class="mx-1">/</span>
                            <span class="text-white font-weight-500">
                                {{ $sip->negara }}
                            </span>
                        </span>
                        {{-- <span class="text-white font-14 align-top 
                            font-weight-bold ml-4">
                                {{ $sip->negara }}
                        </span> --}}
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="{{ route('sip_edit', $sip->id)}}" 
                            class="bg-dark p-2 text-white border border-dark rounded" title="Ubah Data Lowongan">
                            <i class="fas fa-edit mr-2 font-11"></i>Ubah
                        </a>
                        {{-- <a href="{{ route('sip_create')}}" 
                            class="bg-light p-2 text-dark border border-white rounded ml-2" title="Ubah Data Lowongan">
                            <i class="fas fa-plus mr-2 font-11"></i>Baru
                        </a> --}}
                        <div class="btn-group dropleft ml-3 " title="Menu Lainnya">
                            <a type="button" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v text-white"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-danger" href="" id="btnDelete"  onclick="$('#idDelete').val('{{ $sip->id }}');" title="Hapus Data" 
                                    data-toggle="modal" data-target="#exampleModalCenter" >
                                    <i class="fas fa-times font-12 mr-2"></i> Hapus</a>
                                <a href="{{ route('sip_create')}}" class="text-success dropdown-item" 
                                    title="Buat Program Pelatihan Baru"><i class="fas fa-plus mr-2 font-12"></i> Baru 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pb-1 pt-3 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">No. SIP</div>
            <div class="pb-1 pt-3 col-9 font-weight-bold text-dark">
                {{ $sip->no_sip }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Ijin Berlaku</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ \Carbon\Carbon::parse($sip->tgl_ijin_awal)->format('d-m-Y') }} 
                <span class="mx-1">s/d</span>
                {{ \Carbon\Carbon::parse($sip->tgl_ijin_akhir)->format('d-m-Y') }} 

                <span class="ml-2">
                    @if(strtotime($sip->tgl_ijin_akhir) > strtotime("-1 day", strtotime(now())))
                        <span style="padding:3px 4px;" 
                            class="bg-success font-weight-500 font-11 font-weight-bold align-top rounded text-white">Active</span>
                    @else
                        <span style="padding:3px 4px;" 
                            class="bg-light font-weight-500 font-11 font-weight-bold align-top rounded text-dark">Expired</span>
                    @endif
                </span>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Perusahaan</div>
            <div class="pt-1 pb-2 col-9">
               <a href="{{ route('perusahaan_detail', $sip->perusahaan_id)}}" 
                class="font-weight-bold" target="_blank"><u>{{ $sip->perusahaan }}</u></a> 
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Agency</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-danger">
                {{ $sip->agency }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Jabatan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $sip->jabatan }} <span class="mx-2">/</span> {{ $sip->sts_formal === 0?'Formal':'Informal' }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Negara</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $sip->negara }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Jumlah Laki-Laki</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $sip->jumlah_l }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Jumlah Perempuan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $sip->jumlah_p }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Jumlah L/P</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $sip->jumlah_lp }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold 
                text-dark text-right border-right bg-light3">Status Lamaran</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                @if($sip->status_lamaran === "buka")
                <span class="bg-success px-2 py-1 rounded text-white font-weight-bold">
                    <i class="fas fa-lock-open font-11 mr-2"></i>Buka
                </span>
                @else
                <span class="bg-danger px-2 py-1 rounded text-white font-weight-bold">
                    <i class="fas fa-lock font-11 mr-2"></i>Tutup
                </span>
                @endif
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Keterangan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {!! $sip->keterangan !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
@include('sistem.sip.modal-del')
@endsection