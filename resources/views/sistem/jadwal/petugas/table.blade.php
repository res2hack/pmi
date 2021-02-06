
@include('global.datatable')

<script>

    var table = $('#dt-master').DataTable({
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '{{ route('jadwal_petugas_json') }}',
                // data: function (d) {
                //     d.slug = $('input[name=nmJenisKategori]').val();
                // }
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'jadwal', name: 'jadwal'},
            {data: 'ket1', name: 'ket1'},
            {data: 'ket2', name: 'ket2'},
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

</script>