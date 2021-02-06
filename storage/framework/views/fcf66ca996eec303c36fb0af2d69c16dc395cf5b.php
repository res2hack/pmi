 

<?php $__env->startSection('title'); ?>
Keranjang Sampah - Data Pengaduan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pengaduan_index')); ?>"><u>Pengaduan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Keranjang Sampah</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<form method="POST" action="<?php echo e(route('pengaduan_restore')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="nmStatus" value="sampah">
    <?php echo $__env->make('sistem.pengaduan.modal-restore', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>



<form method="POST" action="<?php echo e(route('pengaduan_destroy')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="nmStatus" value="sampah">
    <?php echo $__env->make('sistem.pengaduan.modal-destroy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    $(document).ready(function() {

    var table = $('#dt-master').DataTable({
        destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '<?php echo e(route('pengaduan_sampah_json')); ?>',
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pengaduan/sampah.blade.php ENDPATH**/ ?>