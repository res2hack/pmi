@extends('layouts.admin') 

@section('title')
Kelola Jadwal Keberangkatan TKI - Detail
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
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Jadwal Keberangkatan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('jadwal_keberangkatan_create')}}" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="{{ route('jadwal_keberangkatan_edit', $jdkeberangkatan->id)}}" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Jadwal Keberangkatan <i class="far fa-file-alt ml-2"></i></span>
        <span class="mx-2">/</span> 
        <span class="text-dark font-weight-bold">{{ $jdkeberangkatan->name }}</span> 
        <span class="mx-2">/</span> 
        @if($jdkeberangkatan->status === 0)
            <span title="Belum Berangkat" class="bg-warning px-2 py-1 text-white font-weight-500 rounded">Belum</span>
            @elseif($jdkeberangkatan->status === 1)
            <span title="Sudah Berangkat" class="bg-success px-2 py-1 text-white font-weight-500 rounded">Berangkat</span>
            @else
            <span title="Batal Berangkat" class="bg-danger px-2 py-1 text-white font-weight-500 rounded">Batal</span>
        @endif
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('jadwal_keberangkatan_index')}}"><u>Jadwal Keberangkatan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">{{ $jdkeberangkatan->name }}</span>
@endsection

@section('content')

@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="{{ route('jadwal_keberangkatan_index')}}" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="{{ route('jadwal_keberangkatan_edit', $jdkeberangkatan->id)}}" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="{{ route('jadwal_keberangkatan_delete')}}" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val({{ $jdkeberangkatan->id }});" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Jadwal Keberangkatan</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary">
                {{ \Carbon\Carbon::parse($jdkeberangkatan->tgl_berangkat)->format('d-m-Y / H:i') }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pesawat</div>
            <div class="py-2 col-9 font-15  font-weight-bold text-dark">
                {{ $pesawat->name }} - [{{ $pesawat->kode }}]

                
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">No. Penerbangan</div>
            <div class="py-2 col-9 font-15  font-weight-bold text-dark">
                {{ $jdkeberangkatan->no_penerbangan }}

                
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Bandara Asal</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($bandara_asal)
                [{{ $bandara_asal->kode }}] - {{ $bandara_asal->name }} 
                <span class="mx-2">/</span> {{ $bandara_asal->tag1 }} - {{ $negara_asal }}
                @else
                -
                @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Bandara Tujuan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($bandara_asal)
                    [{{ $bandara_tujuan->kode }}] - {{ $bandara_tujuan->name }}
                    <span class="mx-2">/</span> {{ $bandara_tujuan->tag1 }} - {{ $negara_tujuan }}
                @else
                -
                @endif
                {{-- Break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Nama TKI</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary">
                {{ $jdkeberangkatan->name }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">J. Kelamin</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                {{ $jdkeberangkatan->jk === "L"?"Laki-Laki":"Perempuan" }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Tgl. Lahir</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                @if($jdkeberangkatan->tgl_lahir)
                {{ \Carbon\Carbon::parse($jdkeberangkatan->tgl_lahir)->format('d-m-Y') }}
            @else
                -
            @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Negara Penempatan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $negara?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Alamat</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if(!$jdkeberangkatan->alamat && !$jdkeberangkatan->kabkota 
                    && !$jdkeberangkatan->kecamatan && !$jdkeberangkatan->desa && !$jdkeberangkatan->provinsi)
                    -
                @else
                    @if($jdkeberangkatan->alamat)
                        {{ $jdkeberangkatan->alamat }}
                    @endif
                    @if($jdkeberangkatan->kabkota)
                        , {{ $kabkota }}
                    @endif
                    @if($jdkeberangkatan->kecamatan)
                        , {{ $kecamatan }}
                    @endif
                    @if($jdkeberangkatan->desa)
                        , {{ $desa }}
                    @endif
                    @if($jdkeberangkatan->provinsi)
                        , {{ $provinsi }}
                    @endif
                @endif
               
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kontak</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                {{ $jdkeberangkatan->kontak?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Keterangan</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                {{ $jdkeberangkatan->keterangan?:"-" }}
                {{-- Break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Paspor</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $jdkeberangkatan->paspor }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kantor Imigrasi</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $imigrasi }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">PPTKIS</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pptkis?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Agency</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $jdkeberangkatan->agency?:"-" }}
                {{-- Break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Status Keberangkatan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($jdkeberangkatan->status === 0)
                <span title="Belum Berangkat" class="bg-warning px-2 py-1 text-white font-weight-500 rounded">Belum</span>
                @elseif($jdkeberangkatan->status === 1)
                <span title="Sudah Berangkat" class="bg-success px-2 py-1 text-white font-weight-500 rounded">Berangkat</span>
                @else
                <span title="Batal Berangkat" class="bg-danger px-2 py-1 text-white font-weight-500 rounded">Batal</span>
                @endif
            </div>
        </div>

    </div>
</div>


@endsection

@section('modal')

<form method="POST" action="{{ route('jadwal_keberangkatan_delete')}}">
    @csrf
    @include('sistem.jadwal.keberangkatan.modal-del')
</form>
@endsection