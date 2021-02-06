@extends('layouts.admin') 

@section('title')
Kelola Data Pelamar - Ubah
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
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">Ubah</span>
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
<a href="{{ route('lamaran_detail', $lamaran_first->id_lamaran)}}"><u>#{{$lamaran_first->id_lamaran}} - {{ $lamaran_first->name }}</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Ubah Data</span>

@endsection

@section('content')

@include('global.notifikasi')

<form id="formLamaran" method="post" action="{{ route('lamaran_update')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmTipe" value="edit">
<input type="hidden" name="nmID" value="{{ $lamaran_first->id_lamaran }}">

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
                            <select name="nmLowongan" id="nmLowongan" class="form-control select2 w-100" required>
                                <option value="">- Pilih -</option>
                                @foreach ($lowongan as $low)
                                    <option value="{{ $low->id }}" @if($lamaran_first->sip_id === $low->id) selected @endif>
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
                        value="{{ $lamaran_first->tgl_registrasi }}{{ old('nmTglRegistrasi') }}">
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
                        <input type="text" id="nmPelamar" name="nmPelamar" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ $lamaran_first->name }}{{ old('nmPelamar') }}">
                    <small class="text-danger">{{ $errors->first('nmPelamar') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-14 font-weight-bold text-dark">
                        NIK / KTP
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmNIK" name="nmNIK" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ $lamaran_first->nik }}{{ old('nmNIK') }}">
                    <small class="text-danger">{{ $errors->first('nmNIK') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">No. BPJS</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Ketenagakerjaan</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmBPJS" name="nmBPJS" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ $lamaran_first->bpjs }}{{ old('nmBPJS') }}">
                    <small class="text-danger">{{ $errors->first('nmBPJS') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">J. Kelamin</div>
                    <div class="col-md-9 mt-1">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdLaki" name="nmJK" class="custom-control-input" 
                                    value="L" @if($lamaran_first->jk === "L") checked @endif>
                            <label class="custom-control-label font-weight-bold" for="rdLaki" style="cursor:pointer;">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdPerempuan" name="nmJK" class="custom-control-input" 
                                value="P" @if($lamaran_first->jk === "P") checked @endif>
                            <label class="custom-control-label font-weight-bold" for="rdPerempuan" style="cursor:pointer;">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark">
                        Tgl. Lahir
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglLahir" name="nmTglLahir" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ $lamaran_first->tgl_lahir }}{{ old('nmTglLahir') }}">
                    <small class="text-danger">{{ $errors->first('nmTglLahir') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-weight-bold font-15 text-dark">Kontak / Telp.</div>
                    <div class="col-md-9">
                        <textarea id="nmKontak" name="nmKontak" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold">{{ $lamaran_first->kontak }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmKontak') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Agama</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmAgama" id="nmAgama" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                @foreach ($agama as $agm)
                                    <option value="{{ $agm->id }}" 
                                        @if($lamaran_first->agama_id === $agm->id) selected @endif>
                                        {{ $agm->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-weight-bold font-15 text-dark">Email</div>
                    <div class="col-md-9">
                        <input type="email" id="nmEmail" name="nmEmail" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="{{ $lamaran_first->email }}{{ old('nmEmail') }}">
                        <small class="text-danger">{{ $errors->first('nmEmail') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                    <textarea id="nmAlamat" name="nmAlamat" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold">{{ $lamaran_first->alamat }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmAlamat') }}</small>
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Provinsi</div>
                    <div class="col-md-9">
                        <select name="nmProvinsi" id="nmProvinsi" onchange="getKota();" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}"
                                    @if($lamaran_first->provinsi_id === $prov->id) selected @endif>
                                    {{ $prov->nama }}
                                </option>
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
                        <select name="nmKecamatan" id="nmKecamatan" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pendidikan</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmPendidikan" id="nmPendidikan" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                @foreach ($pendidikan as $pdk)
                                    <option value="{{ $pdk->id }}" @if($lamaran_first->pendidikan_id === $pdk->id) selected @endif>
                                        {{ $pdk->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <textarea id="nmJurusan" name="nmJurusan" rows="2" placeholder="Jurusan..."
                            class="form-control h-45 border-form bg-form text-form font-weight-bold">{{ $lamaran_first->jurusan }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3">
                        <span class="font-14 font-weight-bold text-dark">Foto Resmi</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Terbaru</span>
                        @if($lamaran_first->foto)
                            <br>
                            <div class="mt-3">
                                
                                <a id="hapusFoto" class="text-primary font-13" style="cursor:pointer;"
                                    onClick="$('#image-preview2').css('background-image','');$('#hapusFoto').hide();
                                    $('#fotoUndo').show();$('#statusFoto').val('{{$lamaran_first->foto}}');">
                                    <i class="fas fa-times text-danger font-13 mr-2"></i><u>Hapus Foto</u>
                                </a>
                                <a id="fotoUndo" style="cursor:pointer;display:none;" 
                                    onclick="$('#hapusFoto').show();$('#fotoUndo').hide();
                                    $('#image-preview2').css('background-image', 'url({{ url($lamaran_first->foto) }})');
                                    $('#statusFoto').val('0');" class="font-13 text-primary">
                                    <i class="text-primary font-13 mr-2 fas fa-reply"></i><u>Batal</u>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-9">
                        @if($lamaran_first->foto)
                            <div id="image-preview2" class="image-preview" @if($lamaran_first->foto) style="background-image: url('{{ url($lamaran_first->foto) }}');background-repeat: no-repeat;background-size: cover;" @endif>
                                <label for="image-upload" id="image-label2">Pilih Foto</label>
                                <input type="file" name="nmFoto" id="image-upload2" class="img-fluid" />
                            </div>
                            
                            <small class="text-danger">{{ $errors->first('nmFoto') }}</small>
                        @else
                            <div id="image-preview2" class="image-preview" style="background-size:cover;" >
                                <label for="image-upload" id="image-label2">Pilih Foto</label>
                                <input type="file" name="nmFoto" id="image-upload2" class="img-fluid" />
                            </div>
                        @endif
                        <input type="hidden" id="statusFoto" name="statusFoto" value="0">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">CV (C. Vitae)</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Riwayat Hidup</span>
                    </div>
                    <div class="col-md-9">
                        
                        @if($lamaran_first->cv)
                            <div id="idLampiran" class="mb-2">
                                <a href="{{ url($lamaran_first->cv)}}" target="_blank" class="font-weight-bold mr-3 font-15">
                                    <u>{{ str_replace("uploads/file/pmi/cv/", "", $lamaran_first->cv)}}</u>
                                </a> 
                                <a style="cursor:pointer;" onclick="$('#idCV').show();$('#idLampiran').hide();
                                    $('#statusCV').val('{{$lamaran_first->cv}}');">
                                    <i class="text-primary ml-2 fas fa-edit"></i>
                                </a>
                                <a style="cursor:pointer;" onclick="$('#idCV').show();$('#idLampiran').hide();
                                    $('#statusCV').val('{{$lamaran_first->cv}}');">
                                    <i class="text-danger ml-2 font-16 fas fa-times"></i>
                                </a>
                            </div>
                            <div id="idCV" class="" style="display:none;">
                                <div class="row">
                                    <div class="col-1">
                                        <a style="cursor:pointer;" onclick="$('#idCV').hide();$('#idLampiran').show();
                                            $('#statusCV').val('0');">
                                            <i class="text-primary fas fa-reply"></i>
                                        </a>
                                    </div>
                                    <div class="col-11">
                                        <input type="file" id="nmCV" name="nmCV" 
                                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                                        value="{{ old('nmCV') }}">
                                        <small class="text-danger">{{ $errors->first('nmCV') }}</small>
                                    </div>
                                </div>
                            </div>
                        @else
                            <input type="file" id="nmCV" name="nmCV" 
                            class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                            value="{{ old('nmCV') }}">
                            <small class="text-danger">{{ $errors->first('nmCV') }}</small>
                        @endif
                        <input type="hidden" id="statusCV" name="statusCV" value="0">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class=" font-weight-bold font-15 text-dark">Keterangan</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Tambahan</span>
                    </div>
                    <div class="col-md-9">
                        <textarea id="nmKeterangan" name="nmKeterangan" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold">{{ $lamaran_first->keterangan_lamaran }}</textarea>
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
                            <input type="checkbox" class="custom-control-input"  id="cbKompetensi" 
                                    name="nmKompetensi" @if($lamaran_first->syarat_kompetensi === "Y") checked @endif>
                            <label for="cbKompetensi" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Memiliki Kompetensi yang sesuai ?
                            </label>
                        </div>
                        <div class="custom-control mt-2 custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbSehat" 
                                name="nmSehat" @if($lamaran_first->syarat_sehat === "Y") checked @endif>
                            <label for="cbSehat" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Sehat Jasmani dan Rohani?
                            </label>
                        </div>
                        <div class="custom-control mt-2 custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbDokumen" 
                                name="nmDokumen" @if($lamaran_first->syarat_dokumen === "Y") checked @endif>
                            <label for="cbDokumen" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Memiliki Dokumen Sesuai Persyaratan ?
                            </label>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark">
            <span class="font-15"><i class="fas fa-check mr-2"></i>Perbarui</span>
        </button>
    </div>
</div>

</form>

@endsection


@section('script')
@include('sistem.lamaran.script-edit')
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
<script>
    setTimeout(function()
    { 
        getKota();
        getKecamatan();
    }, 1000);
</script>
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
        else{
            form.submit();
        }

    });
</script>

@include('global.upload-preview')
@endsection