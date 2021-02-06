
@include('global.datatable')

<script>
function getKeberangkatan() {

    $(document).ready(function() {

    var table = $('#dt-master').DataTable({
        destroy: true,
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax: {
                url: '{{ route('jadwal_keberangkatan_json') }}',
                data: function (d) {
                d.nmBulan = $('select[name=nmBulan]').val();
                d.nmTahun = $('select[name=nmTahun]').val();
                // console.log(d.nmTahun);
                }
            },
        // buttons: ['copy', 'excel', 'colvis'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'no_penerbangan', name: 'no_penerbangan'},
            {data: 'asal_bandara', name: 'asal_bandara'},
            {data: 'status', name: 'status'},
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
};
</script>