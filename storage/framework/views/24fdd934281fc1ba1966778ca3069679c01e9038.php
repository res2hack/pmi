
<script>
    function cekUsername() {
    $(document).ready(function() {

    let nmUsername = $('input[name=nmUsername]').val();
    $('#usernameError').hide();
    $('#usernameSuccess').hide();
    let url =  "<?php echo e(route('user_cek_username')); ?>";
    $.ajax({
        url : url,
        type : "GET",
        data: {     
            nmUsername: nmUsername,
        },
            dataType : "json",
            success:function(uniqueUser)
            {
                console.log(nmUsername);
                if(uniqueUser !== null){
                swal.fire({
                        icon: 'error',
                        title: 'Username Sudah Digunakan',
                        text: 'Cari Username Lain'
                    });
                $('#usernameError').show();
                $('#usernameSuccess').hide();
                
                $('#btn-simpan').prop('disabled', true);
                }
                else{
                    if(nmUsername !== ""){
                        $('#usernameSuccess').show();
                    }
                    $('#btn-simpan').prop('disabled', false);
                }
            }
        });
    });
}
</script>

<script>
    function cekEmail() {
    $(document).ready(function() {
    let nmEmail = $('input[name=nmEmailLogin]').val();
    let atposition = nmEmail.indexOf("@");  
    let dotposition = nmEmail.lastIndexOf(".");  
    let url =  "<?php echo e(route('user_cek_email')); ?>";
    $('#emailError').hide();
    $('#emailSuccess').hide();
    
    if(nmEmail !== "" && (atposition < 1 || dotposition < atposition+2 || 
        dotposition+2 >= nmEmail.length))
    {
        swal.fire({
            icon: 'error',
            title: 'Format Email Salah',
            text: 'Masukkan Email Dengan Benar'
        });
        $('#emailSuccess').hide();
        $('#formatError').show();
        $('#btn-simpan').prop('disabled', true);
    }
    else{
        $('#formatError').hide();
        $.ajax({
        url : url,
        type : "GET",
        data: {     
            nmEmail: nmEmail,
        },
            dataType : "json",
            success:function(uniqueEmail)
            {
                
                // console.log(uniqueEmail);
                if(uniqueEmail !== null){
                    
                swal.fire({
                        icon: 'error',
                        title: 'Email Sudah Digunakan',
                        text: 'Cari Email Lain'
                    });
                $('#emailError').show();
                $('#emailSuccess').hide();
                $('#btn-simpan').prop('disabled', true);
                }
                else{
                    if(nmEmail !== ""){
                        $('#emailSuccess').show();
                    }
                    $('#btn-simpan').prop('disabled', false);
                }
            }
        });
    }
   
    });
}
</script>

<script>
    function bersih(){
        $('#nmPenduduk').val('').trigger('change');
        $('#nmNIK').val('');
        $('#nmBPJS').val('');
        $('#nmTempatLahir').val('');
        $('#nmTglLahir').val('');
        $('#nmAlamat').val('');
        $('#nmKontak').val('');
        $('#nmEmail').val('');
        $("#nmAgama").val('').trigger('change');
        $("#nmPendidikan").val('').trigger('change');
        $("#nmProvinsi").val('').trigger('change');
        $("#nmKabKota").val('').trigger('change');
        $("#nmKecamatan").val('').trigger('change');
        $('#textLogin').hide();
    }
</script>
<script>
    function detailPelamarShow(){
        $('.detailPelamar').show();
        $('.pendudukBaru').show();
        $('.pendudukExists').hide();
        $('.beriLogin').show();
        bersih();
    }
    function detailPelamarHide(){
        $('.detailPelamar').hide();
        $('.pendudukBaru').hide();
        $('.pendudukExists').show();
        $('.beriLogin').hide();
        bersih();
    }

    function pelamarExists(){
        let exists = $('#nmPenduduk').val();
        if(exists){
            $('.detailPelamar').show();
            $('.pendudukBaru').hide();
            
            $.ajax({
                url : "<?php echo e(route('partner_detail_json')); ?>",
                type : "GET",
                data: {     
                    nmPenduduk: $('select[name=nmPenduduk]').val(),
                },
                dataType : "json",
                success:function(data)
                {
                    $('#nmNIK').val(data.nik);
                    $('#nmBPJS').val(data.bpjs);
                    if(data.jk == "L"){
                        $('#rdLaki').prop("checked", true);
                    }
                    else{
                        $('#rdPerempuan').prop("checked", true);
                    }
                    
                    $('#nmTempatLahir').val(data.tempat_lahir);
                    $('#nmTglLahir').val(data.tgl_lahir);
                    $('#nmAlamat').val(data.alamat);
                    $('#nmKontak').val(data.kontak);
                    $('#nmEmail').val(data.email);
                    $("#nmAgama").val(data.agama_id).trigger('change');
                    $("#nmPendidikan").val(data.pendidikan_id).trigger('change');
                    $("#nmProvinsi").val(data.provinsi_id).trigger('change');
                    setTimeout(function()
                        { 
                            $("#nmKabKota").val(data.kabupaten_id).trigger('change');
                            
                        }, 500);
                    setTimeout(function()
                    { 
                        $("#nmKecamatan").val(data.kecamatan_id).trigger('change');
                    }, 1000);
                    
                    $('#textLogin').show();
                    if(data.user_id){
                        $('#textLogin').html('<i class="far fa-check-circle font-13 text-success"></i><span class="ml-2 font-weight-bold text-dark">Pelamar Ini Mempunyai Hak Akses Sistem (Login)</span>')
                    }
                    else{
                        $('#textLogin').html('<i class="far fa-times-circle font-13 text-danger"></i><span class="ml-2 font-weight-bold  text-dark">Pelamar Ini Tidak Mempunyai Hak Akses Sistem (Login)</span>')
                    }
                }
            });

        }
    }

    $('#nmPenduduk').on('select2:unselecting', function (e) {
        detailPelamarHide();
    });

</script>

<script>
    function beriLogin() {
    var checkBox = document.getElementById("cbBeriLogin");
    if (checkBox.checked == true){
        $('#detailLogin').show();
        cekUsername();
        cekEmail();
    } else {
        $('#detailLogin').hide();
        $('#btn-simpan').prop('disabled', false);
    }
}
</script>




<script src="<?php echo e(asset('theme/assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js')); ?>"></script><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/lamaran/script-cek.blade.php ENDPATH**/ ?>