@extends('layouts.admin') 

@section('title')
Kelola Jadwal Keberangkatan TKI - Keberangkatan Baru
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
.selectric{
        background-color: #F5F3FF;
        border-color: #C4B5FD;
        font-weight:500;
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
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Keberangkatan Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('jadwal_keberangkatan_index')}}"><u>Jadwal Keberangkatan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('jadwal_keberangkatan_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmStatus" value="baru">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3 font-15 ">
                        <span class="font-weight-bold text-dark">Jadwal</span> 
                        <br>
                        <span class="font-12 font-weight-500 text-primary">Keberangkatan</span>
                    </div>
                    <div class="col-md-9">
                        <input type="datetime-local" id="nmTglBerangkat" name="nmTglBerangkat" 
                            class="form-control h-45 border-form bg-form font-weight-500" required>
                        <small class="text-danger">{{ $errors->first('nmTglBerangkat') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pesawat</div>
                    <div class="col-md-9">
                        <select name="nmPesawat" id="nmPesawat" class="form-control select2 w-100" required>
                            <option value="">- Pilih -</option>
                            @foreach ($pesawat as $pes)
                                <option value="{{ $pes->jenis_id }}">[{{ $pes->kode }}] - {{ $pes->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold mb-2">
                        <span class="font-weight-bold text-dark">Nomor</span> 
                        <br>
                        <span class="font-12 font-weight-500 ">Penerbangan</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control font-weight-500 border-form bg-form h-45"
                            name="nmNoPenerbangan" value="{{ old('nmNoPenerbangan') }}" required>
                        <small class="text-danger">{{ $errors->first('nmNoPenerbangan') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 mb-2">
                        <span class="font-weight-bold text-dark">Dari</span> 
                        <br>
                        <span class="font-12 font-weight-500 ">Bandara Asal</span>
                    </div>
                    <div class="col-md-9">
                        <select name="nmBandaraAsal" id="nmBandaraAsal" class="form-control select2 w-100" required>
                            <option value="">- Pilih -</option>
                            @foreach ($bandara as $bd_asal)
                                <option value="{{ $bd_asal->jenis_id }}">
                                    [{{ $bd_asal->kode }}] - {{ $bd_asal->bandara }} - {{ $bd_asal->kota }} - {{ $bd_asal->negara }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold mb-2">
                        <span class="font-weight-bold text-dark">Ke</span> 
                        <br>
                        <span class="font-12 font-weight-500 ">Bandara Tujuan</span>
                    </div>
                    <div class="col-md-9">
                        <select name="nmBandaraTujuan" id="nmBandaraTujuan" class="form-control select2 w-100" required>
                            <option value="">- Pilih -</option>
                            @foreach ($bandara as $bd_tujuan)
                                <option value="{{ $bd_tujuan->jenis_id }}">
                                    [{{ $bd_tujuan->kode }}] - {{ $bd_tujuan->bandara }} - {{ $bd_tujuan->kota }} - {{ $bd_tujuan->negara }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr class="border-top2-dashed border-form pb-3">
                
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama TKI</div>
                    <div class="col-md-9 ">
                        <input type="text" id="nmTKI" name="nmTKI" 
                            class="form-control h-45 border-form bg-form font-weight-500" required>
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
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea name="nmAlamat" id="nmAlamat" rows="3" 
                        class="form-control border-form bg-form"></textarea>
                    </div>
                </div>
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
                {{-- <hr class="border-top2-dashed border-form"> --}}
            </div>
            <div class="col-md-6">
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
                    <div class="col-md-3 font-15 font-weight-bold mb-2">
                        <span class="font-weight-bold text-dark">Pengirim</span> 
                        <br>
                        <span class="font-12 font-weight-500">PPTKIS</span>
                    </div>
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
                        <textarea name="nmAgency" id="nmAgency" rows="2" 
                        class="form-control border-form bg-form font-weight-500"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold  mb-2">
                        <span class="font-weight-bold text-dark">Negara</span> 
                        <br>
                        <span class="font-12 font-weight-500 ">Penempatan</span>
                    </div>
                    <div class="col-md-9">
                        <select name="nmNegara" id="nmNegara" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($negara as $neg)
                                <option value="{{ $neg->jenis_id }}">{{ $neg->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Majikan</div>
                    <div class="col-md-9">
                        <input type="text" id="nmNamaMajikan" name="nmNamaMajikan" 
                            class="form-control h-42 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmMajikan') }}</small>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 font-15 font-weight-bold mb-2">
                        <span class="font-weight-bold text-dark">Alamat</span> 
                        <br>
                        <span class="font-12 font-weight-500 ">Majikan</span>
                    </div>
                    <div class="col-md-9">
                        <textarea name="nmAlamatMajikan" id="nmAlamatMajikan" rows="3" 
                        class="form-control border-form bg-form" placeholder="Alamat Majikan"></textarea>
                    </div>
                </div>

                <hr class="border-top2-dashed border-form pb-2">
                <div class="form-group row pt-2">
                    <div class="col-md-3 font-15 font-weight-bold mb-2">
                        <span class="font-weight-bold text-dark">Kontak</span> 
                        <br>
                        <span class="font-12 font-weight-500 ">Telp / Email</span>
                    </div>
                    <div class="col-md-9">
                        <textarea name="nmKontak" id="nmKontak" rows="2" placeholder="Kontak TKI"
                        class="form-control border-form bg-form"></textarea>
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3 font-15 mb-2">
                        <span class="font-weight-bold text-dark">Keterangan</span> 
                        <br>
                        <span class="font-12 font-weight-500">Tambahan</span>
                    </div>
                    <div class="col-md-9">
                        <textarea name="nmKeterangan" id="nmKeterangan" rows="4" 
                        class="form-control border-form bg-form"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 font-15 mb-2">
                        <span class="font-weight-bold text-dark">Status</span> 
                        <br>
                        <span class="font-12 font-weight-500">Keberangkatan</span>
                    </div>
                    <div class="col-md-9">
                        <select name="nmStatusBerangkat" id="nmStatusBerangkat" class="form-control selectric" style="font-size:16px;" >
                            <option value="0">Belum Berangkat</option>
                            <option value="1">Sudah Berangkat</option>
                            <option value="2">Batal</option>
                        </select>
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
