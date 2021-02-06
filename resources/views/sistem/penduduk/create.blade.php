@extends('layouts.admin') 

@section('title')
Kelola Data Penduduk - Data Baru
@endsection

@section('style')
    @include('global.custom-style')
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-friends font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Penduduk</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold
                rounded text-white align-top py-1 px-2">Baru
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
<span class="font-weight-bold text-dark">Data Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('partner_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmTipe" value="create">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-7 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Lengkap</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nmPartner" class="form-control bg-form font-weight-500 border-form text-form h-42">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                        NIK
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nmNIK" onchange="cekNik();"
                            class="form-control bg-form font-weight-500 border-form text-form h-42">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                        No. BPJS
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nmBPJS"  onchange="cekBpjs();"
                            class="form-control bg-form font-weight-500 border-form text-form h-42">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-1 font-14 font-weight-bold text-dark mb-2">J. Kelamin</div>
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
                    <div class="col-md-3 ">
                        <span class="font-14 font-weight-bold text-dark">Tempat, </span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Tgl. Lahir</span>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <input type="text" name="nmTempatLahir" class="form-control bg-form font-weight-500 border-form text-form h-42">
                        </div>
                        <div class="mt-2">
                            <input type="date" name="nmTglLahir" class="form-control bg-form font-weight-500 border-form text-form h-42">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 ">
                        <span class="font-14 font-weight-bold text-dark">Pendidikan</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Terakhir</span>
                    </div>
                    <div class="col-md-9">
                        <select name="nmPendidikan" id="nmPendidikan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($pendidikan as $pdk)
                                <option value="{{ $pdk->id }}">{{ $pdk->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                        Agama
                    </div>
                    <div class="col-md-9">
                        <select name="nmAgama" id="nmAgama" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($agama as $agm)
                                <option value="{{ $agm->id }}">{{ $agm->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-3 font-14 font-weight-bold text-dark">
                        Kontak
                    </div>
                    <div class="col-md-9">
                        <textarea type="text" name="nmKontak" class="form-control bg-form font-weight-500 border-form text-form h-42"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-3 font-14 font-weight-bold text-dark">
                        Email
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nmEmail" class="form-control bg-form font-weight-500 border-form text-form h-42">
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Alamat
                        </div>
                        <div>
                            <textarea type="text" name="nmAlamat" class="form-control bg-form font-weight-500 border-form text-form h-42"></textarea>
                        </div>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Provinsi
                        </div>
                        <div class="">
                            <select name="nmProvinsi" id="nmProvinsi" class="form-control select2"  onchange="getKota();">
                                <option value="">- Pilih -</option>
                                @foreach ($provinsi as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Kabupaten
                        </div>
                        <div class="">
                            <select name="nmKabupaten" id="nmKabupaten" class="form-control select2" onchange="getKecamatan();">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Kecamatan
                        </div>
                        <div class="">
                            <select name="nmKecamatan" id="nmKecamatan" class="form-control select2">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Keterangan
                        </div>
                        <div class="">
                            <textarea id="nmKeterangan" name="nmKeterangan" 
                                class="form-control bg-form font-weight-500 border-form text-form" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" 
                                    onclick="beriLogin();" id="cbBeriLogin" name="nmBeriLogin">
                            <label for="cbBeriLogin" class="custom-control-label font-14 font-weight-500 align-top text-primary" style="cursor:pointer;">
                            Beri Hak Akses Login Sistem
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="detailLogin" style="display:none;">
            <div class="border-top2-dashed mt-3 border-form"></div>
            <div class="row mt-4 mb-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-md-6">
                            <h5 class="mb-3 text-ungu">
                                <i class="fas fa-user-shield mr-2 align-middle"></i>Detail Login
                            </h5>
                            <div class="border border-form shadow p-4 rounded">
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">
                                    Username <i id="usernameSuccess" class="ml-2 font-18 far fa-check-circle text-success" style="display:none;"></i>
                                </label>
                                <div class="col-md-8">
                                    <input name="nmUsername" type="text" class="form-control bg-form font-weight-500 border-form h-42" 
                                        value="{{ old('nmUsername') }}"  onchange="cekUsername();">
                                    <span id="usernameError" class="font-12 text-danger font-weight-bold" 
                                            style="display:none;">* Username ini sudah digunakan</span>
                                    <small class="text-danger font-weight-bold">{{ $errors->first('nmUsername') }}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">
                                    Email <i id="emailSuccess" class="ml-2 font-18 far fa-check-circle text-success" style="display:none;"></i>

                                </label>
                                <div class="col-md-8">
                                    <input name="nmEmailLogin" type="email" class="form-control bg-form font-weight-500 border-form h-42" 
                                            value="{{ old('Email') }}" onchange="cekEmail();">
                                    <span id="emailError" class="font-12 text-danger font-weight-bold" style="display:none;">* Email ini sudah digunakan</span>
                                    <span id="formatError" class="font-12 text-danger font-weight-bold" style="display:none;">* Format Email Salah</span>
                                    <small class="text-danger font-weight-bold">{{ $errors->first('nmEmailLogin') }}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Password</label>
                                <div class="col-md-8">
                                    <input name="nmPassword" type="text" class="form-control bg-form font-weight-500 border-form h-42" value="{{ old('password') }}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Status</label>
                                <div class="col-md-8">
                                    <select name="nmStatusAktif" id="nmStatusAktif" class="form-control selectric" style="font-size:16px;" >
                                        <option value="pending" selected>Ditunda</option>
                                        <option value="active">Diterima (Aktif)</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="mt-4">
                                <h5 class="text-primary">Aksesibilitas</h5>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-3 font-weight-bold font-15">Konsultasi</label>
                                    <div class="col-md-8 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdKonsultasiAktif" name="nmStatusKonsultasi" class="custom-control-input" 
                                                value="aktif" checked>
                                            <label class="custom-control-label font-weight-bold text-primary" for="rdKonsultasiAktif" style="cursor:pointer;">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdKonsultasiTidak" name="nmStatusKonsultasi" class="custom-control-input" 
                                                value="tidak">
                                            <label class="custom-control-label font-weight-bold" for="rdKonsultasiTidak" style="cursor:pointer;">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-3 font-weight-bold font-15">Pengaduan</label>
                                    <div class="col-md-8 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdPengaduanAktif" name="nmStatusPengaduan" class="custom-control-input" 
                                                value="aktif" checked>
                                            <label class="custom-control-label font-weight-bold text-primary" for="rdPengaduanAktif" style="cursor:pointer;">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdPengaduanTidak" name="nmStatusPengaduan" class="custom-control-input" 
                                                value="tidak">
                                            <label class="custom-control-label font-weight-bold" for="rdPengaduanTidak" style="cursor:pointer;">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-3 font-weight-bold font-15">Lamaran</label>
                                    <div class="col-md-8 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdLamaranAktif" name="nmStatusLamaran" class="custom-control-input" 
                                                value="aktif" checked>
                                            <label class="custom-control-label font-weight-bold text-primary" for="rdLamaranAktif" style="cursor:pointer;">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdLamaranTidak" name="nmStatusLamaran" class="custom-control-input" 
                                                value="tidak">
                                            <label class="custom-control-label font-weight-bold" for="rdLamaranTidak" style="cursor:pointer;">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-3 font-weight-bold font-15">Pencaker</label>
                                    <div class="col-md-8 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdPencakerAktif" name="nmStatusPencaker" class="custom-control-input" 
                                                value="aktif"checked>
                                            <label class="custom-control-label font-weight-bold text-primary" for="rdPencakerAktif" style="cursor:pointer;">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdPencakerTidak" name="nmStatusPencaker" class="custom-control-input" 
                                                value="tidak">
                                            <label class="custom-control-label font-weight-bold" for="rdPencakerTidak" style="cursor:pointer;">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
    
            </div>
        </div>
        
    </div>
    <div class="card-footer text-center border-top">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark">
            <span class="font-15"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>

</form>

@endsection


@section('script')
@include('sistem.penduduk.script')
<script>
    function beriLogin() {
    var checkBox = document.getElementById("cbBeriLogin");
    if (checkBox.checked == true){
        $('#detailLogin').show();
        cekUsername();
        cekEmail();
    } else {
        $('#detailLogin').hide();
        $('#btn-simpan').prop('disabled', false);
    }
}
</script>

<script src="{{ asset('theme/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>


@endsection