@extends('layouts.admin') 

@section('title')
Kelola Pengguna - Baru
@endsection

@section('style')
<style>
    div.dataTables_wrapper div.dataTables_filter input {
        width:75% !important;
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
        <i class="fas fa-user-shield font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Pengguna</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Pengguna Baru</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('user_index')}}"><u>Pengguna</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
@endsection

@section('content')
<form method="POST" action="{{ route('user_store')}}">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow border-top5 border-form ">
                <div class="border-bottom bg-soft-dark py-3 px-4 font-17 font-weight-bold text-light">
                    User Baru
                </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Nama Lengkap</label>
                            <div class="col-md-8">
                                <input name="nmNamaLengkap" type="text" class="form-control bg-form border-form h-42" value="{{ old('nmNamaLengkap') }}"  >
                                <small class="text-danger font-weight-bold">{{ $errors->first('nmNamaLengkap') }}</small>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Username</label>
                            <div class="col-md-8">
                                <input name="nmUsername" type="text" class="form-control bg-form border-form h-42" value="{{ old('nmUsername') }}"  >
                                <small class="text-danger font-weight-bold">{{ $errors->first('nmUsername') }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Email</label>
                            <div class="col-md-8">
                                <input name="Email" type="email" class="form-control bg-form border-form h-42" value="{{ old('Email') }}" >
                                <small class="text-danger font-weight-bold">{{ $errors->first('Email') }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Password</label>
                            <div class="col-md-8">
                                <input name="password" type="password" class="form-control bg-form border-form h-42" value="{{ old('password') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Konfirmasi Pass.</label>
                            <div class="col-md-8">
                                <input name="password_confirmation" type="password" 
                                    value="{{ old('password_confirmation') }}" class="form-control bg-form border-form h-42" >
                                <small class="text-danger font-weight-bold">{{ $errors->first('password') }}</small>
                            </div>
                        </div>
                        <div class="border-top2-dashed border-form"></div>

                        <h5 class="mt-3 mb-4">Biodata (Opsional)</h5>

                        <div class="form-group row mt-5">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Tanggal Lahir</label>
                            <div class="col-md-8">
                                <input name="nmTglLahir" type="date" class="form-control bg-form border-form h-42" value="{{ old('nmTglLahir') }}"  >
                                <small class="text-danger font-weight-bold">{{ $errors->first('nmTglLahir') }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 mt-1 font-15 font-weight-bold mb-2">J. Kelamin</label>
                            <div class="col-md-8 mt-1">
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
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Alamat</label>
                            <div class="col-md-8">
                                <textarea name="nmAlamat"  class="form-control bg-form border-form h-42" rows="2">{{ old('nmAlamat') }}</textarea>
                                <small class="text-danger font-weight-bold">{{ $errors->first('nmAlamat') }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Kontak</label>
                            <div class="col-md-8">
                                <textarea name="nmKontak"  class="form-control bg-form border-form h-42" rows="2">{{ old('nmKontak') }}</textarea>
                                <small class="text-danger font-weight-bold">{{ $errors->first('nmKontak') }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Keterangan</label>
                            <div class="col-md-8">
                                <textarea name="nmKeterangan"  class="form-control bg-form border-form h-42" rows="2">{{ old('nmKeterangan') }}</textarea>
                                <small class="text-danger font-weight-bold">{{ $errors->first('nmKeterangan') }}</small>
                            </div>
                        </div>
                        <div class="border-top2-dashed border-form mb-4"></div>
                        <div class="form-group row">
                            <label class="col-md-4 mt-2 font-weight-bold font-15">Status</label>
                            <div class="col-md-8">
                                <select name="nmStatusAktif" id="nmStatusAktif" class="form-control selectric" style="font-size:16px;" >
                                        <option value="0">Aktif</option>
                                        <option value="1">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row font-12  pt-4 mb-0 pb-0">
                                <ul>
                                    <li class="pl-1">Tidak Aktif = Tidak Bisa Login.</li>
                                    <li class="pl-1">Jangan Lupa Untuk Memilih Role Untuk Pengguna Ini.</li>
                                </ul>
                        </div>
                    </div>
                    <div class="card-footer border-top py-3 text-right">
                        <button type="submit" class="btn btn-lg btn-dark">
                            <i class="fas fa-check mr-3 font-14"></i><span class="font-15">Tambah</span>
                        </button>
                    </div>
                </div>
            
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table id="datatable3" class="table">
                        <thead>
                                <th>#</th>
                                <th class="h-50 py-3 font-15">Role</th>
                        </thead>
                        <tbody> 
                            @foreach ($role as $item)
                            <tr>
                                <td class="h-50 pt-2"></td>
                                <td class="h-50 pt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="nmRole[]" value="{{ $item->id }}" id="cbRole{{ $item->id }}">
                                        <label class="custom-control-label font-14 font-weight-500 align-top text-primary" style="cursor:pointer;"
                                            for="cbRole{{ $item->id }}">{{ $item->name }}
                                        </label>
                                    </div>
                                    <div class="pl-4">{{ $item->deskripsi }}</div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    @include('global.datatable')
    <script>
        var table3 =  $('#datatable3').DataTable( {
                paging: false,
                });
            
            table3.on( 'order.dt search.dt', function () {
                table3.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
                } );
            } ).draw();
    </script>
@endsection