@extends('layouts.admin') 

@section('title')
Kelola Data Lamaran - Detail
@endsection

@section('style')
<style>
    .dropdown-toggle::after {
    display: none !important;
}
</style>
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-id-card font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Lamaran</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">Detail</span>
        </div>
            
        <span class="text-dark font-weight-bold">#{{$lamaran_first->sip_id}} ( {{ $jabatan_first->nama }} -  {{ $negara_first }})</span>
        <span class="mx-2">/</span> 
        <span class="font-weight-bold text-form">{{ $lamaran_first->name }}</span> 
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('lamaran_index')}}"><u>Lamaran</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">#{{$lamaran_first->id_lamaran}} - {{ $lamaran_first->name }}</span>
@endsection

@section('content')

@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="form-group row mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-9">
                        <span class="bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="far fa-id-card font-14 mr-2 text-white"></i> 
                            <span class="font-14 text-uppercase font-weight-bold "> 
                                Lowongan
                            </span> 
                        </span>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="{{ route('sip_detail', $sip_first->id)}}" 
                            class="p-2 text-white" title="Detail Lowongan"><u>
                                Detail</u><i class="fas fa-caret-right ml-2 font-11"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-3 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Jabatan</div>
            <div class="pt-3 pb-2 col-9 font-14 font-weight-bold text-primary text-uppercase">
                {{ $jabatan_first->nama }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Negara Tujuan</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-danger text-uppercase">
                {{ $negara_first?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Agency</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-dark">
                {{ $sip_first->agency }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Perusahaan</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-dark">
                {{ $perusahaan_first->nama }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">No. SIP</div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                {{ $sip_first->no_sip }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Ijin Berlaku</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ \Carbon\Carbon::parse($sip_first->tgl_ijin_awal)->format('d-m-Y') }} 
                <span class="mx-1">s/d</span>
                {{ \Carbon\Carbon::parse($sip_first->tgl_ijin_akhir)->format('d-m-Y') }} 

                <span class="ml-2">
                    @if(strtotime($sip_first->tgl_ijin_akhir) > strtotime("-1 day", strtotime(now())))
                        <span style="padding:3px 4px;" 
                            class="bg-success font-weight-500 font-11 font-weight-bold align-top rounded text-white">Active</span>
                    @else
                        <span style="padding:3px 4px;" 
                            class="bg-light font-weight-500 font-11 font-weight-bold align-top rounded text-dark">Expired</span>
                    @endif
                </span>
            </div>
        </div>

        <div class="form-group row mt-4 mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-9">
                        <span class="bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-user-tie font-14 mr-2 text-white"></i> 
                            <span class="font-14 text-uppercase font-weight-bold"> 
                                Data Pelamar
                            </span> 
                        </span>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="{{ route('lamaran_create')}}" 
                            class="p-2 text-white" title="Buat Lamaran Baru">
                            <u><i class="fas fa-plus mr-2 font-11"></i>Buat Lamaran Baru</u>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-3 pb-2 col-3 font-14 font-weight-bold 
                bg-light3 text-dark text-right border-right">Tgl. Melamar</div>
            <div class="pt-3 pb-2 col-9 font-14 font-weight-bold text-dark">
                {{ \Carbon\Carbon::parse($lamaran_first->tgl_registrasi)->format('d-m-Y') }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Nama</div>
            <div class="pt-1 pb-2 col-9 ">
                <a href="{{ route('partner_detail', $lamaran_first->user_partner_id )}}" target="_blank"
                    class="font-14 font-weight-bold text-primary text-uppercase" title="Detail Biodata Pelamar">
                    <u>{{ $lamaran_first->name }}</u>
                </a>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">J. Kelamin</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $lamaran_first->jk === "L"?"Laki-Laki":"Perempuan" }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Agama</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $agama_first?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">NIK</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $lamaran_first->nik }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">No. BPJS</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $lamaran_first->bpjs }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Pendidikan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $pendidikan_first }} @if($lamaran_first->jurusan) / Jurusan: {{ $lamaran_first->jurusan}} @else - @endif
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Foto</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                @if($lamaran_first->foto_lamaran)
                <a href="{{ url($lamaran_first->foto_lamaran)}}" target="_blank">
                    <img src="{{ url($lamaran_first->foto_lamaran)}}" alt="Foto" style="width:180px;height:200px;">
                </a> 
                @else
                    <span class="text-danger">Tidak disertakan</span>
                @endif
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Curriculum Vitae</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                @if($lamaran_first->cv_lamaran)
                    <a href="{{ url($lamaran_first->cv_lamaran)}}" target="_blank"><u>CV Pelamar</u></a> 
                @else
                    <span class="text-danger">Tidak disertakan</span>
                @endif
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Kompetensi</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                @if($lamaran_first->syarat_kompetensi === "Y")
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                @else
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                @endif
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Sehat</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                @if($lamaran_first->syarat_sehat === "Y")
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                @else
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                @endif
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Dokumen</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                @if($lamaran_first->syarat_dokumen === "Y")
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                @else
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                @endif
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Keterangan Tambahan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $lamaran_first->keterangan_lamaran?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Alamat</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                @if(!$lamaran_first->alamat && !$lamaran_first->kabupaten_id 
                    && !$lamaran_first->kecamatan_id &&  !$lamaran_first->provinsi_id)
                    -
                @else
                    @if($lamaran_first->alamat)
                        {{ $lamaran_first->alamat }}
                    @endif
                    @if($lamaran_first->kabupaten_id)
                        , {{ $kabupaten_first->nama }}
                    @endif
                    @if($lamaran_first->kecamatan_id )
                        , {{ $kecamatan_first->nama }}
                    @endif
                    @if($lamaran_first->provinsi_id)
                        , {{ $provinsi_first->nama }}
                    @endif
                @endif
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Kontak (Telp.)</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                {{ $lamaran_first->kontak?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-3 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Email</div>
            <div class="pt-1 pb-3 col-9 font-weight-bold text-dark">
                {{ $lamaran_first->email?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-3 col-3 font-14 font-weight-bold bg-light3 
                text-dark text-right border-right"></div>
            <div class="py-3 col-9 font-weight-bold text-dark bg-light3">
                <a href="{{ route('lamaran_edit', $lamaran_first->id_lamaran)}}" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>
                    <span class="font-14">Ubah</span></a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

<form method="POST" action="{{ route('lamaran_delete')}}">
    @csrf
    @include('sistem.lamaran.modal-del')
</form>
@endsection