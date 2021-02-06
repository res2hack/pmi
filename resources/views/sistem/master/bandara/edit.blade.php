@extends('layouts.admin') 

@section('title')
Kelola Data Master Bandara
@endsection

@section('style')
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Master Data Bandara</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('master_index', 'bandara')}}"><u>Bandara</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
@endsection


@section('content')
@include('global.notifikasi')
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('master_update')}}">
            @csrf
            <div class="card shadow border-top5 border-form ">
                <div class="card-body mt-0 pb-1 ">

                    <input type="hidden" name="nmStatus" value="edit">
                    <input type="hidden" name="nmRedirect" value="index">
                    <input type="hidden" name="nmJenisKategori" value="m_bandara">
                    <input type="hidden" name="nmID" value="{{ $master->id }}">

                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Kode Bandara</div>
                        <input type="text" name="nmKode" value="{{ $master->kode }}"
                            class="form-control font-weight-500 h-42 bg-form border-form">
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Nama Bandara</div>
                        <textarea name="nmName" class="form-control font-weight-500 
                                    bg-form border-form" rows="3" required>{{ $master->name }}</textarea>
                        <small class="text-danger">{{ $errors->first('nmName') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="nmJoin1" value="m_negara">
                        @php 
                            use Illuminate\Support\Facades\DB;
                            $negara = DB::table('master_kategori_line')->select('jenis_id', 'name')
                                    ->where('jenis', 'm_negara')->get();
                        @endphp
                        <div class="font-weight-bold font-16 mb-1 text-dark">Negara</div>
                        <select name="nmJoin1_ID" id="nmJoin1_ID" class="form-control selectric" style="font-size:16px;" >
                            @foreach ($negara as $x)
                                <option value="{{ $x->jenis_id}}" 
                                    @if($x->jenis_id === $master->join1_id) selected @endif>{{ $x->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Kota</div>
                        <input type="text" name="nmTag1" value="{{ $master->tag1 }}"
                                class="form-control font-weight-500 h-42 bg-form border-form">
                    </div>
                </div>
                <div class="card-footer border-top mt-2 py-3">
                    <button type="submit" class="btn btn-lg btn-dark">
                        <i class="fas fa-check mr-2 font-14"></i>
                        <span class="font-16"> Perbarui</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <table id="dt-master" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">Nama Pekerjaan</th>
                                <th class="font-15">Negara</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
        @include('sistem.master.modal-del')
@endsection

@section('script')
    @include('sistem.master.bandara.table')
@endsection