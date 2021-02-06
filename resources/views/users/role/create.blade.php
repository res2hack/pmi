@extends('layouts.admin') 

@section('title')
Kelola Role User - Buat Baru
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-shield font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Role User</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Role Baru</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('role_index')}}"><u>Role user</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
@endsection

@section('content')
@include('global.notifikasi')

<form method="POST" action="{{ route('role_store')}}">
    @csrf

    <div class="row">
        <div class="col-4">
            
            <div class="card shadow border-top5 border-form ">
                <div class="border-bottom py-3 px-4 font-17 font-weight-bold text-primary">
                    Role Baru
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Nama Role</label>
                        <input type="text" name="nmRole" value="{{ old('nmRole')}}"
                            class="form-control font-weight-bold bg-form border-form h-42" required>
                        <small class="text-danger">{{ $errors->first('nmRole') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Deskripsi</label>
                        <textarea type="text" name="nmDeskripsi" class="p-2 form-control
                            font-weight-500 bg-form border-form" rows="5">{{ old('nmDeskripsi')}}</textarea>
                    </div>
                </div>
                <div class="card-footer border-top py-3">
                    <button type="submit" class="btn btn-lg btn-dark">
                        <i class="fas fa-check mr-3 font-14"></i><span class="font-15">Tambah</span>
                    </button>
                </div>
            </div>
            
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table id="dt-roles" class="table">
                        <thead>
                            <tr>
                                <th class="h-50 py-3 font-15 font-weight-bold">#</th>
                                <th class="h-50 py-3 font-15 font-weight-bold">Nama Role</th>
                                <th class="h-50 py-3 font-15 font-weight-bold">Keterangan</th>
                                <th class="h-50 py-3 font-15 font-weight-bold">Grup</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($permissions as $x)
                            <tr>
                                <td class="py-0"></td>
                                <td class="py-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="nmPermission[]" value="{{ $x->id }}" id="cbPermisi{{ $x->id }}">
                                        <label class="custom-control-label font-14 font-weight-500 align-top text-primary" style="cursor:pointer;"
                                            for="cbPermisi{{ $x->id }}">{{ str_replace('-',' ',$x->name) }}
                                        </label>
                                    </div>
                                </td>
                                <td class="py-0">
                                    <div class="font-weight-500 ">
                                        {{ $x->keterangan }}
                                    </div>
                                    {{-- <div class="font-12">
                                        {{ $x->deskripsi }}
                                    </div>
                                     --}}
                                </td>
                                <td class="py-0">
                                    {{ $x->grup }}
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
    @include('users.role.datatable')
@endsection