@extends('layouts.admin') 

@if(Auth::user()->tipe == "staf" && (auth()->user()->hasRole(['superadmin', 'admin']) || auth()->user()->can(['pelatihan'])))

@section('title')
Kelola Program Pelatihan - Baru
@endsection

@section('style')

    @include('global.custom-style')

@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-diagnoses font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Program Pelatihan</h4> 
            <span class="ml-2 font-11 font-weight-bold bg-primary 
                rounded text-white align-top py-1 px-2">Baru
            </span>
        </div>
        <span class="font-weight-bold">Program Pelatihan Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pelatihan_index')}}"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500 text-dark">Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('pelatihan_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmTipe" value="create">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6 pb-0 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Program</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmPelatihan" name="nmPelatihan" 
                        class="form-control h-45 border-form bg-form text-form font-weight-500" 
                        value="{{ old('nmPelatihan') }}">
                    <small class="text-danger">{{ $errors->first('nmPelatihan') }}</small>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kejuruan</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmKejuruan" id="nmKejuruan" class="form-control select2 w-100">
                                @foreach ($kejuruan as $x)
                                    <optgroup label="{{ $x->name }}">
                                        @foreach ($sub_kejuruan as $y)
                                            @if ($y->join1_id == $x->jenis_id)
                                            <option value="{{ $x->jenis_id }}|{{ $y->jenis_id }}">{{ $y->name }}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endforeach

                                {{-- <option value="">- Pilih -</option>
                                @foreach ($sub_kejuruan as $sk)
                                    <option value="{{ $sk->id }}">{{ $sk->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Sumber Dana</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmSumberDana" id="nmSumberDana" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                @foreach ($sumber_dana as $sd)
                                    <option value="{{ $sd->jenis_id }}">{{ $sd->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Anggaran</div>
                    <div class="col-md-9">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-form-tua text-dark border-form font-weight-bold">Rp</div>
                            </div>
                            <input type="text" id="nmAnggaran" name="nmAnggaran"  onchange="formatUang();"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        </div>
    
                        <small class="text-danger">{{ $errors->first('nmAnggaran') }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                        <span class="font-15 font-weight-bold text-dark">Metode</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Pelatihan</span>
                    </div>
                    <div class="col-md-9">
                        <select name="nmMetode" id="nmMetode" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            @foreach ($metode as $met)
                                <option value="{{ $met->jenis_id }}">{{ $met->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">Kuota</span>
                        <br>
                        <span class="font-12 text-primary font-weight-bold">Peserta</span>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group mb-2">
                            <div class="input-group mb-2">
                                <input type="number" id="nmKuota" name="nmKuota"  class="form-control h-45 border-form bg-form font-weight-500">
                                <div class="input-group-append">
                                    <div class="input-group-text border-form bg-form-tua text-dark font-weight-bold">Peserta</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Total Jam</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Pelajaran</span>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group mb-2">
                            <div class="input-group mb-2">
                                <input type="number" id="nmJamPelajaran" name="nmJamPelajaran"  class="form-control h-45 border-form bg-form font-weight-500">
                                <div class="input-group-append">
                                  <div class="input-group-text border-form bg-form-tua text-dark font-weight-bold">Jam</div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Tanggal</span>
                        <br>
                        <span class="font-13 text-success font-weight-500">Mulai</span>
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglMulai" name="nmTglMulai" 
                        class="form-control h-45 border-form bg-form text-form font-weight-500" 
                        value="{{ old('nmTglMulai') }}">
                       
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Tanggal</span>
                        <br>
                        <span class="font-13 text-danger font-weight-500">Selesai</span>
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglSelesai" name="nmTglSelesai" 
                            class="form-control h-45 border-form bg-form text-form font-weight-500" 
                            value="{{ old('nmTglSelesai') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class=" font-weight-bold font-15 text-dark">Keterangan</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">(Deskripsi)</span>
                    </div>
                    <div class="col-md-9">
                        <textarea id="nmKeterangan" name="nmKeterangan" rows="3"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"></textarea>
                        <small class="text-danger">{{ $errors->first('nmKeterangan') }}</small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                        <span class="font-15 font-weight-bold text-dark">Status</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Pelatihan</span>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmStatusPelatihan" id="nmStatusPelatihan" 
                                    onchange="statusPendaftaran();"
                                    class="form-control select2 w-100">
                                {{-- <option value="">- Pilih -</option> --}}
                                {{-- <option value="batal">Batal</option> --}}
                                <option value="draft" selected>Draft</option>
                                <option value="valid">Valid</option>
                                {{-- <option value="selesai">Selesai</option> --}}
                            </select>
                        </div>
                    </div>
                </div>

                <div id="statusPendaftaran" style="display:none;">
                    <div class="form-group row">
                        <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">
                            <span class="font-15 font-weight-bold text-dark">Tipe</span>
                            <br>
                            <span class="font-13 text-primary font-weight-500">Pendaftaran</span>
                        </div>
                        <div class="col-md-9 mt-1">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdTerbuka" name="nmTipePendaftaran" class="custom-control-input" value="terbuka" >
                                <label class="custom-control-label font-weight-bold" for="rdTerbuka" style="cursor:pointer;">Terbuka</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdTertutup" name="nmTipePendaftaran" class="custom-control-input" value="tertutup" checked>
                                <label class="custom-control-label font-weight-bold" for="rdTertutup" style="cursor:pointer;">Tertutup</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">
                            <span class="font-15 font-weight-bold text-dark">Status</span>
                            <br>
                            <span class="font-13 text-primary font-weight-500">Pendaftaran</span>
                        </div>
                        <div class="col-md-9 mt-1">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdBuka" name="nmStatusPendaftaran" class="custom-control-input" value="buka">
                                <label class="custom-control-label font-weight-bold" for="rdBuka" style="cursor:pointer;">Buka</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdTutup" name="nmStatusPendaftaran" class="custom-control-input">
                                <label class="custom-control-label font-weight-bold" for="rdTutup" style="cursor:pointer;">Tutup</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="font-weight-500 font-12">
                            <ul>
                                <li style="line-height:16px;">
                                <span class="text-dark">Tipe Pendaftaran Terbuka: </span>User Yang Memiliki Akses Login Sistem Bisa Melakukan Pendaftaran Mandiri.</li>
                                <li class="mt-2" style="line-height:16px;">
                                    Status Pendaftaran akan <span class="text-danger">"Tutup"</span> Otomatis Jika Status Pelatihan 
                                    <span class="text-dark">Batal, Draft,</span> ataupun <span class="text-dark">Selesai</span>.
                                </li>
                            </ul>
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
<script src="{{ asset('theme/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('theme/node_modules/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    function formatUang() {
        $(document).ready(function() {
            $('#nmAnggaran').val().toString().replace(".","").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        });
    }
</script>
<script>
    function statusPendaftaran(){
        $status_pelatihan = $('#nmStatusPelatihan').val();
        
        
        if($status_pelatihan == "valid" || $status_pelatihan == "selesai"){
            $('#statusPendaftaran').show();
        }else{
            $('#statusPendaftaran').hide();
        }
        if($status_pelatihan == "selesai")
        {
            $('#rdCekBuka').hide();
            $('#rdTutup').prop("checked", "checked");
            // alert($status_pelatihan);
        }
        else{
            $('#rdCekBuka').show();
            
        }
    }
</script>
@endsection

@else
    @include('global.dilarang')
@endif