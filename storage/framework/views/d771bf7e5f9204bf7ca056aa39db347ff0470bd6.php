 

<?php $__env->startSection('title'); ?>
Kelola Data Perusahaan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-house-user font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Perusahaan</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold
                rounded text-white align-top py-1 px-2">Indeks
            </span>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Perusahaan</span>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="mt-2 table-responsive ">
                        <div class="float-left mr-3">
                            <a href="<?php echo e(route('perusahaan_create')); ?>" class="btn btn-primary font-15 py-2" title="Buat SIP Baru">
                                <i class="fas fa-plus mr-2"></i>Baru
                            </a>
                        </div>
                        <table id="dt-perusahaan" class="table w-100">
                            <thead>
                                <tr>
                                    <th style="width:8%;">#</th>
                                    <th class="font-15" >Nama</th>
                                    <th class="font-15">Kontak</th>
                                    <th class="font-15">Login Sistem</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('perusahaan_delete')); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fa-exclamation-triangle font-18 text-warning mr-3"></i> 
                    Konfirmasi
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body font-weight-bold text-dark">
                <h5>Anda Yakin Ingin Menghapus Data Ini?</h5>
                <h6 class="text-danger font-weight-500">Data Akan Dihapus Permanen dan tidak bisa dikembalikan.</h6>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script>
    var groupColumn = 2;
    var table = $('#dt-perusahaan').DataTable({
        // dom: 'B<"clear">lfrtip',
        // destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(route('perusahaan_json')); ?>'
        },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'contact_telp', name: 'contact_telp'},
            {data: 'user_id', name: 'user_id'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
        },
        { "visible": false, "targets": groupColumn },
        // { "visible": false, "targets": 2 },
        // { "visible": false, "targets": 8 }
        ],
        "displayLength": 25,
    });
    table.on( 'draw.dt', function () {
    var PageInfo = $('#dt-perusahaan').DataTable().page.info();
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/perusahaan/index.blade.php ENDPATH**/ ?>