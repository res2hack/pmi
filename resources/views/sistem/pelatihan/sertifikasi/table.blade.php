
@include('global.datatable')

<script>
function getPelatihan() {
    $(document).ready(function() {
    var table = $('#dt-sertifikasi').DataTable({
        destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '{{ route('sertifikasi_index_json') }}',
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
            {data: 'sertifikasi', name: 'sertifikasi'},
            {data: 'kompeten', name: 'kompeten'},
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
    var PageInfo = $('#dt-sertifikasi').DataTable().page.info();
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    });
});  
}
</script>