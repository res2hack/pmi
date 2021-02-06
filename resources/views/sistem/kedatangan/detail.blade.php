@extends('layouts.admin') 

@section('title')
Kelola Data Kedatangan TKI - Detail
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Kedatangan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('kedatangan_create')}}" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="{{ route('kedatangan_edit', $kedatangan->id)}}" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail kedatangan <i class="far fa-file-alt ml-2"></i></span>
        <span class="mx-2">/</span> 
        <span class="text-dark font-weight-bold">{{ $kedatangan->nama_tki }}</span> 
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('kedatangan_index')}}"><u>Kedatangan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Detail</span>
@endsection

@section('content')

@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="{{ route('kedatangan_index')}}" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="{{ route('kedatangan_edit', $kedatangan->id)}}" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="{{ route('kedatangan_delete')}}" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val({{ $kedatangan->id }});" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Tgl. Kedatangan</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary">
                {{ \Carbon\Carbon::parse($kedatangan->tgl_datang)->format('d-m-Y') }}
                @if($kedatangan->jam_datang)
                    / Jam {{ $kedatangan->jam_datang }}
                @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pesawat</div>
            <div class="py-2 col-9 font-15  font-weight-bold text-dark">
                {{ $pesawat->name }} - [{{ $pesawat->kode }}]

                {{-- Break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Nama TKI</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary">
                {{ $kedatangan->nama_tki }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">J. Kelamin</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                {{ $kedatangan->jk === "L"?"Laki-Laki":"Perempuan" }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Tgl. Lahir</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                @if($kedatangan->tgl_lahir)
                {{ \Carbon\Carbon::parse($kedatangan->tgl_lahir)->format('d-m-Y') }}
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
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pekerjaan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($kedatangan->pekerjaan)
                    {{ $pekerjaan }} - [{{ $sektor }}]
                @else
                    -
                @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Mulai Bekerja</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ \Carbon\Carbon::parse($kedatangan->tgl_berangkat)->format('d-m-Y') }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Masa Kerja</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($kedatangan->masa_kerja)
                    {{ $kedatangan->masa_kerja }} <span class="ml-2">(tahun/bulan)</span> 
                @else
                -
                @endif
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Alamat</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if(!$kedatangan->alamat && !$kedatangan->kabkota 
                    && !$kedatangan->kecamatan && !$kedatangan->desa && !$kedatangan->provinsi)
                    -
                @else
                    @if($kedatangan->alamat)
                        {{ $kedatangan->alamat }}
                    @endif
                    @if($kedatangan->kabkota)
                        , {{ $kabkota }}
                    @endif
                    @if($kedatangan->kecamatan)
                        , {{ $kecamatan }}
                    @endif
                    @if($kedatangan->desa)
                        , {{ $desa }}
                    @endif
                    @if($kedatangan->provinsi)
                        , {{ $provinsi }}
                    @endif
                @endif

                {{-- Break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Paspor</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $kedatangan->no_paspor }}
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
                {{ $kedatangan->agency?:"-" }}
                {{-- Break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
    
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Jenis Pulang</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $jenis_pulang?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Lama Waktu</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($kedatangan->hari)
                    {{ $kedatangan->hari }} hari
                @else
                -
                @endif
            </div>
        </div>

        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Proses Kepulangan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($pulang)
                    {{ $pulang }}
                    @if($kedatangan->kepulangan === 3)
                      <span class="mx-2">/</span>  {{ $kedatangan->transit_kantor?:"" }}
                    @endif
                @else
                -
                @endif
            </div>
        </div>

        @if($kedatangan->dijemput !== 0)
            <div class="form-group row my-0">
                <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Dijemput oleh</div>
                <div class="py-2 col-9 font-weight-500 text-dark">
                    {{ $dijemput }}  
                    @if($kedatangan->dijemput_oleh)
                       <span class="mx-2">/</span> Nama: {{ $kedatangan->dijemput_oleh }}
                    @endif

                </div>
            </div>
        @endif

        @if($kedatangan->kepulangan === 2)
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Menggunakan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($pulang_sendiri)
                   {{ $pulang_sendiri }} <span class="mx-2">/</span> {{ $kedatangan->menggunakan }}
                @endif
            </div>
        </div>
        @endif


        <div class="form-group row my-0">
            <div class="pt-4 pb-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Masalah</div>
            <div class="pt-2 pb-2 col-9 font-weight-500 text-dark">
                {{-- Break --}}
                <div class="border-top pt-3 mt-0"></div>
                <div>
                    @if(count($masalah) > 0)
                        @if(count($masalah) < 2)
                            @foreach($masalah as $mas)
                                <span class="font-weight-500">
                                    {{ $mas }} 
                                </span>
                            @endforeach
                        @else
                            <ol class="pl-3 mb-0">
                                @foreach($masalah as $mas)
                                <li>
                                    <span class="font-weight-500">
                                        {{ $mas }} 
                                    </span>
                                </li>
                                @endforeach
                            </ol>
                        @endif
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>

        @if($kedatangan->masalah_lainnya)
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Masalah Lain</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
               {{ $kedatangan->masalah_lainnya }}
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

@section('modal')

<form method="POST" action="{{ route('kedatangan_delete')}}">
    @csrf
    @include('sistem.kedatangan.modal-del')
</form>
@endsection