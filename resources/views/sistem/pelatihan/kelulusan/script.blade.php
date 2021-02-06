<script>
    $('#selectAll').click(function(e){
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });
    function KlikUbah() {
    $(document).ready(function() {
            $('.ubahCheckbox').show();
            $('.iconStatus').hide();
        }); 
    };
    function KlikBatal() {
        $(document).ready(function() {
            $('.ubahCheckbox').hide();
            $('.iconStatus').show();
        }); 
    };  
</script>

<script>
    function jumlahPendaftar() {
        $(document).ready(function() {

        let pelatihan_id = {{ $pelatihan->id }};
        $.ajax({
            url : "{{ route('pelatihan_detail_json', "+pelatihan_id+")}}",
            type : "GET",
            data: {     
                nmIDpelatihan: pelatihan_id,
            },
            dataType : "json",
            success:function(data)
            {
                // console.log(data);
                if(data[0].jml_peserta < 1){
                    data[0].jml_peserta = 'Belum Ada';
                }
                $('#jmlPeserta').text(data[0].jml_peserta + ' Orang');
                $('#jmlDetailPeserta').html('<span class="mx-2">/</span>' + data[0].peserta_l + ' Laki-Laki, ' + data[0].peserta_p + ' Perempuan');
                $('#jmlLulus').text(data[0].jml_lulusan + ' Peserta');
                $('#jmlDetailLulus').html('<span class="mx-2">/</span>' + data[0].lulusan_l + ' Laki-Laki, ' + data[0].lulusan_p + ' Perempuan');
            }
        });
    });  
};  
</script>

<script>
    $(document).ready(function() {

        const Toast1 = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $(".btnSimpan").click(function(e) {
        e.preventDefault();
        let lulus = $("input[name='nmLulus[]']:checked").map(function () {
                        return this.value;
                    }).get();
            // jika array empty, set id = 0
            if(lulus.length == 0){
                lulus = ['0'];
            }
        let pelatihan_id = {{ $pelatihan->id }};

            $.ajax({
                type : "POST",
                url :"{{ route('pelatihan_kelulusan_update')}}",
                data: {  
                    nmIdPelatihan: pelatihan_id,
                    nmLulus: lulus,
                },
                dataType : "json",
                success:function(data)
                {
            
                    Toast1.fire({
                    icon: 'success',
                    html: '<span class="font-weight-500 ml-3 text-white">Kelulusan Peserta Diperbarui</span>',
                    background: '#47c363',
                    width: 300
                    })
                    dataPendaftar();
                    jumlahPendaftar();
                    KlikBatal();
                },
                error:function(err){
                    console.log(err);
                },
            });
        });  
    });  
</script>