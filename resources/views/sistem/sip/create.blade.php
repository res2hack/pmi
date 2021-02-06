@extends('layouts.admin') 

@section('title')
Kelola Data Lowongan (SIP) - Buat Baru
@endsection

@section('style')
    @include('global.custom-style')
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-clipboard-list font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Lowongan (SIP)</h4> 
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
<a href="{{ route('sip_index')}}"><u>Lowongan (SIP)</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Baru</span>
@endsection

@section('content')

@include('global.notifikasi')

<form method="post" action="{{ route('sip_store')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="nmTipe" value="create">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-7 pb-0 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">No. SIP</div>
                    <div class="col-md-9">
                        <input type="text" id="nmNoSip" name="nmNoSip" 
                        class="form-control h-45 border-form bg-form font-weight-bold text-form" 
                        value="{{ old('nmNoSip') }}">
                    <small class="text-danger">{{ $errors->first('nmNoSip') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark">
                        Status
                    </div>
                    <div class="col-md-9 font-weight-bold text-dark">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdFormal" name="nmStatusFormal" class="custom-control-input" value="0" checked>
                                <label class="custom-control-label" for="rdFormal" style="cursor:pointer;">Formal</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdInformal" name="nmStatusFormal" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="rdInformal" style="cursor:pointer;">Informal</label>
                            </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Perusahaan</div>
                    <div class="col-md-9">
                        <select name="nmPerusahaan" id="nmPerusahaan" class="form-control select2" >
                            @foreach ($perusahaan as $per)
                                <option value="{{ $per->id}}">{{ $per->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Agency</div>
                    <div class="col-md-9">
                    <textarea id="nmAgency" name="nmAgency" rows="2"
                        class="form-control h-45 border-form bg-form font-weight-bold text-form"></textarea>
                        <small class="text-danger">{{ $errors->first('nmAgency') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Jabatan</div>
                    <div class="col-md-9">
                        <select name="nmJabatan" id="nmJabatan" class="form-control select2" >
                            @foreach ($jabatan as $jab)
                            <option value="{{ $jab->id}}">{{ $jab->nama }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group row mb-0">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Negara Tujuan</div>
                    <div class="col-md-9">
                        <select name="nmNegara" id="nmNegara" class="form-control select2 text-dark">
                            @foreach ($negara as $neg)
                                <option value="{{ $neg->id}}">{{ $neg->negara }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Jumlah L/P</div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="number" class="form-control bg-form border-form text-form font-weight-bold
                                    h-42 text-center" id="nmJumlahL" name="nmJumlahL" value="{{ old('nmJumlahL') }}">
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form-tua border-form font-13 font-weight-bold px-2">Laki-Laki</div>
                            </div>
                        </div>

                        <div class="input-group mt-3">
                            <input type="number" class="form-control bg-form border-form text-form font-weight-bold
                                    h-42 text-center" id="nmJumlahP" name="nmJumlahP" value="{{ old('nmJumlahP') }}">
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form-tua border-form font-13 font-weight-bold px-2">Perempuan</div>
                            </div>
                        </div>

                        <div class="input-group mt-3">
                            <input type="number" class="form-control bg-form border-form text-form font-weight-bold
                                    h-42 text-center" id="nmJumlahLP" name="nmJumlahLP" value="{{ old('nmJumlahLP') }}">
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form-tua border-form 
                                    font-13 font-weight-bold px-2">L/P</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Ijin Berlaku</div>
                    <div class="col-md-8">
                        <input type="date" id="nmIjinAwal" name="nmIjinAwal" 
                        class="form-control h-45 border-form bg-form font-weight-bold text-form" value="{{ now()->format('Y-m-d') }}{{ old('nmIjinAwal') }}">
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Ijin Berakhir</div>
                    <div class="col-md-8">
                        <input type="date" id="nmIjinAkhir" name="nmIjinAkhir" 
                        class="form-control h-45 border-form bg-form font-weight-bold text-form" value="{{ now()->format('Y-m-d') }}{{ old('nmIjinAkhir') }}">
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="form-group row mb-0">
                    <div class="col-md-2 pr-0 mt-2 font-15 
                            font-weight-bold text-dark mb-2" style="margin-right:-6px;">
                        Keterangan<br><span class="font-14 font-weight-normal">(Deskripsi)</span></div>
                    <div class="col-md-10 pl-0">
                        <textarea id="summernote" name="nmKeterangan" class="summernote"></textarea>
                    </div>
                </div>
                <div class="border-top border-form"></div>
            </div>
            <div class="col-md-7">
                <div class="form-group row mt-4">
                    <div class="col-md-4 font-15 font-weight-bold text-dark mt-3">Status Lamaran Peserta</div>
                    <div class="col-md-8">
                        <div class="border border-form rounded p-3 shadow">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdStatusTutup" name="nmStatusLamaran" 
                                    class="custom-control-input" value="tutup" >
                                <label class="custom-control-label font-weight-bold" for="rdStatusTutup" 
                                    style="cursor:pointer;">Tutup</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdStatusBuka" name="nmStatusLamaran" 
                                    class="custom-control-input" value="buka" checked>
                                <label class="custom-control-label font-weight-bold" for="rdStatusBuka" 
                                    style="cursor:pointer;">Buka</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5"></div>
           
        </div>

        
    </div>
    <div class="card-footer text-center border-top mt-3">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-15"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>

</form>

@endsection


@section('script')

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
    ['insert', ['link', 'picture']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 200
});
</script>

@endsection