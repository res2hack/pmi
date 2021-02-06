@extends('layouts.admin') 

@section('title')
Kelola Data Kedatangan TKI - Kedatangan Baru
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('theme/node_modules/select2/dist/css/select2.min.css') }}">
<style>
.modal-backdrop {
        z-index: 0;
}
.select2-container--default .select2-selection--single, .select2-selection--multiple{
    background-color: #F5F3FF !important;
    border-color: #C4B5FD !important;
    /* padding-top: 6px !important; */
    font-weight:500 !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #aaa;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    margin-right:8px;
    color:#ffffff;
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
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Kedatangan Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('kedatangan_index')}}"><u>Kedatangan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('kedatangan_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmStatus" value="baru">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Datang</div>
                    <div class="col-md-5">
                        <input type="date" id="nmTglDatang" name="nmTglDatang" value="{{ now()->format('Y-m-d') }}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmTglDatang') }}</small>
                    </div>
                    <div class="col-md-4">
                        <input type="time" id="nmJamDatang" name="nmJamDatang" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmJamDatang') }}</small>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Jadwal</div>
                    <div class="col-md-5">
                        <input type="time" id="nmJamDatang" name="nmJamDatang" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmJamDatang') }}</small>
                    </div>
                </div> --}}
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pesawat</div>
                    <div class="col-md-9">
                        <select name="nmPesawat" id="nmPesawat" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($pesawat as $pes)
                                <option value="{{ $pes->jenis_id }}">[{{ $pes->kode }}] - {{ $pes->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr class="border-top2-dashed border-form">
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">No. Paspor</div>
                    <div class="col-md-9">
                        <input type="text" id="nmPaspor" name="nmPaspor" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmPaspor') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">K. Imigrasi</div>
                    <div class="col-md-9">
                        <select name="nmImigrasi" id="nmImigrasi" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($imigrasi as $imi)
                            <option value="{{ $imi->jenis_id }}">{{ $imi->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama TKI</div>
                    <div class="col-md-9">
                        <input type="text" id="nmTKI" name="nmTKI" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmTKI') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Lahir</div>
                    <div class="col-md-5">
                        <input type="date" id="nmTglLahir" name="nmTglLahir" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">J. Kelamin</div>
                    <div class="col-md-9 mt-1">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdLaki" name="nmJK" class="custom-control-input" value="L" checked>
                            <label class="custom-control-label font-weight-bold" for="rdLaki" style="cursor:pointer;">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdPerempuan" name="nmJK" class="custom-control-input" value="P">
                            <label class="custom-control-label font-weight-bold" for="rdPerempuan" style="cursor:pointer;">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pendidikan</div>
                    <div class="col-md-9">
                        <select name="nmPendidikan" id="nmPendidikan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($pendidikan as $pdk)
                                <option value="{{ $pdk->jenis_id }}">{{ $pdk->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr class="border-top2-dashed border-form">
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Provinsi</div>
                    <div class="col-md-9">
                        <select name="nmProvinsi" id="nmProvinsi" onchange="getKota();" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kab. / Kota</div>
                    <div class="col-md-9">
                        <select name="nmKabKota" id="nmKabKota" onchange="getKecamatan();" class="form-control select2 w-100">
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kecamatan</div>
                    <div class="col-md-9">
                        <select name="nmKecamatan" id="nmKecamatan" onchange="getDesa();" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kel. / Desa</div>
                    <div class="col-md-9">
                        <select name="nmDesa" id="nmDesa" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea name="nmAlamat" id="nmAlamat" rows="4" 
                        class="form-control border-form bg-form"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="border-bottom pb-2 mb-4">PPTKIS</h4>
                
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pengirim</div>
                    <div class="col-md-9">
                        <select name="nmPptkis" id="nmPptkis" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($perusahaan as $prsh)
                                <option value="{{ $prsh->id }}">{{ $prsh->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Agency</div>
                    <div class="col-md-9">
                        <input type="text" id="nmAgency" name="nmAgency" 
                            class="form-control h-42 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmAgency') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Negara P.</div>
                    <div class="col-md-9">
                        <select name="nmNegara" id="nmNegara" class="form-control select2 w-100">
                            <option value="">- Pilih Negara Penempatan -</option>
                            @foreach ($negara as $neg)
                                <option value="{{ $neg->jenis_id }}">{{ $neg->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pekerjaan</div>
                    <div class="col-md-4">
                        <select name="nmSektor" id="nmSektor" class="form-control select2 w-100" onchange="getPekerjaan();">
                            <option value="">- Pilih -</option>
                            @foreach ($sektor as $sek)
                                <option value="{{ $sek->jenis_id }}">{{ $sek->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="nmPekerjaan" id="nmPekerjaan" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Brgkt</div>
                    <div class="col-md-5">
                        <input type="date" id="nmTglBerangkat" name="nmTglBerangkat" onchange="masaKerja();"
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control bg-form border-form
                                    h-42 text-center" id="nmMasaKerja" name="nmMasaKerja" readonly>
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form border-form font-13 font-weight-bold px-2">Thn/Bln</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">J. Kepulangan</div>
                    <div class="col-md-5">
                        <select name="nmJenisPulang" id="nmJenisPulang" class="form-control select2 w-100">
                            @foreach ($jenis_pulang as $jpul)
                                <option value="{{ $jpul->jenis_id }}">{{ $jpul->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control bg-form border-form h-42 text-center" name="nmPulangHari" >
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form border-form font-13 font-weight-bold">Hari</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Masalah</div>
                    <div class="col-md-9">
                        <select name="nmMasalah[]" id="nmMasalah" class="form-control select2 w-100" multiple="multiple">
                            <option value="">- Pilih -</option>
                            @foreach ($masalah as $mas)
                                <option value="{{ $mas->jenis_id }}">{{ $mas->name }}</option>
                            @endforeach
                        </select>
                        <div class="mt-3 mb-1 text-dark font-weight-500">Masalah lainnya</div>
                        <div>
                            <input type="text" name="nmMasalahLain" class="form-control bg-form border-form h-42">
                        </div>
                    </div>
                </div>
                
                <h4 class="border-bottom mt-5 pb-2 mb-4">Proses Kepulangan</h4>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kepulangan</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmKepulangan" id="nmKepulangan"  onchange="cekKepulangan();"
                                    class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                @foreach ($pulang as $pul)
                                    <option value="{{ $pul->jenis_id }}">{{ $pul->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="dijemput" class="mt-3" style="display:none;">
                            <select name="nmDijemput" id="nmDijemput" class="form-control select2 w-100">
                                @foreach ($dijemput as $jemput)
                                    <option value="{{ $jemput->jenis_id }}">
                                        {{ $jemput->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div id="pulangSendiri" class="mt-3" style="display:none;">
                            <select name="nmPulangSendiri" id="nmPulangSendiri" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                @foreach ($pulang_sendiri as $pulsd)
                                    <option value="{{ $pulsd->jenis_id }}" >
                                        {{ $pulsd->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="nmNamaPenjemput" class="mt-3" style="display:none;">
                            <input type="text" id="nmDijemputOleh" name="nmDijemputOleh" 
                                class="form-control h-45 border-form bg-form font-weight-500 "
                                placeholder="Nama Penjemput...">
                        </div>
                        <div id="Menggunakan" class="mt-3" style="display:none;">
                            <input type="text" id="nmMenggunakan" name="nmMenggunakan" 
                                class="form-control h-45 border-form bg-form font-weight-500" placeholder="Menggunakan...">
                        </div>
                        <div id="Transit" class="mt-3" style="display:none;">
                            <input type="text" id="nmTransit" name="nmTransit" 
                            class="form-control h-45 border-form bg-form font-weight-500" placeholder="Transit...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>

</form>

@endsection

@section('script')
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>

@include('sistem.kedatangan.script')

@endsection
