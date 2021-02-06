
@include('global.datatable')

<script>
    function dataPendaftar() {
        $(document).ready(function() {

        var table = $('#dt-penerimaan').DataTable({
            destroy: true,
            paging: false,
            processing: true,
            serverSide: true,
            ajax: {
                    url: '{{ route('pelatihan_penerimaan_detail_json') }}',
                    data: {
                        nmIDpelatihan: $("input[name=nmIDpelatihan]").val(),
                    }
                },
            // buttons: ['copy', 'excel', 'colvis'], 
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama', name: 'nama'},
                {data: 'nik', name: 'nik'},
                {data: 'jk', name: 'jk'},
                {data: 'alamat', name: 'alamat'},
                {data: 'tgl_pendaftaran', name: 'tgl_pendaftaran'},
                {data: 'no_pendaftaran', name: 'no_pendaftaran'},
                {data: 'status_penerimaan', name: 'status_penerimaan', orderable: false, searchable: false}
            ],
            columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
            },
            ],
            // "displayLength": 25,
        });
        table.on( 'draw.dt', function () {
        var PageInfo = $('#dt-penerimaan').DataTable().page.info();
            table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        });
    });  
}

</script>