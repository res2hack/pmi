@include('global.datatable')

<script>
    $(document).ready(function() {

    var table = $('#dt-penempatan').DataTable({
        destroy: true,
        paging: false,
        // processing: true,
        // serverSide: true,
        columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
        },
        ],
        // "displayLength": 25,
    });
    table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
                } );
    } ).draw();

});  


</script>