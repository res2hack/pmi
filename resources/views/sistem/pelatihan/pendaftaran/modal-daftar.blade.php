{{-- <form method="POST" action="#">
@csrf --}}

    
    <div class="modal  fade" id="modalDaftar" tabindex="-1" role="dialog" aria-labelledby="modalDaftarTitle" aria-hidden="true">
            
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      
            <div class="modal-content">
                <div class="modal-header border-bottom py-3 bg-primary">
                    <h5 class="modal-title text-white" id="modalDaftarTitle">
                        <i class="fas fa-user-plus font-18 text-white mr-3"></i> 
                        Tambah Peserta Pelatihan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div id="ArsipPeserta">
                                {{-- Form Exists --}}
                                <form id="formExists">
                                    <div class="font-14 mb-2 font-weight-bold">
                                        Cari Data Penduduk Yang Telah Terdaftar Sistem
                                    </div>
                                    <div>
                                        <select name="nmPenduduk" id="nmPenduduk" class="select2 form-control  w-100">    
                                    
                                        </select>
                                        <input type="hidden" name="nmIDpelatihanExists" value="{{ $pelatihan->id }}">
                                    </div>
                                    <div class="font-13 mt-2 font-weight-500 text-danger">
                                        Tidak Menemukan Data Yang Dicari? 
                                        <a onclick="$('#DaftarBaru').show();$('#ArsipPeserta').hide();$('#btn-daftar').show();$('#btn-exists').hide();" 
                                            class="mx-1 font-14 text-primary" style="cursor:pointer;">
                                            <u>
                                            Buat Baru<i class="fas fa-user-plus font-11 ml-2"></i>
                                            </u>
                                        </a> 
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="font-14 mb-2 font-weight-bold">
                                                Tanggal Daftar Pelatihan
                                            </div>
                                            <input type="date" name="nmTglDaftarExists" id="nmTglDaftarExists" 
                                                value="{{ now()->format('Y-m-d') }}" class="form-control font-weight-bold h-42 bg-form border-form">  
                                        </div>
                                       <input type="hidden" name="nmKejuruanExists" value="{{ $pelatihan->kejuruan_id }}">
                                    </div>
                                </form>
                            </div>
                            <div id="DaftarBaru" style="display:none;">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                    <a onclick="$('#DaftarBaru').hide();$('#ArsipPeserta').show();$('#btn-daftar').hide();$('#btn-exists').show();" 
                                        class="font-14 text-danger" style="cursor:pointer;">
                                        <u>
                                            <i class="fas fa-reply font-11 mr-2"></i> Batal
                                        </u>
                                    </a> 
                                    </div>
                                </div>
                                 {{-- Form Partner --}}
                                <form id="formPartner">
                                <div class="row">
                                    <input type="hidden" name="nmIDpelatihanBaru" value="{{ $pelatihan->id }}">
                                    <div class="col-md-7 border-right">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <span class="font-14 font-weight-bold text-dark">Nama</span>
                                                <br>
                                                <span class="font-13 text-primary font-weight-500">Lengkap</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="nmPartner" class="form-control bg-form border-form text-form h-42">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                                                NIK
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="nmNIK" onchange="cekNik();"
                                                    class="form-control bg-form border-form text-form h-42">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                                                No. BPJS
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="nmBPJS"  onchange="cekBpjs();"
                                                    class="form-control bg-form border-form text-form h-42">
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
                                                    <input type="text" name="nmTempatLahir" class="form-control bg-form border-form text-form h-42">
                                                </div>
                                                <div class="mt-2">
                                                    <input type="date" name="nmTglLahir" class="form-control bg-form border-form text-form h-42">
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
                                                <select name="nmPendidikan" id="nmPendidikan" class="form-control select2">
                                                    <option value="">- Pilih -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                                                Agama
                                            </div>
                                            <div class="col-md-9">
                                                <select name="nmAgama" id="nmAgama" class="form-control select2">
                                                    <option value="">- Pilih -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 pt-3 font-14 font-weight-bold text-dark">
                                                Kontak
                                            </div>
                                            <div class="col-md-9">
                                                <textarea type="text" name="nmKontak" class="form-control bg-form border-form text-form h-42"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 pt-3 font-14 font-weight-bold text-dark">
                                                Email
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="nmEmail" class="form-control bg-form border-form text-form h-42">
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
                                                    <textarea type="text" name="nmAlamat" class="form-control bg-form border-form text-form h-42"></textarea>
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
                                        <div class="border-top2-dashed mt-4 border-form"></div>
                                        <div class="form-group row mt-3">
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
                                                            <input name="nmUsername" type="text" class="form-control bg-form border-form text-form h-42" 
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
                                                            <input name="nmEmailLogin" type="email" class="form-control bg-form border-form text-form h-42" 
                                                                    value="{{ old('Email') }}" onchange="cekEmail();">
                                                            <span id="emailError" class="font-12 text-danger font-weight-bold" style="display:none;">* Email ini sudah digunakan</span>
                                                            <span id="formatError" class="font-12 text-danger font-weight-bold" style="display:none;">* Format Email Salah</span>
                                                            <small class="text-danger font-weight-bold">{{ $errors->first('nmEmailLogin') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4 mt-2 font-weight-bold font-15">Password</label>
                                                        <div class="col-md-8">
                                                            <input name="nmPassword" type="text" class="form-control bg-form border-form text-form h-42" value="{{ old('password') }}" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4 mt-2 font-weight-bold font-15">Status</label>
                                                        <div class="col-md-8">
                                                            <select name="nmStatusAktif" id="nmStatusAktif" class="form-control selectric" style="font-size:16px;" >
                                                                    <option value="active">Aktif</option>
                                                                    <option value="pending">Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="nmKejuruanBaru" value="{{ $pelatihan->kejuruan_id }}">
                                </div>
                                <div class="mt-4 pt-3 border-top">
                                    <div class="col-md-8 mx-auto">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="font-14 mt-2 font-weight-bold">
                                                    Tanggal Daftar Pelatihan
                                                </div>
                                               
                                            </div>
                                            <div class="col-md-7">
                                                <input type="date" name="nmTglDaftarBaru" id="nmTglDaftarBaru" 
                                                value="{{ now()->format('Y-m-d') }}" class="form-control bg-form border-form text-form font-weight-bold h-42 ">  
                                            </div>
                                        </div>
                                    </div>
                                   
                                   {{-- <input type="hidden" name="nmKejuruanExists" value="{{ $pelatihan->kejuruan_id }}"> --}}
                                </div>
                                
                            </form>
                            {{-- end Form Partner --}}
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer bg-light2">
                <a href=""  class="btn btn-secondary text-dark" data-dismiss="modal">Batal</a>
                <a id="btn-exists" class="btn btn-primary text-white" style="cursor:pointer;"><i class="fas fa-check mr-2 font-10"></i>Daftarkan</a>
                <a id="btn-daftar" class="btnproses btn btn-primary text-white" style="cursor:pointer;display:none;">
                    <i class="fas fa-check mr-2 font-10"></i>Daftarkan
                </a>
            </div>
        
            </div>
        </div>

    </div>
