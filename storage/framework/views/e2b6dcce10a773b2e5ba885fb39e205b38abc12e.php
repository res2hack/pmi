
<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
function getPelatihan() {
    $(document).ready(function() {
        var table = $('#dt-pelatihan').DataTable({
            destroy: true,
            pageLength: 25,
            processing: true,
            serverSide: true,
            ajax: {
                    url: '<?php echo e(route('pelatihan_json')); ?>',
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
                {data: 'anggaran', name: 'anggaran'},
                {data: 'status_pelatihan', name: 'status_pelatihan'},
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
        var PageInfo = $('#dt-pelatihan').DataTable().page.info();
            table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        });
    });  
}

</script><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/table.blade.php ENDPATH**/ ?>