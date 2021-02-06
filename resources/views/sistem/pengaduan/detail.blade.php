@extends('layouts.admin') 

@section('title')
Kelola Data Pengaduan TKI - Detail
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
        <i class="far fa-comments font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengaduan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('pengaduan_create')}}" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="{{ route('pengaduan_edit', $pengaduan->id)}}" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Pengaduan 
            <i class="far fa-file-alt ml-2"></i></span>
            <span class="mx-2">/</span>
            <span class="text-dark font-weight-bold">#{{ $pengaduan->no_pengaduan }}</span>
            <span class="mx-2">/</span>
            <span class="font-12 font-weight-bold">
                @if(!$pengaduan->delete_date)
                    @if($pengaduan->status_kasus === "B")
                        <span class="bg-warning py-1 px-3 text-white rounded">Belum Diproses</span> 
                    @elseif($pengaduan->status_kasus === "P")
                        <span class="bg-primary py-1 px-3 text-white rounded">Sedang Diproses</span> 
                    @elseif($pengaduan->status_kasus === "S")
                        <span class="bg-success py-1 px-3 text-white rounded">Selesai</span> 
                    @endif
                @else
                    <span class="bg-danger py-1 px-3 text-white rounded">Pengaduan Dihapus</span>
                @endif
            </span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pengaduan_index')}}"><u>Pengaduan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">#{{ $pengaduan->no_pengaduan }}</span>
@endsection

@section('content')



