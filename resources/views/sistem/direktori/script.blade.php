@include('global.datatable')

<script>
    var table = $('#dt-direktori').DataTable({
        // dom: 'B<"clear">lfrtip',
        // destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '{{ route('direktori_json') }}',
                data: function (d) {
                    d.jenisDirektori = $('input[name=jenisDirektori]').val();
                }
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'alamat', name: 'alamat'},
            {data: 'kontak', name: 'kontak'},
            {data: 'sts_tampil', name: 'sts_tampil'},
            {data: 'sts_valid', name: 'sts_valid'},
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
    var PageInfo = $('#dt-direktori').DataTable().page.info();
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    });

</script>