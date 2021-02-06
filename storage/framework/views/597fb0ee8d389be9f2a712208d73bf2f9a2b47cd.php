<script>
    function getKota() {
    $(document).ready(function() {
        
        var kota = <?php echo $perusahaan->kabkota_id?:0; ?>;
        var url =  "<?php echo e(route('perusahaan_get_kabupaten')); ?>";
        $.ajax({
            url : url,
            type : "GET",
            data: {     
                nmProvinsi: $('select[name=nmProvinsi]').val(),
            },
            dataType : "json",
            success:function(data)
            {
            $('select[name="nmKabKota"]').empty();
            $('select[name="nmKabKota"]').append('<option value="">- Pilih -</option>');
            $.each(data, function(key,value){
                    
                    $('select[name="nmKabKota"]').append(
                        '<option value="'+ data[key].id +'" ' + (kota == data[key].id ? 'selected' : false) + '>'+ data[key].nama +'</option>');
                        
            });
            $("#nmKabKota").change(); 
            }
        });

    });  
};
</script>

<script>
    function getKecamatan() {
    $(document).ready(function() {
     
        var kecamatan = <?php echo $perusahaan->kecamatan_id?:0; ?>;
        var url =  "<?php echo e(route('perusahaan_get_kecamatan')); ?>";
        $.ajax({
            url : url,
            type : "GET",
            data: {     
                nmKabKota: $('select[name=nmKabKota]').val(),
            },
            dataType : "json",
            success:function(data)
            {
            $('select[name="nmKecamatan"]').empty();
            $('select[name="nmKecamatan"]').append('<option value="">- Pilih -</option>');
            $.each(data, function(key,value){
                    
                    $('select[name="nmKecamatan"]').append(
                        '<option value="'+ data[key].id +'" ' + (kecamatan == data[key].id ? 'selected' : false) + '>'+ data[key].nama +'</option>');
                        
            });
            $("#nmKecamatan").change(); 
            }
        });

    });  
};
</script>

<script>
    function cekUsername() {
    $(document).ready(function() {

    let nmUsername = $('input[name=nmUsername]').val();
    let userAsli = $('#nmUsernameFake').val();
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
                if(userAsli !== uniqueUser && uniqueUser !== null){
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
    let emailAsli = $('#nmEmailLoginFake').val();
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
                if(emailAsli !== uniqueEmail && uniqueEmail !== null){
                    
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
</script><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/perusahaan/script-edit.blade.php ENDPATH**/ ?>