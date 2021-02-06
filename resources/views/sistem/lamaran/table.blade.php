
@include('global.datatable')

<script>
  function getLamaran() {
    $(document).ready(function() {
    var table = $('#dt-pelamar').DataTable({
        destroy: true,
        pageLength: 25,
        // lengthChange: false,
        processing: true,
        serverSide: true,
        ajax: {
                url: '{{ route('lamaran_json') }}',
                data: function (d) {
                        d.nmLowongan = $('select[name=nmLowongan]').val();
                }
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'pendidikan', name: 'pendidikan'},
            {data: 'tgl_registrasi', name: 'tgl_registrasi'},
            {data: 'syarat_kompetensi', name: 'syarat_kompetensi'},
            {data: 'syarat_sehat', name: 'syarat_sehat'},
            {data: 'syarat_dokumen', name: 'syarat_dokumen'},
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
        var PageInfo = $('#dt-pelamar').DataTable().page.info();
            table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        });
    });  
}
</script>