@extends('layouts.admin') 

@section('title')
Kelola Data Pengaduan TKI - Ubah Pengaduan
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.css') }}">
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
#loadingku{
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -50px;
    margin-left: -50px;
    width: 300px;
    height: 150px;
    background:#433675;
    z-index: 1;    
}
#spinku{
    right: 8px;
    width: 27px;
    height: 27px;
    background-color: #b9a8f5;
    border-radius: 50%;
    -webkit-animation: pulsate 2s ease-out;
    animation: pulsate 1s ease-out;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    opacity: 1;
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
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
        <i class="fas fa-edit ml-2 align-top"></i>
        <span class="mx-2">/</span>
        <span class="text-dark font-weight-bold">#{{ $pengaduan->no_pengaduan }}</span>
        <span class="mx-2">/</span>
            <span class="font-12 font-weight-bold">
                @if($pengaduan->status_kasus === "B")
                    <span class="bg-warning py-1 px-3 text-white rounded">Belum Diproses</span> 
                @elseif($pengaduan->status_kasus === "P")
                    <span class="bg-primary py-1 px-3 text-white rounded">Sedang Diproses</span> 
                @elseif($pengaduan->status_kasus === "S")
                    <span class="bg-success py-1 px-3 text-white rounded">Selesai</span> 
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
<a href="{{ route('pengaduan_detail', $pengaduan->id)}}"><u>#{{ $pengaduan->no_pengaduan }}</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah Data</span>
@endsection

@section('content')

    <div id="loadingku" class="rounded text-white text-center p-4" style="display:none;">
        <div class="text-warning font-18 font-weight-bold">Memperbarui Data...</div>
        <div id="spinku" class="mt-3 mx-auto"></div>
        <div class="mt-3 text-white font-14">Harap Menunggu</div>    
    </div>

@include('global.notifikasi')

