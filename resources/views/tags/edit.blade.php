@extends('layouts.admin') 

@section('title')
Kelola Kategori Artikel - Edit
@endsection

@section('content')

@if (session('error'))
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <i class="far fa-check-circle mr-2"></i> {{ session('error') }}
        </div>
    </div>
@endif
@include('global.notifikasi')

<div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('category_update', $category->id)}}">
            @csrf
            <div class="card">
                <div class="card-footer bg-dark text-light font-weight-bold font-16 rounded-top">
                    Kategori Baru
                </div>
                <div class="card-body pb-1">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Nama Kategori</label>
                        <input type="text"  id="nmKategori" name="nmKategori" class="form-control" 
                        onChange="$('#nmJenisKategori').val($('#nmKategori').val().toLowerCase().replace(/\s/g, '-'));"
                        value="{{ $category->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Deskripsi</label>
                        <textarea type="text" name="nmDeskripsi" class="form-control" rows="2">{{ $category->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Slug</label>
                        <input type="text" id="nmJenisKategori" name="nmJenisKategori" class="form-control" value="{{ $category->slug }}">
                    </div>
                </div>
                <div class="card-footer bg-light py-3">
                    <a href="" class="btn btn-danger mr-2" title="Hapus Kategori" data-toggle="modal" data-target="#exampleModalCenter">Hapus</a>
                    <button type="submit" class="btn btn-primary font-14">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <th class="h-50 py-3 font-15">#</th>
                            <th class="h-50 py-3 font-15">Nama Kategori</th>
                            <th class="h-50 py-3 font-15">Deskripsi</th>
                            <th class="h-50 py-3 font-15">Slug</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($list as $x)
                            <tr>
                                <td></td>
                                <td class="h-50 py-2 font-14">
                                    {{ $x->name }}
                                </td>
                                <td class="h-50 py-2 font-14">{{ $x->deskripsi }}</td>
                                <td class="h-50 py-2 font-14">/{{ $x->slug }}</td>
                                <td> <a class="mr-1" href="{{ route('category_edit', $x->id )}}"><i class="fas fa-edit"></i></a></td>
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

<form method="POST" action="{{ route('category_delete_index')}}">
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
                <input id="idDelete" name="idDelete" type="hidden" value="{{ $category->id }}">
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

    @include('global.datatable')

@endsection
