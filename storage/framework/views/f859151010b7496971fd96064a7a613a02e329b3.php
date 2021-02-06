
<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>

function getPelatihan() {
    $(document).ready(function() {
    var table = $('#dt-pendaftaran').DataTable({
        destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '<?php echo e(route('pendaftaran_index_json')); ?>',
                data: function (d) {
                        d.nmTahun = $('select[name=nmTahun]').val();
                }
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'tgl_mulai', name: 'tgl_mulai'},
            {data: 'kejuruan', name: 'kejuruan'},
            {data: 'tipe_pendaftaran', name: 'tipe_pendaftaran'},
            {data: 'status_pendaftaran', name: 'status_pendaftaran'},
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
    var PageInfo = $('#dt-pendaftaran').DataTable().page.info();
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    });
});  
}
</script><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/pendaftaran/table.blade.php ENDPATH**/ ?>