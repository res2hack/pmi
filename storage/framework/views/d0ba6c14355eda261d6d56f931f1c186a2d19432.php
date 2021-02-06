<script>
     $('#selectAll1').click(function(){
        $('td .cbClassSertifikasi' ).prop('checked', this.checked)
    });
    $('#selectAll2').click(function(){
        $('td .cbClassKompeten' ).prop('checked', this.checked)
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
    function detailSertifikasi() {
        $(document).ready(function() {

        let pelatihan_id = <?php echo e($pelatihan->id); ?>;
        $.ajax({
            url : "<?php echo e(route('pelatihan_detail_json', "+pelatihan_id+")); ?>",
            type : "GET",
            data: {     
                nmIDpelatihan: pelatihan_id,
            },
            dataType : "json",
            success:function(data)
            {
                // console.log(data);
                if(!data[0].tgl_sertifikasi){
                    data[0].tgl_sertifikasi = '-';
                }
                if(!data[0].nama_lsp){
                    data[0].nama_lsp = '-';
                }
                if(!data[0].nama_asesor){
                    data[0].nama_asesor = '-';
                }
                if(!data[0].skema_uji){
                    data[0].skema_uji = '-';
                }

                let tgl_sert = new Date(data[0].tgl_sertifikasi);
                let d = tgl_sert.getDate();
                let m = tgl_sert.getMonth() + 1;
                let y = tgl_sert.getFullYear();
                let tgl_sert_final = (d <= 9 ? '0' + d : d) + '-' + (m <= 9 ? '0' + m : m) + '-' + y;

                if(tgl_sert_final == 'NaN-NaN-NaN'){
                    tgl_sert_final = '-';
                }
                $('#detailTglSertifikasi').text(tgl_sert_final);
                $('#detailLSP').text(data[0].nama_lsp);
                $('#detailAsesor').text(data[0].nama_asesor);
                $('#detailSkemaUji').text(data[0].skema_uji);
                
                if(data[0].jml_peserta_sertifikasi > 0){
                $('#ikutSertifikasi').html(data[0].jml_peserta_sertifikasi + ' Peserta' 
                        + '<span class="mx-2">/</span><span class="text-dark">' 
                        + data[0].peserta_sertifikasi_l + ' Laki-Laki, '
                        + data[0].peserta_sertifikasi_p + ' Perempuan');
                }else{
                    $('#ikutSertifikasi').text('-');
                }
                if(data[0].jml_lulusan_sertifikasi > 0){
                $('#jmlLulus').html(data[0].jml_lulusan_sertifikasi + ' Peserta' 
                        + '<span class="mx-2">/</span><span class="text-dark">' 
                        + data[0].lulusan_sertifikasi_l + ' Laki-Laki, '
                        + data[0].lulusan_sertifikasi_p + ' Perempuan');
                }else{
                    $('#jmlLulus').text('-');
                }
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

        let tgl_sertifikasi = $('input[name=nmTglSertifikasi]').val();
        let nama_lsp = $('select[name=nmLSP]').val();
        let asesor = $('input[name=nmAsesor]').val();
        let skema_uji = $('input[name=nmSkemaUji]').val();

        let ikut_sertifikasi = $("input[name='nmSertifikasi[]']:checked").map(function () {
                        return this.value;
                    }).get();

        let kompeten = $("input[name='nmKompeten[]']:checked").map(function () {
            return this.value;
        }).get();
        
        // jika array empty, set id = 0
        if(ikut_sertifikasi.length == 0){
            ikut_sertifikasi = ['0'];
        }
        if(kompeten.length == 0){
            kompeten = ['0'];
        }

        let pelatihan_id = <?php echo e($pelatihan->id); ?>;

            $.ajax({
                type : "POST",
                url :"<?php echo e(route('pelatihan_sertifikasi_update')); ?>",
                data: {  
                    nmIdPelatihan: pelatihan_id,
                    nmTglSertifikasi: tgl_sertifikasi,
                    nmLSP: nama_lsp,
                    nmAsesor: asesor,
                    nmSkemaUji:skema_uji,
                    nmSertifikasi: ikut_sertifikasi,
                    nmKompeten: kompeten,
                },
                dataType : "json",
                success:function(data)
                {
            
                    Toast1.fire({
                    icon: 'success',
                    html: '<span class="font-weight-500 ml-3 text-white">Sertifikasi Peserta Diperbarui</span>',
                    background: '#47c363',
                    width: 300
                    })
                    dataPendaftar();
                    // jumlahPeserta();
                    detailSertifikasi();
                    KlikBatal();
                },
                error:function(err){
                    console.log(err);
                },
            });
        });  
    });  
</script><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/sertifikasi/script.blade.php ENDPATH**/ ?>