
@include('global.datatable')

<script>
    $(document).ready(function() {

    var table = $('#dt-master').DataTable({
        destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '{{ route('pengaduan_json') }}',
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'no_pengaduan', name: 'no_pengaduan'},
            {data: 'nama_peng', name: 'nama_peng'},
            {data: 'nama_tki', name: 'nama_tki'},
            {data: 'nama_majikan', name: 'nama_majikan'},
            {data: 'status_kasus', name: 'status_kasus'},
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