@include('global.notifikasi')

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2 pb-3">
            <div class="col-md-12 text-right">
                <a href="{{ route('pengaduan_index')}}" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                @if(!$pengaduan->delete_date)
                <a title="Proses Tindak Lanjut Pengaduan" href="{{ route('pengaduan_penanganan', $pengaduan->id)}}" 
                    class="btn btn-primary ml-2">
                    <span class="font-14"><i class="fas fa-rocket mr-2"></i>Tindak Lanjuti</span>
                </a>
                @endif

                @if(!$pengaduan->delete_date)
                    <a title="Ubah Data Pengaduan" href="{{ route('pengaduan_edit', $pengaduan->id)}}" 
                        class="btn btn-dark ml-2">
                        <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                    </a>
                @endif
                
                @if(!$pengaduan->delete_date)
                    <a href="{{ route('pengaduan_delete')}}" class="btn btn-danger ml-2"
                        data-toggle="modal" data-target="#exampleModalCenter" 
                        onclick="$('#idDelete').val({{ $pengaduan->id }});" title="Hapus Pengaduan">
                        <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                    </a>
                @else
                    <a href="{{ route('pengaduan_restore')}}" class="btn btn-dark ml-2"
                        data-toggle="modal" data-target="#modalRestore" 
                        onclick="$('#idRestore').val({{ $pengaduan->id }});" title="Kembalikan Pengaduan">
                        <span class="font-14"><i class="fas fa-reply text-success mr-2"></i>Restore</span>
                    </a>
                    <a href="{{ route('pengaduan_destroy')}}" class="btn btn-danger ml-2"
                        data-toggle="modal" data-target="#modalDestroy" 
                        onclick="$('#idDestroy').val({{ $pengaduan->id }});" title="Hapus Permanen Pengaduan">
                        <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus Permanen</span>
                    </a>
                @endif
            </div>
        </div>
        <h5 class="text-dark mb-3">
            <i class="far fa-file-alt font-16 mr-2 text-primary"></i>Detail Pengaduan
            <span class="ml-1 text-primary">#{{ $pengaduan->no_pengaduan }}</span> 
        </h5>
        
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-soft-dark text-white text-right">Tgl. Pengaduan</div>
            <div class="py-3 col-9 bg-soft-dark text-white">
                <span class="font-weight-bold bg-info px-2 py-1 rounded">
                    @if($pengaduan->tgl_pengaduan)
                    {{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->format('d-m-Y') }}
                    @else
                        -
                    @endif
                </span>
               
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Asal Pengaduan</div>
            <div class="py-3 col-9 font-weight-500 text-dark">
                <div>
                    {{ $pengaduan_asal?:"-" }}
                </div>
                {{-- break border-top --}}
                <div class="mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Nama Pengadu</div>
            <div class="py-3 col-9 bg-light3">
                <span class="font-weight-bold text-uppercase text-dark">
                {{ $pengaduan->nama_peng?:"-" }}
                </span>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-3 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Hub. Dengan TKI</div>
            <div class="pt-3 pb-2 col-9 font-weight-500 text-dark3">
                {{ $pengaduan->hubungan_tki?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pengaduan->alamat_peng?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Telepon</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pengaduan->telepon?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Email</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pengaduan->email?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Saluran Pengaduan</div>
            <div class="pt-2 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    {{ $info_saluran?:"-" }}
                </div>
                
                {{-- break border-top --}}
                <div class=" mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-soft-dark text-white text-right">Nama TKI</div>
            <div class="py-3 col-9 bg-soft-dark text-white">
                <span class="font-weight-bold text-uppercase">
                {{ $pengaduan->nama_tki?:"-" }}
                </span>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">No. Paspor</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pengaduan->no_paspor?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jenis Kelamin</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pengaduan->jk === "L"?"Laki-Laki":"Perempuan" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tmp / Tgl. Lahir</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if(!$pengaduan->tgl_lahir && !$pengaduan->tmp_lahir)
                    -
                @else
                    @if($pengaduan->tgl_lahir)
                        {{ \Carbon\Carbon::parse($pengaduan->tgl_lahir)->format('d-m-Y') }}
                    @endif
                    @if($pengaduan->tmp_lahir)
                        , {{ $pengaduan->tmp_lahir }}
                    @endif
                @endif
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Status</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($pengaduan->status === "B")
                    Belum Kawin
                @elseif($pengaduan->status === "K")
                    Kawin
                @elseif($pengaduan->status === "J")
                    Janda
                @elseif($pengaduan->status === "D")
                    Duda
                @endif
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if(!$pengaduan->alamat && !$pengaduan->kabkota 
                    && !$pengaduan->kecamatan && !$pengaduan->desa && !$pengaduan->provinsi)
                    -
                @else
                    @if($pengaduan->alamat)
                        {{ $pengaduan->alamat }}
                    @endif
                    @if($pengaduan->kabkota)
                        , {{ $kabkota }}
                    @endif
                    @if($pengaduan->kecamatan)
                        , {{ $kecamatan }}
                    @endif
                    @if($pengaduan->desa)
                        , {{ $desa }}
                    @endif
                    @if($pengaduan->provinsi)
                        , {{ $provinsi }}
                    @endif
                @endif
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Pendidikan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pendidikan?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Pekerjaan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($pengaduan->pekerjaan)
                    {{ $pekerjaan }} - [{{ $sektor }}]
                @else
                    -
                @endif
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jabatan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $pengaduan->jabatan?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Negara</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                {{ $negara?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tgl. Bekerja</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                @if($pengaduan->tgl_berangkat)
                    {{ \Carbon\Carbon::parse($pengaduan->tgl_berangkat)->format('d-m-Y') }}
                @else
                    -
                @endif
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tgl. Kembali</div>
            <div class="pt-2 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    @if($pengaduan->tgl_datang)
                        {{ \Carbon\Carbon::parse($pengaduan->tgl_datang)->format('d-m-Y') }}
                    @else
                        -
                    @endif
                </div>
                {{-- break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Nama Majikan</div>
            <div class="pb-2 col-9 font-weight-500 text-dark text-dark">
                    {{ $pengaduan->nama_majikan?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat Majikan</div>
            <div class="pt-2 pb-3 col-9 font-weight-500 text-dark text-dark">
                <div>
                    {{ $pengaduan->alamat_majikan?:"-" }}
                </div>
                
                {{-- break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
    
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Pengirim / PPTKIS</div>
            <div class="pb-2 col-9 font-weight-500 text-dark text-dark">
                {{ $pptkis?:"-" }}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat PPTKIS</div>
            <div class="pt-2 pb-3 col-9 font-weight-500 text-dark text-dark">
                <div>
                    {{ $pengaduan->alamat_pptkis?:"-" }}
                </div>
                {{-- break --}}
                <div class="mt-3 mb-0 border-top"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Masalah</div>
            <div class="py-3 col-9 font-weight-500 text-dark">
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
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-3 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Masalah Lainnya</div>
            <div class="pt-3 pb-3 col-9 font-weight-500 text-dark text-dark">
                {{ $pengaduan->masalah_lainnya?:"-" }}
                {{-- break --}}
                {{-- <div class="border-top mt-3 mb-0"></div> --}}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Detail Masalah</div>
            <div class="py-2 col-9 font-weight-500 text-dark text-dark">
                {!! $pengaduan->detail_masalah?:"-" !!}
                {{-- break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kronologis Masalah</div>
            <div class="py-2 col-9 font-weight-500 text-dark text-dark">
                {!! $pengaduan->uraian_kronologis?:"-" !!}
                {{-- break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran</div>
            <div class="py-2 col-9 font-weight-500 text-dark text-dark">
                <div>
                    @if(count($file_krono) > 0)
                        <ol class="pl-3">
                            @foreach($file_krono as $krono)
                            <li>
                                <a target="_blank" class="font-weight-bold" href="{{ url('/uploads/file/pengaduan/kronologis') }}/{{ $krono->nmfile }}">
                                    {{ $krono->nmfile }} <i class="fas fa-file ml-2"></i>
                                </a>
                            </li>
                            @endforeach
                        </ol>
                    @else
                        -
                    @endif
                </div>

                {{-- break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tuntutan Pengadu</div>
            <div class="py-2 pb-3 col-9 font-weight-500 text-dark text-dark">
                {!! $pengaduan->tuntutan_pengadu?:"-" !!}
            </div>
        </div>

        <h5 class="text-dark mb-3 mt-5">
            <i class="fas fa-redo font-16 mr-2 text-success"></i>Proses Tindak Lanjut
        </h5>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-3 pb-3 col-3 font-15 font-weight-bold bg-soft-dark text-white text-right">Status Penanganan</div>
            <div class="pt-3 pb-3 col-9 bg-soft-dark text-white font-weight-bold">
                @if($pengaduan->status_kasus === "B")
                    <span class="bg-warning py-1 px-3 text-white rounded">Belum Diproses</span> 
                @elseif($pengaduan->status_kasus === "P")
                    <span class="bg-primary py-1 px-3 text-white rounded">Sedang Diproses</span> 
                @elseif($pengaduan->status_kasus === "S")
                    <span class="bg-success py-1 px-3 text-white rounded">Selesai</span> 
                @endif
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 pt-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tahap Awal</div>
            <div class="py-2 pt-3 col-9 font-weight-500">
                {!! $pengaduan->tahap_awal?:"-" !!}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-1 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran</div>
            <div class="pt-1 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    @if(count($file_awal) > 0)
                        <ol class="pl-3">
                            @foreach($file_awal as $awal)
                            <li>
                                <a target="_blank" class="font-weight-bold" href="{{ url('/uploads/file/pengaduan/awal') }}/{{ $awal->nmfile }}">
                                    {{ $awal->nmfile }} <i class="fas fa-file ml-2"></i>
                                </a>
                            </li>
                            @endforeach
                        </ol>
                    @else
                        -
                    @endif
                </div>
                {{-- break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 pt-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tahap Proses</div>
            <div class="py-2 pt-3 col-9 font-weight-500">
                {!! $pengaduan->tahap_proses?:"-" !!}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-1 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran</div>
            <div class="pt-1 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    @if(count($file_proses) > 0)
                        <ol class="pl-3">
                            @foreach($file_proses as $proses)
                            <li>
                                <a target="_blank" class="font-weight-bold" href="{{ url('/uploads/file/pengaduan/proses') }}/{{ $proses->nmfile }}">
                                    {{ $proses->nmfile }} <i class="fas fa-file ml-2"></i>
                                </a>
                            </li>
                            @endforeach
                        </ol>
                    @else
                        -
                    @endif
                </div>
                {{-- break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tahap Akhir</div>
            <div class="py-2 col-9 font-weight-500">
                {!! $pengaduan->tahap_akhir?:"-" !!}
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-1 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran</div>
            <div class="pt-1 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    @if(count($file_akhir) > 0)
                        <ol class="pl-3">
                            @foreach($file_akhir as $akhir)
                            <li>
                                <a target="_blank" class="font-weight-bold" href="{{ url('/uploads/file/pengaduan/akhir') }}/{{ $akhir->nmfile }}">
                                    {{ $akhir->nmfile }} <i class="fas fa-file ml-2"></i>
                                </a>
                            </li>
                            @endforeach
                        </ol>
                    @else
                        -
                    @endif
                </div>
                {{-- break --}}
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran Foto</div>
            <div class="py-2 pb-3 col-9 font-weight-500 text-dark text-dark">
                @if(count($file_foto) > 0)
                    <ol class="pl-3">
                        @foreach($file_foto as $foto)
                        <li>
                            <a target="_blank" class="font-weight-bold" href="{{ url('/uploads/file/pengaduan/foto') }}/{{ $foto->nmfile }}">
                                {{ $foto->nmfile }} <i class="fas fa-file ml-2"></i>
                            </a>
                        </li>
                        @endforeach
                    </ol>
                @else
                    -
                @endif
            </div>
        </div>
       

        <div class="row mt-2 pt-3 mb-0">
            <div class="col-md-12 text-right">
                <a href="{{ route('pengaduan_index')}}" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>

                @if(!$pengaduan->delete_date)
                <a title="Proses Tindak Lanjut Pengaduan" href="{{ route('pengaduan_penanganan', $pengaduan->id)}}" 
                    class="btn btn-primary ml-2">
                    <span class="font-14"><i class="fas fa-rocket mr-2"></i>Tindak Lanjuti</span>
                </a>
                @endif

                @if(!$pengaduan->delete_date)
                    <a title="Ubah Data Pengaduan" href="{{ route('pengaduan_edit', $pengaduan->id)}}" 
                        class="btn btn-dark ml-2">
                        <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                    </a>
                @endif
                
                @if(!$pengaduan->delete_date)
                    <a href="{{ route('pengaduan_delete')}}" class="btn btn-danger ml-2"
                        data-toggle="modal" data-target="#exampleModalCenter" 
                        onclick="$('#idDelete').val({{ $pengaduan->id }});" title="Hapus Pengaduan">
                        <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                    </a>
                @else
                    <a href="{{ route('pengaduan_restore')}}" class="btn btn-dark ml-2"
                        id="btnRestore" data-toggle="modal" data-target="#modalRestore" 
                        onclick="$('#idRestore').val({{ $pengaduan->id }});" title="Kembalikan Pengaduan">
                        <span class="font-14"><i class="fas fa-reply text-success mr-2"></i>Restore</span>
                    </a>
                    <a href="{{ route('pengaduan_destroy')}}" class="btn btn-danger ml-2"
                        id="btnDestroy" data-toggle="modal" data-target="#modalDestroy" 
                        onclick="$('#idDestroy').val({{ $pengaduan->id }});" title="Hapus Permanen Pengaduan">
                        <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus Permanen</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<h4>Kolom Diskusi</h4>
<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row">
            <div class="col-md-4">
                <p class="text-dark">
                    Selama proses penangangan pengaduan berlangsung, Anda sebagai pelapor
                    bisa menggunakan fitur kolom diskusi untuk berkomunikasi dengan Admin.
                    Anda bisa menanyakan <i class="font-weight-500">progress</i> tindak-lanjut
                    pengaduan, memberikan detail informasi tambahan, dan lain sebagainya asalkan
                    masih relevan dengan topik masalah yang anda adukan.
                </p>
                <p class="font-weight-bold text-dark">
                    * Admin berhak menutup kolom diskusi sewaktu-waktu dan menghapus tanggapan yang tidak relevan.
                </p>
            </div>
            <div class="col-md-8">
                @include('sistem.pengaduan.respon')
            </div>
        </div>

    </div>
</div>
@endsection

@section('modal')
@include('sistem.pengaduan.modal-status')
<form method="POST" action="{{ route('pengaduan_delete')}}">
    @csrf
    @include('sistem.pengaduan.modal-del')
</form>

<form method="POST" action="{{ route('pengaduan_restore')}}">
    @csrf
    <input type="hidden" name="nmStatus" value="detail">
    @include('sistem.pengaduan.modal-restore')
</form>



<form method="POST" action="{{ route('pengaduan_destroy')}}">
    @csrf
    <input type="hidden" name="nmStatus" value="detail">
    @include('sistem.pengaduan.modal-destroy')
</form>

@endsection

@section('script')
@include('global.datatable')
<script>
    var table_respon =  $('#dt-respon').DataTable( {
                paging: 10,
                displayLength: 10,
                ordering: false,
                lengthChange: false,
                });
</script>
@endsection