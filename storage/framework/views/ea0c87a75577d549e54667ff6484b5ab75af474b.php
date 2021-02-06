<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>

    var table = $('#dt-master').DataTable({
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '<?php echo e(route('sektor_json')); ?>',
                data: function (d) {
                    d.slug = $('input[name=nmJenisKategori]').val();
                }
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'keterangan1', name: 'keterangan1'},
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

</script><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/sistem/master/sektor/table.blade.php ENDPATH**/ ?>