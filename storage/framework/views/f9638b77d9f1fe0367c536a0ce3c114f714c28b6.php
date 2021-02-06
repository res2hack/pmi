<link rel="stylesheet" href="<?php echo e(asset('theme/assets/css/datatable/dataTables.bootstrap4.min.css')); ?>">

<script src="<?php echo e(asset('theme/assets/js/datatable/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/js/datatable/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/js/datatable/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/js/page/modules-datatables.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/js/datatable/pdfmake.min.js')); ?>"></script>
<script>
    var table2 =  $('#datatable').DataTable( {
                paging: 25,
                displayLength: 25,
                
                });
            
            table2.on( 'order.dt search.dt', function () {
                table2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
                } );
            } ).draw();
</script><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/global/datatable.blade.php ENDPATH**/ ?>