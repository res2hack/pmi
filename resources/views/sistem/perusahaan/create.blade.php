@extends('layouts.admin') 

@section('title')
Kelola Data Perusahaan - Data Baru
@endsection

@section('style')
    @include('global.custom-style')
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-house-user font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Perusahaan</h4> 
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
<a href="{{ route('perusahaan_index')}}"><u>Perusahaan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Data Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('perusahaan_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmTipe" value="create">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-7 pb-0 border-right">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-weight-500 text-primary">Perusahaan</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmPerusahaan" name="nmPerusahaan" 
                        class="form-control h-45 border-form bg-form text-form font-weight-500" 
                        value="{{ old('nmPerusahaan') }}">
                    <small class="text-danger">{{ $errors->first('nmPerusahaan') }}</small>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                    <textarea id="nmAlamat" name="nmAlamat" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"></textarea>
                        <small class="text-danger">{{ $errors->first('nmAlamat') }}</small>
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
                        <select name="nmKecamatan" id="nmKecamatan" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Kontak / Telp.</div>
                    <div class="col-md-8">
                        <textarea id="nmTelp" name="nmTelp" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"></textarea>
                        <small class="text-danger">{{ $errors->first('nmTelp') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">WhatsApp (WA)</div>
                    <div class="col-md-8">
                        <textarea id="nmWhatsapp" name="nmWhatsapp" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"></textarea>
                        <small class="text-danger">{{ $errors->first('nmWhatsapp') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Email</div>
                    <div class="col-md-8">
                        <input type="email" id="nmEmail" name="nmEmail" 
                        class="form-control h-45 border-form bg-form text-form font-weight-500" 
                        value="{{ old('nmEmail') }}">
                        <small class="text-danger">{{ $errors->first('nmEmail') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <span class=" font-weight-bold font-15 text-dark">CP</span>
                        <br>
                        <span class="font-weight-500 text-primary">Contact Person</span>
                    </div>
                    <div class="col-md-8">
                        <textarea id="nmCP" name="nmCP" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"></textarea>
                        <small class="text-danger">{{ $errors->first('nmCP') }}</small>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-2 mt-2 font-15 font-weight-bold text-dark mb-2" style="margin-right:-20px;">Keterangan</div>
            <div class="col-md-10">
                <textarea id="summernote" name="nmProfil" class="summernote"></textarea>
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
                                    <input name="nmUsername" type="text" class="form-control bg-form border-form h-42" 
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
                                    <input name="nmEmailLogin" type="email" class="form-control bg-form border-form h-42" 
                                            value="{{ old('Email') }}" onchange="cekEmail();">
                                    <span id="emailError" class="font-12 text-danger font-weight-bold" style="display:none;">* Email ini sudah digunakan</span>
                                    <span id="formatError" class="font-12 text-danger font-weight-bold" style="display:none;">* Format Email Salah</span>
                                    <small class="text-danger font-weight-bold">{{ $errors->first('nmEmailLogin') }}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Password</label>
                                <div class="col-md-8">
                                    <input name="nmPassword" type="text" class="form-control bg-form border-form h-42" value="{{ old('password') }}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Status</label>
                                <div class="col-md-8">
                                    <select name="nmStatusAktif" id="nmStatusAktif" class="form-control selectric" style="font-size:16px;" >
                                        <option value="pending" selected>Ditunda</option>
                                        <option value="active">Diterima (Aktif)</option>
                                        <option value="banned">Dilarang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                        {{-- <div class="col-md-6">
                            <table id="datatable3" class="table">
                                <thead>
                                        <th style="width:3%;">#</th>
                                        <th class="h-50 py-3 font-15">Role</th>
                                </thead>
                                <tbody> 
                                    @foreach ($role as $item)
                                    <tr>
                                        <td class="h-50 pt-2"></td>
                                        <td class="h-50 pt-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="nmRole[]" value="{{ $item->id }}" id="cbRole{{ $item->id }}">
                                                <label class="pl-2 custom-control-label font-14 font-weight-500 align-top text-primary" style="cursor:pointer;"
                                                    for="cbRole{{ $item->id }}">{{ $item->name }}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
        
                                </tbody>
                            </table>
                        </div> --}}
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
@include('sistem.perusahaan.script')
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
<script src="{{ asset('theme/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $('#summernote').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
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

@endsection