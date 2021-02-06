 

<?php $__env->startSection('title'); ?>
Kelola Lowongan (SIP) - Indeks
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
        <i class="fas fa-clipboard-list font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Lowongan (SIP)</h4> 
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
<span class="font-weight-bold text-dark">Lowongan</span>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="mt-2 table-responsive ">
                        <div class="float-left mr-3">
                                <select name="nmLimit" onchange="getSIP();" class="form-control bg-form 
                                    border-form text-form font-weight-bold" style="width:120px;">
                                    <option value="50">50 Data</option>
                                    <option value="100">100 Data</option>
                                    <option value="">Semua</option>
                                </select>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo e(route('sip_create')); ?>" class="ml-3 btn btn-primary font-15 py-2" title="Buat SIP Baru">
                                <i class="fas fa-plus mr-2"></i>Baru
                            </a>
                        </div>
                        <table id="dt-sip" class="table w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="font-15" style="width:20%;">Posisi</th>
                                    <th class="font-15">Agency</th>
                                    <th class="font-15" style="width:25%;">No. SIP</th>
                                    <th class="font-15">Status</th>
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
<?php echo $__env->make('sistem.sip.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
function getSIP() {
    $(document).ready(function() {
    var table = $('#dt-sip').DataTable({
        // dom: 'B<"clear">lfrtip',
        destroy: true,
        lengthChange: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(route('sip_json')); ?>',
            data: function (d) {
                    d.nmLimit = $('select[name=nmLimit]').val();
                }
        },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'jabatan', name: 'jabatan'},
            {data: 'agency', name: 'agency'},
            {data: 'no_sip', name: 'no_sip'},
            {data: 'tgl_ijin_akhir', name: 'tgl_ijin_akhir'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
        },
        // { "visible": false, "targets": groupColumn },
        // { "visible": false, "targets": 2 },
        // { "visible": false, "targets": 8 }
        ],
        "displayLength": 25,
        // "drawCallback": function ( settings ) {
        //     var api = this.api();
        //     var rows = api.rows( {page:'current'} ).nodes();
        //     var last= null;
        //     api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
        //         // var data2 = table.row(i).data();
        //         //     id_jurnal = data2.id_jurnal;
        //         //     tgl = data2.tgl;
        //         //     console.log(data2);
        //         if ( last !== group ) {
        //             $(rows).eq( i ).before(
        //                 '<tr class="group" style="background-color:#ece5fd!important;"><td class="font-weight-bold font-15 text-hitam" colspan="6">'+group+'</td></tr>'
        //             );
    
        //             last = group;
        //         }
        //     } );
        // }
    
    });
    table.on( 'draw.dt', function () {
    var PageInfo = $('#dt-sip').DataTable().page.info();
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    });

    // Order by the grouping
    // $('#dt-sip tbody').on( 'click', 'tr.group', function () {
    //         var currentOrder = table.order()[0];
    //         if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
    //             table.order( [ groupColumn, 'desc' ] ).draw();
    //         }
    //         else {
    //             table.order( [ groupColumn, 'asc' ] ).draw();
    //         }
    // });
});  
}

</script>

<script>
    setTimeout(function()
    { 
        getSIP();
    }, 500);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/sistem/sip/index.blade.php ENDPATH**/ ?>