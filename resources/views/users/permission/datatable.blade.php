@include('global.datatable')
<script>
     var groupColumn = 3;
    var table = $('#dt-permissions').DataTable({
        pageLength: 25,
        columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
        },
        { "visible": false, "targets": groupColumn },
        ],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last= null;
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color:#ece5fd!important;"><td class="font-weight-bold font-15 text-hitam text-uppercase" colspan="4">'+group+'</td></tr>'
                    );
    
                    last = group;
                }
            } );
        }
    
    });
    table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
                } );
            } ).draw();

    // Order by the grouping
    $('#dt-permissions tbody').on( 'click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
                table.order( [ groupColumn, 'desc' ] ).draw();
            }
            else {
                table.order( [ groupColumn, 'asc' ] ).draw();
            }
    });
</script>