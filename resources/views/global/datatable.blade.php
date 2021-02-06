<link rel="stylesheet" href="{{ asset('theme/assets/css/datatable/dataTables.bootstrap4.min.css') }}">

<script src="{{ asset('theme/assets/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/page/modules-datatables.js') }}"></script>
<script src="{{ asset('theme/assets/js/datatable/pdfmake.min.js') }}"></script>
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
</script>