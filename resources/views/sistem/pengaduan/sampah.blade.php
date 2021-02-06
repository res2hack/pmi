@extends('layouts.admin') 

@section('title')
Keranjang Sampah - Data Pengaduan
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
        <i class="far fa-comments font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengaduan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Sampah</span></div>
            
        <span class="font-weight-500 text-danger">Keranjang Sampah</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="{{ route('pengaduan_index')}}"><u>Pengaduan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Keranjang Sampah</span>
@endsection


@section('content')

@include('global.notifikasi')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                   
                    <table id="dt-master" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">No. Aduan</th>
                                <th class="font-15">Nama Pengadu</th>
                                <th class="font-15">Nama TKI</th>
                                <th class="font-15">Nama Majikan</th>
                                <th style="width:10%;"></th>
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
<form method="POST" action="{{ route('pengaduan_restore')}}">
    @csrf
    <input type="hidden" name="nmStatus" value="sampah">
    @include('sistem.pengaduan.modal-restore')
</form>



<form method="POST" action="{{ route('pengaduan_destroy')}}">
    @csrf
    <input type="hidden" name="nmStatus" value="sampah">
    @include('sistem.pengaduan.modal-destroy')
</form>
@endsection

@section('script')

@include('global.datatable')

<script>
    $(document).ready(function() {

    var table = $('#dt-master').DataTable({
        destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '{{ route('pengaduan_sampah_json') }}',
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'no_pengaduan', name: 'no_pengaduan'},
            {data: 'nama_peng', name: 'nama_peng'},
            {data: 'nama_tki', name: 'nama_tki'},
            {data: 'nama_majikan', name: 'nama_majikan'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
        },
        ],
        "displayLength": 25,
    });
    table.on( 'draw.dt', function () {
    var PageInfo = $('#dt-master').DataTable().page.info();
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    });
});  

</script>
@endsection