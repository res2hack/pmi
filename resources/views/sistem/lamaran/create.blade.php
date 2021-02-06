@extends('layouts.admin') 

@section('title')
Kelola Data Lamaran - Baru
@endsection

@section('style')
    @include('global.custom-style')
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-id-card font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Lamaran</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">
                Baru
            </span>
        </div>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('lamaran_index')}}"><u>Lamaran</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form id="formLamaran" method="post" action="{{ route('lamaran_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmTipe" value="create">
<input type="hidden" id="tipePelamar" name="nmTipePelamar" value="exists">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6 pb-0 border-right">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Lowongan</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Tujuan</span>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmLowongan" id="nmLowongan" class=" form-control select2 tes2 w-100" required>
                                <option value="">- Pilih -</option>
                                @foreach ($lowongan as $low)
                                    <option value="{{ $low->id }}">
                                        ({{ $low->jabatan }} - {{ $low->negara }}) - {{ $low->agency}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Tanggal</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Melamar</span>
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglRegistrasi" name="nmTglRegistrasi" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ now()->format('Y-m-d') }}{{ old('nmTglRegistrasi') }}">
                        <small class="text-danger">{{ $errors->first('nmTglRegistrasi') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Pelamar</span>
                    </div>
                    <div class="col-md-9">
                            <div class="pendudukExists">
                                <select name="nmPenduduk" id="nmPenduduk" onchange="pelamarExists();"
                                    class="select2 form-control  w-100">    
                            
                                </select>
                                <input type="hidden" name="nmIDlamaranExists" value="">
                            </div>
                            <div class="pendudukBaru" style="display:none;">
                                <input type="text" id="nmPelamar" name="nmPelamar" 
                                class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                                value="{{ old('nmPelamar') }}" >
                                <small class="text-danger">{{ $errors->first('nmPelamar') }}</small>
                            </div>
                            <div  class="pendudukExists font-13 mt-2 font-weight-500 text-dark">
                                Ambil Dari Data Penduduk Atau
                                <a onclick="detailPelamarShow();$('#tipePelamar').val('baru');" 
                                    class="mx-1 font-14 text-primary" style="cursor:pointer;">
                                    <u>
                                    Buat Baru<i class="fas fa-user-plus font-11 ml-2"></i>
                                    </u>
                                </a> 
                            </div>
                            <div class="pendudukBaru font-13 mt-2" style="display:none;">
                                <a onclick="detailPelamarHide();$('#tipePelamar').val('exists');" 
                                    class="font-14 text-danger" style="cursor:pointer;">
                                        <i class="fas fa-undo mr-2 font-11"></i> <u>Batal</u> 
                                        <span class="text-dark ml-1 font-13 font-weight-500">
                                            (Ambil Dari Data Penduduk)
                                        </span>
                                </a> 
                            </div>
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-14 font-weight-bold text-dark">
                        NIK / KTP
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmNIK" name="nmNIK" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ old('nmNIK') }}">
                    <small class="text-danger">{{ $errors->first('nmNIK') }}</small>
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">No. BPJS</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Ketenagakerjaan</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmBPJS" name="nmBPJS" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ old('nmBPJS') }}">
                    <small class="text-danger">{{ $errors->first('nmBPJS') }}</small>
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
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
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark">
                        Tgl. Lahir
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglLahir" name="nmTglLahir" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ old('nmTglLahir') }}">
                    <small class="text-danger">{{ $errors->first('nmTglLahir') }}</small>
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-weight-bold font-15 text-dark">Kontak / Telp.</div>
                    <div class="col-md-9">
                        <textarea id="nmKontak" name="nmKontak" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold"></textarea>
                        <small class="text-danger">{{ $errors->first('nmKontak') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Agama</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmAgama" id="nmAgama" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                @foreach ($agama as $agm)
                                    <option value="{{ $agm->id }}">{{ $agm->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-weight-bold font-15 text-dark">Email</div>
                    <div class="col-md-9">
                        <input type="email" id="nmEmail" name="nmEmail" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ old('nmEmail') }}">
                        <small class="text-danger">{{ $errors->first('nmEmail') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                    <textarea id="nmAlamat" name="nmAlamat" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold"></textarea>
                        <small class="text-danger">{{ $errors->first('nmAlamat') }}</small>
                    </div>
                </div>

                <div class="form-group row pt-2 detailPelamar" style="display:none;">
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
                <div class="form-group row pt-2 detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kab. / Kota</div>
                    <div class="col-md-9">
                        <select name="nmKabKota" id="nmKabKota" onchange="getKecamatan();" class="form-control select2 w-100">
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2 detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kecamatan</div>
                    <div class="col-md-9">
                        <select name="nmKecamatan" id="nmKecamatan" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pendidikan</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmPendidikan" id="nmPendidikan" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                @foreach ($pendidikan as $pdk)
                                    <option value="{{ $pdk->id }}">{{ $pdk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <textarea id="nmJurusan" name="nmJurusan" rows="2" placeholder="Jurusan..."
                            class="form-control h-45 border-form bg-form text-form font-weight-bold"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;" >
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">Foto Resmi</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Terbaru</span>
                    </div>
                    <div class="col-md-9">
                        <div id="image-preview2" class="image-preview">
                            <label for="image-upload" id="image-label2">Pilih Foto</label>
                            <input type="file" name="nmFoto" id="image-upload2" class="img-fluid" />
                        </div>

                        {{-- <input type="file" id="nmFoto" name="nmFoto" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ old('nmFoto') }}"> --}}
                    <small class="text-danger">{{ $errors->first('nmFoto') }}</small>
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">CV (C. Vitae)</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Riwayat Hidup</span>
                    </div>
                    <div class="col-md-9">
                        <input type="file" id="nmCV" name="nmCV" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ old('nmCV') }}">
                        <small class="text-danger">{{ $errors->first('nmCV') }}</small>
                    </div>
                </div>
                <div class="form-group row detailPelamar" style="display:none;">
                    <div class="col-md-3">
                        <span class=" font-weight-bold font-15 text-dark">Keterangan</span>
                        <br>
                        <span class="font-13 font-weight-500 text-primary">Tambahan</span>
                    </div>
                    <div class="col-md-9">
                        <textarea id="nmKeterangan" name="nmKeterangan" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold"></textarea>
                        <small class="text-danger">{{ $errors->first('nmKeterangan') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 font-weight-bold font-15 text-dark ">
                        <div class="border-bottom pb-1">
                            Prasyarat
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbKompetensi" name="nmKompetensi">
                            <label for="cbKompetensi" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Memiliki Kompetensi yang sesuai ?
                            </label>
                        </div>
                        <div class="custom-control mt-2 custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbSehat" name="nmSehat">
                            <label for="cbSehat" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Sehat Jasmani dan Rohani?
                            </label>
                        </div>
                        <div class="custom-control mt-2 custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbDokumen" name="nmDokumen">
                            <label for="cbDokumen" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Memiliki Dokumen Sesuai Persyaratan ?
                            </label>
                        </div>
                    </div>
                </div>
                {{-- <i id="yesLogin" class="fas fa-circle-check text-success" style="display:none;"></i>
                <i id="noLogin" class="fas fa-circle-check text-success" style="display:none;"></i> --}}
                <div id="textLogin" class="p-3 mt-5 border rounded border-form shadow text-dark text-center" style="display:none;"></div>

                <div class="beriLogin border-top2-dashed mt-4 border-form" style="display:none;"></div>
                <div class="beriLogin form-group row mt-3" style="display:none;">
                    <div class="col-md-12">
                        <div class="mt-2">
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

                
                <div id="detailLogin" style="display:none;">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">
                                    Username <i id="usernameSuccess" class="ml-2 font-18 far fa-check-circle text-success" style="display:none;"></i>
                                </label>
                                <div class="col-md-8">
                                    <input id="nmUsername" name="nmUsername" type="text" class="form-control bg-form border-form h-42" 
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
                                    <input id="nmEmailLogin" name="nmEmailLogin" type="email" class="form-control bg-form border-form h-42" 
                                            value="{{ old('Email') }}" onchange="cekEmail();">
                                    <span id="emailError" class="font-12 text-danger font-weight-bold" style="display:none;">* Email ini sudah digunakan</span>
                                    <span id="formatError" class="font-12 text-danger font-weight-bold" style="display:none;">* Format Email Salah</span>
                                    <small class="text-danger font-weight-bold">{{ $errors->first('nmEmailLogin') }}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Password</label>
                                <div class="col-md-8">
                                    <input id="nmPassword" name="nmPassword" type="text" class="form-control bg-form border-form h-42" value="{{ old('password') }}" >
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
@include('sistem.lamaran.script')

@include('sistem.lamaran.script-cek')

<script>
    $('#btn-simpan').on('click',function(e){
        e.preventDefault();

        let form = $('#formLamaran');
        let nama_lowongan = $('#nmLowongan').val();
        let tipe_pelamar = $('#tipePelamar').val();
        let pelamar_exists = $('#nmPenduduk').val();
        let pelamar_baru = $('#nmPelamar').val();

        let beri_login = document.getElementById("cbBeriLogin");
        let username = $('#nmUsername').val();
        let email_login = $('nmEmailLogin').val();
        let password = $('nmPassword').val();

        if(tipe_pelamar == "exists" && !nama_lowongan){
            swal.fire({
                title: 'Lowongan Tujuan Belum Dipilih',
                text: 'Pilih Lowongan Terlebih Dahulu',
                icon: 'error',
            });
        }
        else if(tipe_pelamar == "exists" && !pelamar_exists){
            swal.fire({
                title: 'Pelamar Belum Dipilih',
                text: 'Cari Pelamar Dari Data Penduduk. Jika Tidak Ada, Buat Data Penduduk Baru',
                icon: 'error',
            });
        }
        else if(tipe_pelamar !== "exists" && !pelamar_baru )
        {
            swal.fire({
                title: 'Nama Pelamar Masih Kosong',
                text: 'Nama Pelamar harus diisi',
                icon: 'error',
            });
        }
        else if(beri_login.checked == true && (!username || !email_login || !password)){
            swal.fire({
                title: 'Detail Login Ada Yang Belum Diisi',
                text: 'Pastikan username, email login, dan password terisi',
                icon: 'error',
            });
        }
        else{
            form.submit();
        }

    });
</script>

@include('global.upload-preview')
@endsection