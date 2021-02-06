@extends('layouts.admin') 

@section('title')
Kelola Hak Akses
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Hak Akses</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Hak Akses</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Hak Akses</span>
@endsection

@section('content')
@include('global.notifikasi')
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('permission_store')}}">
            @csrf
            <div class="card shadow border-top5 border-form ">
                <div class="border-bottom py-3 px-4 font-17 font-weight-bold text-primary">
                    Hak Akses Baru
                </div>
                <div class="card-body mt-0 pb-1 ">
                    <div class="form-group">
                        <label class="font-weight-bold font-15">Nama Hak Akses</label>
                        <input type="text" name="nama" class="form-control font-weight-500 border-form bg-form h-42" 
                            value="{{ old('nama')}}" required>
                        <small class="text-danger">{{ $errors->first('nama') }}</small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold font-15">Grup <small class="align-top">(Huruf Kecil)</small></label>
                        <input type="text" name="nmGrup" class="form-control font-weight-500 border-form bg-form h-42" value="{{ old('nmGrup')}}">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold font-15">Keterangan</label>
                        <input type="text" name="nmKeterangan" class="form-control font-weight-500 border-form bg-form h-42" value="{{ old('nmKeterangan')}}">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold font-15">Deskripsi</label>
                        <textarea type="text" name="nmDeskripsi" 
                        class="form-control font-weight-500 border-form bg-form" rows="5">{{ old('nmDeskripsi')}}</textarea>
                    </div>
                </div>
                <div class="card-footer border-top py-3">
                    <button type="submit" class="btn btn-lg btn-dark">
                        <i class="fas fa-check mr-3 font-14"></i><span class="font-15">Tambah</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                    <table id="dt-permissions" class="table">
                        <thead>
                            <th class="h-50 py-3 font-15 font-weight-bold">#</th>
                            <th class="h-50 py-3 font-15 font-weight-bold">Nama Hak Akses</th>
                            <th class="h-50 py-3 font-15 font-weight-bold">Deskripsi</th>
                            <th class="h-50 py-3 font-15 font-weight-bold">Grup</th>
                            <th class="h-50 py-3 font-15 font-weight-bold"></th>
                        </thead>
                        <tbody>
                            @foreach($permission as $x)
                            <tr>
                                <td class="py-1"></td>
                                <td class="py-1 font-14">
                                    <a class="mr-1" href="{{ route('permission_edit', $x->id )}}" class="font-weight-500">
                                        {{ $x->name }}
                                    </a><br>
                                    <small class="font-11 text-dark font-weight-500">{{ $x->keterangan }}</small>
                                </td>
                                <td class="py-1 font-12">{{ $x->deskripsi }}</td>
                                <td class="py-1 font-12">{{ $x->grup }}</td>
                                <td class="py-1">
                                    <a class="mr-1" href="{{ route('permission_edit', $x->id )}}"><i class="fas fa-edit"></i></a>
                                    <a href="" onclick="$('#idDelete').val({{ $x->id }});" title="Hapus Data" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-times text-danger font-15"></i></a>
                                </td>
                                
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
            </div>
            
        </div>
    </div>
    
</div>

@endsection

@section('modal')

<form method="POST" action="{{ route('permission_delete_index')}}">
    @csrf
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle font-15 text-warning mr-2"></i> KONFIRMASI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda Yakin Ingin Menghapus Data Ini?
                <input id="idDelete" name="idDelete" type="hidden">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-danger">Ya Hapus</button>
            </div>
        
            </div>
        </div>

    </div>
</form>
@endsection

@section('script')
    @include('users.permission.datatable')
@endsection

