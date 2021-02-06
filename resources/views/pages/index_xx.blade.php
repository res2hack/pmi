@extends('layouts.admin') 

@section('title')
Kelola Data User
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <a href="{{ route('page_create')}}" class="btn btn-success mr-2 font-15">Baru</a>
                        
                        </div>
                        <div class="col-md-9 text-right">
                            <form action="{{ route('page_data')}}" class="d-inline">
                                <select onchange="this.form.submit()" name="show" id="show" class="p-2 border rounded">
                                    <option value="5" @if($show == 5) selected @endif>5</option>
                                    <option value="10" @if($show == 10) selected @endif>10</option>
                                    <option value="25" @if($show == 25) selected @endif>25</option>
                                    <option value="50" @if($show == 50) selected @endif>50</option>
                                </select>
                            </form>
                            <i class="fas fa-ellipsis-v mx-2"></i>
                            <select onchange="this.form.submit()" name="sort" id="sort" class="p-2 border rounded">
                                <option value="asc">Asc</option>
                                <option value="desc">Desc</option>
                            </select>
                            <select onchange="this.form.submit()" name="sort" id="sort" class="ml-1 p-2 border rounded">
                                <option value="title">Judul</option>
                                <option value="create_date">Create Date</option>
                                <option value="write_date">Write Date</option>
                            </select>
                            <i class="fas fa-ellipsis-v mx-2"></i>
                            <form action="{{ route('page_data')}}" class="d-inline">
                                <select onchange="this.form.submit()" name="show" id="show" class="p-2 border rounded">
                                    <option value="">- Kategori -</option>
                                </select>
                            </form>
                            <i class="fas fa-ellipsis-v mx-2"></i>
                            <div class="d-inline border rounded px-2 "  style="padding-top:9px;padding-bottom:9px;">
                                <form action="{{ route('page_search')}}" class="d-inline ">
                                    <div class="d-inline">
                                        <input class="border-0 py-1 px-2" type="search" name="search" placeholder="Cari Data">
                                        <button class="border-0 py-1 px-2 bg-white" type="submit" ><i class="fas fa-search"></i></button>
                                    </div>
                                    {{-- <input type="text" class="ml-2 p-2 border rounded" name="search">
                                    <button class="btn btn-dark ml-2 font-15">Cari</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-secondary">
                                    <th class="h-50 py-3 text-white">Judul</th>
                                    <th class="h-50 py-3 text-white">Slug</th>
                                    <th class="h-50 py-3 text-white">Status</th>
                                    <th class="h-50 py-3 text-white"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td colspan="4" class="pt-2 h-50"></td>
                                </tr>
                                @foreach($page as $x)
                                <tr>
                                    <td class=" bg-plum4 h-50 py-2">
                                    <a href="{{ route('page_edit', $x->id)}}">{{ $x->title }}</a>
                                    </td>
                                    <td class="bg-plum4 h-50 py-2">
                                        {{ $x->slug }}
                                    </td>
                                    <td class="bg-plum4 h-50 py-2 text-capitalize">{{ $x->status }}</td>
                                    <td class=" bg-plum4 h-50 py-2">
                                        <a href="{{ route('page_edit', $x->id )}}"><i class="fas fa-edit"></i></a>
                                        <a href="" onclick="$('#idDelete').val({{ $x->id }});" title="Hapus Bidang" data-toggle="modal" 
                                            data-target="#exampleModalCenter"><i class="fas fa-times text-danger font-15"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

<form method="POST" action="{{ route('role_delete_index')}}">
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