
<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    $(document).ready(function() {

    var table = $('#dt-pelamar').DataTable({
        destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '<?php echo e(route('pelamar_json')); ?>',
               
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'pendidikan', name: 'pendidikan'},
            {data: 'jabatan', name: 'jabatan'},
            {data: 'tgl_registrasi', name: 'tgl_registrasi'},
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
    var PageInfo = $('#dt-pelamar').DataTable().page.info();
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    });
});  

</script><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelamar/table.blade.php ENDPATH**/ ?>