<form id="formPengaduan" method="post" action="{{ route('pengaduan_update')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmStatus" value="edit">
<input type="hidden" name="nmID" value="{{ $pengaduan->id }}">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-4 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Pengaduan</div>
                    <div class="col-md-12">
                        <input type="date" id="nmTglPengaduan" 
                            name="nmTglPengaduan" value="{{ $pengaduan->tgl_pengaduan }}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmTglPengaduan') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Asal Pengaduan</div>
                    <div class="col-md-12">
                        <select name="nmPengaduanAsal" id="nmPengaduanAsal" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($pengaduan_asal as $asal)
                                <option value="{{ $asal->jenis_id }}" 
                                    @if($pengaduan->pengaduan_asal === $asal->jenis_id) selected @endif>
                                    {{ $asal->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="border-bottom pb-2 mb-4">Data Pengadu</h4>
                <div class="form-group row pt-2">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Pengadu</div>
                    <div class="col-md-8">
                        <input type="text" id="nmNamaPengadu" name="nmNamaPengadu" value="{{ $pengaduan->nama_peng }}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmNamaPengadu') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-8">
                        <textarea class="form-control border-form bg-form font-weight-500" 
                            value="{{ $pengaduan->alamat_peng }}" name="nmAlamatPengadu"
                            id="nmAlamatPengadu"  rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">No. Telepon</div>
                    <div class="col-md-8">
                        <textarea class="form-control border-form bg-form font-weight-500" value="{{ $pengaduan->telepon }}"
                            name="nmTeleponPengadu" id="nmTeleponPengadu"  rows="2"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Email</div>
                    <div class="col-md-8">
                        <input type="email" id="nmEmailPengadu" name="nmEmailPengadu" {{ $pengaduan->email }}
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Hub. dengan TKI</div>
                    <div class="col-md-8">
                        <input type="text" id="nmHubunganTKI" name="nmHubunganTKI" value="{{ $pengaduan->hubungan_tki }}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Saluran Pengaduan</div>
                    <div class="col-md-8">
                        <select name="nmSaluranPengaduan" id="nmSaluranPengaduan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($saluran as $sal)
                                <option value="{{ $sal->jenis_id }}" @if($pengaduan->info_saluran) selected @endif>
                                    {{ $sal->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        {{-- <hr class="border-top2-dashed border-form"> --}}
        <h4 class="border-bottom mt-4 pb-2 mb-4">Data TKI</h4>
        <div class="row mt-3">
            <div class="col-md-6 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama TKI</div>
                    <div class="col-md-9">
                        <input type="text" id="nmTKI" name="nmTKI" value="{{ $pengaduan->nama_tki }}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmTKI') }}</small>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">No. Paspor</div>
                    <div class="col-md-9">
                        <input type="text" id="nmPaspor" name="nmPaspor" value="{{ $pengaduan->no_paspor }}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmPaspor') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">J. Kelamin</div>
                    <div class="col-md-9 mt-1">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdLaki" name="nmJK" class="custom-control-input"
                            value="L" @if($pengaduan->jk === "L") checked @endif>
                            <label class="custom-control-label font-weight-bold" for="rdLaki" style="cursor:pointer;">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdPerempuan" name="nmJK" 
                                class="custom-control-input" value="P" @if($pengaduan->jk === "P") checked @endif>
                            <label class="custom-control-label font-weight-bold" for="rdPerempuan" style="cursor:pointer;">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">TTL</div>
                    <div class="col-md-9">
                        <div>
                            <input type="text" id="nmTempatLahir" name="nmTempatLahir" value="{{ $pengaduan->tmp_lahir }}"
                            class="form-control h-45 border-form bg-form font-weight-500" placeholder="Tempat Lahir..">
                        </div>
                        <div class="mt-3">
                            <input type="date" id="nmTglLahir" name="nmTglLahir" value="{{ $pengaduan->tgl_lahir }}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Status</div>
                    <div class="col-md-9">
                        <select name="nmStatusKawin" id="nmStatusKawin" class="form-control select2 w-100">
                            <option value="B" @if($pengaduan->jk === "B") selected @endif>Belum Kawin</option>
                            <option value="K" @if($pengaduan->jk === "K") selected @endif>Kawin</option>
                            <option value="J" @if($pengaduan->jk === "J") selected @endif>Janda</option>
                            <option value="D" @if($pengaduan->jk === "D") selected @endif>duda</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea name="nmAlamat" id="nmAlamat" rows="4" 
                        class="form-control border-form bg-form">{{ $pengaduan->alamat }}</textarea>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Provinsi</div>
                    <div class="col-md-9">
                        <select name="nmProvinsi" id="nmProvinsi" onchange="getKota();" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}" @if($pengaduan->provinsi === $prov->id) selected @endif>
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
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pendidikan</div>
                    <div class="col-md-9">
                        <select name="nmPendidikan" id="nmPendidikan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($pendidikan as $pdk)
                                <option value="{{ $pdk->jenis_id }}" 
                                    @if($pengaduan->pendidikan === $pdk->jenis_id) selected @endif>
                                    {{ $pdk->name }}
                                </option>
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
                                <option value="{{ $sek->jenis_id }}" 
                                    @if($pengaduan->pekerjaan === $sek->jenis_id) selected @endif>
                                    {{ $sek->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="nmPekerjaan" id="nmPekerjaan" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Jabatan</div>
                    <div class="col-md-9">
                        <input type="text" id="nmJabatan" name="nmJabatan" value="{{ $pengaduan->jabatan }}"
                            class="form-control h-42 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmJabatan') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark">Negara
                        <div><small>Penempatan</small></div>
                    </div>
                    <div class="col-md-9">
                        <select name="nmNegara" id="nmNegara" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($negara as $neg)
                                <option value="{{ $neg->jenis_id }}" 
                                    @if($pengaduan->negara === $neg->jenis_id) selected @endif>
                                    {{ $neg->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Bekerja</div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglBerangkat" name="nmTglBerangkat" value="{{ $pengaduan->tgl_berangkat}}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Kembali</div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglDatang" name="nmTglDatang" value="{{ $pengaduan->tgl_datang}}"
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Majikan</div>
                    <div class="col-md-9">
                        <input type="text" id="nmNamaMajikan" name="nmNamaMajikan" value="{{ $pengaduan->nama_majikan}}"
                            class="form-control h-42 border-form bg-form font-weight-500">
                        <small class="text-danger">{{ $errors->first('nmMajikan') }}</small>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                        Alamat
                        <div><small>Majikan</small></div>
                    </div>
                    <div class="col-md-9">
                        <textarea name="nmAlamatMajikan" id="nmAlamatMajikan" rows="3" 
                        class="form-control border-form bg-form" 
                        placeholder="Alamat Majikan">{{ $pengaduan->alamat_majikan}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark">Pengirim 
                        <div><small>PPTKIS</small></div>
                    </div>
                    <div class="col-md-9">
                        <select name="nmPptkis" id="nmPptkis" onchange="getPptkis();"
                            class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($perusahaan as $prsh)
                                <option value="{{ $prsh->id }}"  
                                    @if($pengaduan->pptkis === $prsh->id) selected @endif>
                                    {{ $prsh->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2" >
                    <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                        Alamat
                        <div><small>PPTKIS</small></div>
                    </div>
                    <div class="col-md-9">
                        <textarea name="nmAlamatPptkis" id="nmAlamatPptkis" rows="3" 
                        class="form-control border-form bg-form" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>
        {{-- Permasalahan TKI --}}
        <h4 class="border-bottom mt-4 pb-2 mb-4">Permasalahan TKI</h4>
        <div class="row mt-3">
            <div class="col-md-6 border-right">
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Masalah</div>
                    <div class="col-md-12">
                        <select name="nmMasalah[]" id="nmMasalah" class="form-control select2 w-100" multiple="multiple">
                            <option value="">- Pilih -</option>
                            @foreach ($masalah as $mas)
                                <option value="{{ $mas->jenis_id }}" 
                                    @if (in_array($mas->jenis_id, $t_masalah)) selected @endif>
                                    {{ $mas->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Masalah Lainnya</div>
                    <div class="col-md-12">
                        <textarea id="nmMasalahLainnya" name="nmMasalahLainnya" 
                            class="form-control border-form bg-form" rows="2">{{ $pengaduan->masalah_lainnya }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Detail Masalah</div>
                    <div class="col-md-12">
                        <textarea id="nmDetailMasalah" name="nmDetailMasalah" class="summernote">{{ $pengaduan->detail_masalah }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Unggah Lampiran Kronologis</div>
                
                    <div class="col-md-12">

                        @include('sistem.pengaduan.file-kronologis')
                        
                        {{-- <a id="btn-fileKrono" title="Unggah Lampiran" 
                            href="{{ route('pengaduan_file_krono')}}" type="submit"  
                            class="btn btn-primary" >
                            <i class="fas fa-sync mr-2"></i> 
                                Upload
                        </a> --}}
                        </div>
                        {{-- <div class="dropzone" id="my-dropzone" name="mainFileUploader">
                            <div id="previewDiv"></div>
                            <div class="fallback">
                            <input name="file" type="file" multiple/>
                            </div>
                        </div> --}}
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Kronologis Masalah</div>
                    <div class="col-md-12">
                        <textarea id="nmKronologis" name="nmKronologis" class="summernote">{{ $pengaduan->uraian_kronologis }}</textarea>
                    </div>
                </div>
            
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Tuntutan Pengadu</div>
            <div class="col-md-12">
                <textarea id="nmTuntutan" name="nmTuntutan" class="summernote">{{ $pengaduan->tuntutan_pengadu }}</textarea>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark" onclick="loadingku();">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Perbarui</span>
        </button>
    </div>
</div>

</form>

@endsection

@section('script')
<script>
    var cek_pengaduan = 1;
</script>
{{-- <script>
    if(cek_pengaduan > 0){
        alert(1);
    }
    else{
        alert(0);
    }
</script> --}}
@include('sistem.pengaduan.script-edit')

<script>
    setTimeout(function()
    { 
        getKota();
        getKecamatan();
        getDesa();
        getPekerjaan();
        getPptkis();
    }, 1000);
</script>

@include('sistem.pengaduan.script-file')

<script src="{{ asset('theme/assets/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('theme/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $('#nmDetailMasalah').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['style','bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 210
});
</script>
<script>
    $('#nmKronologis').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['style','bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 200
});
</script>

<script>
    $('#nmTuntutan').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['style','bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 150
});
</script>

<script>
    function loadingku() {
        $(document).ready(function() {
                $("#loadingku").show();
            })
        }; 
</script>

@endsection
