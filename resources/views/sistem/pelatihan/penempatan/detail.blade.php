@extends('layouts.admin') 

@section('title')
Penempatan Peserta Pelatihan {{ $pelatihan->name }}
@endsection

@section('style')
@include('sistem.pelatihan.style-detail')
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-id-card-alt font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Pelatihan - Penempatan</h4> 
            <span class="ml-2 font-11 bg-primary rounded
                    text-white align-top py-1 px-2 font-weight-bold">Detail
            </span>
        </div>
            
        <span class="font-weight-bold">Penempatan Peserta</span>
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
<a href="{{ route('penempatan_index')}}"><u>Penempatan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">{{ $pelatihan->name }}</span>
@endsection

@section('content')
@include('global.notifikasi')
<form method="POST" action="{{ route('pelatihan_penempatan_update', $pelatihan->id )}}" id="formPenempatan">
@csrf

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
                    <div class="col-md-6 text-right">
                        <a href="{{ route('pelatihan_sertifikasi_detail', $pelatihan->id)}}" 
                            class="font-weight-bold text-white" title="Lihat Proses Sertifikasi">
                            <u class="font-14"><i class="fas fa-clipboard-check mr-2"></i>Lihat Detail Sertifikasi</u>
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
                                <a href="{{ route('pelatihan_kelulusan_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Kembali Ke Kelulusan Peserta"><i class="fas fa-caret-left font-14 mx-2"></i>Kelulusan 
                                </a>
                                <a href="{{ route('pelatihan_penerimaan_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Kembali Ke Penerimaan Peserta"><i class="fas fa-caret-left font-14 mx-2"></i>Penerimaan 
                                </a>
                                <a href="{{ route('pelatihan_pendaftaran_detail', $pelatihan->id)}}" class="text-dark dropdown-item" 
                                    title="Pendaftaran Peserta"><i class="fas fa-caret-left font-14 mx-2"></i>Pendaftaran 
                                </a>
                                <a href="{{ route('pelatihan_create')}}" class="text-success dropdown-item" 
                                    title="Buat Program Pelatihan Baru"><i class="fas fa-plus mr-2 font-12"></i>Pelatihan Baru 
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

        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Durasi Pelatihan</div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                {{ $pelatihan->jam_pelajaran }} Jam 
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
                Tanggal Sertifikasi
            </div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                {{ \Carbon\Carbon::parse($pelatihan->tgl_sertifikasi)->format('d-m-Y') }}
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
               Lulus Sertifikasi
            </div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                <span class="text-ungu">
                    {{ $pelatihan->jml_lulusan_sertifikasi }} Peserta
                </span>
                <span class="mx-2">/</span>
                {{ $pelatihan->lulusan_sertifikasi_l}} Laki-Laki, 
                {{ $pelatihan->lulusan_sertifikasi_p}} Perempuan
            </div> 
        </div>
        <div class="form-group row m-0">
            <div class="pt-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
               Penempatan
            </div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                <span class="text-ungu">
                    {{ $pelatihan->jml_penempatan }} Peserta
                </span>
                <span class="mx-2">/</span>
                {{ $pelatihan->penempatan_l}} Laki-Laki, 
                {{ $pelatihan->penempatan_p}} Perempuan
            </div> 
        </div>

        <div class="form-group row m-0">
            <div class="py-2 pb-4  col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
               Jenis Penempatan
            </div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                {{ $pelatihan->jml_penempatan_informal}} Informal, 
                {{ $pelatihan->jml_penempatan_formal}} Formal
            </div> 
        </div>

        @if($pelatihan->status_pelatihan === "valid")
        <div class="form-group row m-0">
            <div class="py-3 col-3 bg-light3 border-right"></div>
            <div class="py-3 col-9 bg-light3">
                <div class="">
                    <a data-toggle="modal" data-target="#modalSelesai" title="Update Status Pelatihan Menjadi Selesai" 
                        class="iconStatus btn btn-success text-white font-14 py-2 mr-2" style="cursor:pointer;"> 
                        <i class="far fa-check-circle mr-2"></i>Pelatihan Selesai
                    </a>
                </div>
                
            </div>
        </div>
        @endif
            <div  class="mt-3 table-responsive">
                <div class="float-left font-weight-bold">
                    <div class="pt-2">
                        <i class="fas fa-id-card-alt text-dark font-14 align-middle mr-2"></i> 
                        <span class="text-dark text-ungu font-18 align-middle">Detail Penempatan Peserta</span>
                    </div> 
                </div>
                @if($pelatihan->status_pelatihan === "valid")
                    <div class="float-right">
                        <a id="btnUbah" onclick="KlikUbah();" 
                            class="dataAwal btn btn-primary text-white font-14 py-2" 
                            title="Ubah Penempatan Peserta" style="cursor:pointer;">
                            <i class="fas fa-edit mr-2"></i>Ubah Penempatan
                        </a>
                        <a id="btnBatal" onclick="KlikBatal();" 
                            class="ubahData btn btn-secondary text-dark font-14 py-2 mr-2" 
                            title="Batal" style="cursor:pointer;display:none;">
                            <i class="fas fa-times"></i>
                        </a>
                        <button type="submit" class="btnSimpan ubahData btn 
                                btn-dark text-white font-14 py-2" 
                                title="Batal" style="cursor:pointer;display:none;">
                                <i class="fas fa-check mr-2"></i>Simpan
                        </button>
                    </div>
                @endif
                <table id="dt-penempatan" class="table w-100">
                    <thead>
                        <tr>
                            <th class="py-2" style="width:5%;">#</th>
                            <th class="py-2 font-14 align-middle" style="width:20%;">Nama</th>
                            <th class="py-2 font-14 align-middle">Sertifikasi</th>
                            <th class="py-2 font-14 align-middle">Penempatan</th>
                            <th class="py-2 font-14 align-middle" style="width:15%;">Tanggal Pen.</th>
                            <th class="py-2 font-14 align-middle" style="width:25%;">Perusahaan Penempatan</th>
                            <th class="py-2 font-14 align-middle" style="width:15%;">Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penempatan_detail as $detail)
                        <tr>
                            <td class="align-middle font-14"></td>
                            <td class="align-middle">
                                <input type="hidden" name="nmIDline[]" value="{{ $detail->id }}">
                                <span class="font-weight-bold text-dark font-14">{{ $detail->nama }}</span>   
                                <br>
                                <span class="font-weight-500 text-dark">{{ $detail->jk }}</span><span class="mx-2">/</span>{{ $detail->nik }}
                            </td>
                            <td class="align-middle text-dark font-weight-500">
                                @if($detail->status_kompeten === "ya")
                                    <i class="far fa-check-circle text-success mr-2"></i> Lulus
                                @else
                                    <i class="far fa-times-circle text-danger mr-2"></i> Tidak
                                @endif
                            </td>
                            <td class="align-middle text-dark font-weight-500">
                                @if($detail->perusahaan_penempatan)
                                    <i class="far fa-check-circle text-success mr-2"></i> Ya
                                @else
                                    <i class="far fa-times-circle text-danger mr-2"></i> Tidak
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="dataAwal font-weight-500 font-14 text-dark">{{ $detail->tgl_penempatan?:"-"}}</div>
                                <input type="date" name="nmTglPenempatan[]" class="ubahData bg-form text-form border 
                                border-form rounded px-2" style="height:40px;width:90%;display:none;" value="{{ $detail->tgl_penempatan?:"" }}">
                                <span class="ubahData" style="display:none;">
                                    @if($detail->tgl_penempatan)
                                    <i class="ml-1 fas fa-times text-danger" onclick="var tr = $(this).closest('tr');tr.find('input[type=date]').val('');" 
                                        title="Hapus Tanggal" style="cursor:pointer">
                                    </i>
                                    @endif
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="dataAwal font-14 text-dark font-weight-500">{{ $detail->perusahaan?:"-"}}</div>
                                <span class="ubahData" style="display:none;">
                                    <select name="nmPerusahaan[]" class=" select2" >
                                        <option value="">- Pilih Perusahaan -</option>
                                        @foreach ($perusahaan as $per)
                                        <option value="{{ $per->id}}" @if($per->id === $detail->perusahaan_penempatan) selected @endif>
                                            {{ $per->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </span>
                                
                            </td>
                            <td class="align-middle">
                                <div class="dataAwal font-14 text-dark font-weight-500">
                                    @if($detail->jenis_penempatan === "tidak")
                                        -
                                    @else
                                        {{ $detail->jenis_penempatan }}
                                    @endif
                                </div>
                                <select name="nmJenisPenempatan[]" id="JenisPenempatan" class="ubahData bg-form text-form border 
                                    border-form rounded px-2" style="height:40px;display:none;">
                                    <option value="tidak" @if($detail->jenis_penempatan === "tidak") selected @endif>- Pilih -</option>
                                    <option value="formal" @if($detail->jenis_penempatan === "formal") selected @endif>Formal</option>
                                    <option value="informal" @if($detail->jenis_penempatan === "informal") selected @endif>Informal</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($pelatihan->status_pelatihan === "valid")
                <div class="float-right">
                    <a id="btnUbah" onclick="KlikUbah();" 
                        class="dataAwal btn btn-primary text-white font-14 py-2" 
                        title="Ubah Penempatan Peserta" style="cursor:pointer;">
                        <i class="fas fa-edit mr-2"></i>Ubah Penempatan
                    </a>
                    <a id="btnBatal" onclick="KlikBatal();" 
                        class="ubahData btn btn-secondary text-dark font-14 py-2 mr-2" 
                        title="Batal" style="cursor:pointer;display:none;">
                        <i class="fas fa-times"></i>
                    </a>
                    <button type="submit" class="btnSimpan ubahData btn btn-dark text-white font-14 py-2" 
                        title="Batal" style="cursor:pointer;display:none;">
                        <i class="fas fa-check mr-2"></i>Simpan
                    </button>
                </div>
                @endif
            </div>
        
    </div>
</div>
</form>
@endsection

@section('modal')
@include('sistem.pelatihan.modal-selesai')
@endsection

@section('script')


<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>

@include('sistem.pelatihan.penempatan.detail-table')

@include('sistem.pelatihan.penempatan.script')

{{-- <script>
    setTimeout(function(){ 
        $('#dt-penempatan').find('input, select').attr('disabled','disabled');
    }, 500);
</script> --}}
@if(Session::has('sweetSuccess'))
  <script type="text/javascript">
     const Toast1 = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast1.fire({
            icon: 'success',
            html: '<span class="font-weight-500 ml-3 text-white">Memperbarui Penempatan</span>',
            background: '#47c363',
            width: 300
        });h(swal.noop);
 </script>
 @endif

@endsection

