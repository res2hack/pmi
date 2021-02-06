
<script>
    function partnerReset() {
    $(document).ready(function() {
        $('#formPartner').trigger("reset");
        $('#formExists').trigger("reset");
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
                if(data[0].jml_pendaftar < 1){
                    data[0].jml_pendaftar  = 'Belum Ada';
                }
                $('#jmlPendaftar').html(data[0].jml_pendaftar  + ' Pendaftar <span class="mx-2">/</span>' 
                    + '<span class="text-dark">'+ data[0].pendaftar_l + ' Laki-Laki, ' 
                    + data[0].pendaftar_p + ' Perempuan</span>');
                
                if(data[0].jml_pendaftar > 0){
                    $('#dataKosong').hide();
                    $('#dataIsi').show();
                }
                else{
                    $('#dataKosong').show();
                    $('#dataIsi').hide();
                }
            }
        });
    });  
};  
</script>

<script>
$(document).ready(function(){

    $("#nmPenduduk").select2({

    //  Render html code semisal panah
    escapeMarkup: function (text) { return text; }, 
    
    allowClear: true,
    placeholder: {
        id: "",
        placeholder: "Pilih Penduduk..."
    },
    language: {
        inputTooShort: function (args) {

            return "ketikkan lebih dari 3 huruf.";
        },
        noResults: function () {
            return "Penduduk Tidak Ditemukan.";
        },
        searching: function () {
            return "Sedang mencari, harap menunggu...";
        }
    },
    minimumInputLength: 3,
    ajax: {
        url: '{{ route('partner_get_penduduk')}}',
        dataType: 'json',
        type: "get",
        quietMillis: 50,
        data: function(term) {
            return {
                term: term.term
            };
            console.log(term);
        }, 
       
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
    });
});
</script>

<script>
    function getKota() {
    $(document).ready(function() {
        
        var kota = '';

        var url =  "{{ route('partner_get_kabupaten')}}";
        $.ajax({
            url : url,
            type : "GET",
            data: {     
                nmProvinsi: $('select[name=nmProvinsi]').val(),
            },
            dataType : "json",
            success:function(data)
            {
            $('select[name="nmKabupaten"]').empty();
            $('select[name="nmKabupaten"]').append('<option value="">- Pilih -</option>');
            $.each(data, function(key,value){
                    
                    $('select[name="nmKabupaten"]').append(
                        '<option value="'+ data[key].id +'" ' + (kota == data[key].id ? 'selected' : false) + '>'+ data[key].nama +'</option>');
                        
            });
            $("#nmKabupaten").change(); 
            }
        });

    });  
};
</script>

<script>
    function getKecamatan() {
    $(document).ready(function() {
        
        var kecamatan = '';
        var url =  "{{ route('partner_get_kecamatan')}}";
        $.ajax({
            url : url,
            type : "GET",
            data: {     
                nmKabupaten: $('select[name=nmKabupaten]').val(),
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
    $('#usernameError').hide();
    $('#usernameSuccess').hide();
    let url =  "{{ route('user_cek_username')}}";
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
    let url =  "{{ route('user_cek_email')}}";
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
        $("#btn-exists").click(function(e) {
        e.preventDefault();

        let penduduk = $("#formExists select[name=nmPenduduk]").val(); 
        let idExists =  $("#formExists input[name=nmIDpelatihanExists]").val();
        let kejuruanExists =  $("#formExists input[name=nmKejuruanExists]").val();
        let tglDaftarExists =  $("#formExists input[name=nmTglDaftarExists]").val();
        
        let cek_duplikat;

        if(penduduk == null){
            swal.fire({
                icon: 'error',
                title: 'Data Penduduk Belum Dipilih',
                text: 'Cari dan Pilih data penduduk terlebih dahulu'
            });
        }
        else{
            $.ajax({
                type : "GET",
                url :"{{ route('pelatihan_pendaftaran_duplikat')}}",
                data: {  
                    nmPenduduk: penduduk,
                    nmIDpelatihanExists: idExists,
                },
                dataType : "json",
                success:function(data)
                {
                    
                    cek_duplikat = data;
                    console.log(cek_duplikat);
                    if(cek_duplikat > 0){
                        swal.fire({
                            icon: 'error',
                            title: 'Duplikat Pendaftaran',
                            text: 'Peserta Ini Sudah Didaftarkan'
                        });
                    }
                    else{
                        $.ajax({
                            type : "POST",
                            url :"{{ route('pelatihan_pendaftaran_store_exists')}}",
                            data: {  
                                nmPenduduk: penduduk,
                                nmIDpelatihanExists: idExists,
                                nmKejuruanExists: kejuruanExists,
                                nmTglDaftarExists: tglDaftarExists,
                            },
                            dataType : "json",
                            success:function(data)
                            {
                            
                                Toast1.fire({
                                icon: 'success',
                                html: '<span class="font-weight-500 ml-3 text-white">Pendaftaran Peserta Berhasil</span>',
                                background: '#47c363',
                                width: 300
                                })
                                $('#nmPenduduk').val(null).trigger('change');
                                dataPendaftar();
                                jumlahPendaftar();
                            },
                            error:function(err){
                                console.log(err);
                            },
                        });
                    }
                },
                error:function(err){
                    console.log(err);
                },
            });
        }
        
    });  
});  
</script>

<script>
    $(document).ready(function() {

        const Toast2 = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
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
        $("#btn-daftar").click(function(e) {
        e.preventDefault();
       
        $.ajax({
            type : "POST",
            url :"{{ route('pelatihan_pendaftaran_store_baru')}}",
            data: {    
                nmKejuruanBaru: $("#formPartner input[name=nmKejuruanBaru]").val(),
                nmIDpelatihanBaru: $("#formPartner input[name=nmIDpelatihanBaru]").val(),
                nmPartner: $("#formPartner input[name=nmPartner]").val(),
                nmNIK: $("#formPartner input[name=nmNIK]").val(),
                nmBPJS: $("#formPartner input[name=nmBPJS]").val(),
                nmJK: $("#formPartner input[type=radio][name=nmJK]:checked").val(),
                nmTempatLahir: $("#formPartner input[name=nmTempatLahir]").val(),
                nmTglLahir: $("#formPartner input[name=nmTglLahir]").val(),
                nmAgama: $("#formPartner select[name=nmAgama]").val(),
                nmKontak: $("#formPartner textarea[name=nmKontak]").val(),
                nmEmail: $("#formPartner input[name=nmEmail]").val(),
                nmAlamat: $("#formPartner textarea[name=nmAlamat]").val(),
                nmPendidikan: $("#formPartner select[name=nmPendidikan]").val(),
                nmProvinsi: $("#formPartner select[name=nmProvinsi]").val(),
                nmKabupaten: $("#formPartner select[name=nmKabupaten]").val(),
                nmKecamatan: $("#formPartner select[name=nmKecamatan]").val(),
                nmBeriLogin: $("#formPartner input:checkbox[name=nmBeriLogin]:checked").val(),
                nmUsername: $("#formPartner input[name=nmUsername]").val(),
                nmEmailLogin: $("#formPartner input[name=nmEmailLogin]").val(),
                nmPassword: $("#formPartner input[name=nmPassword]").val(),
                nmStatusAktif: $("#formPartner select[name=nmStatusAktif]").val(),
                nmTglDaftarBaru: $("#formPartner input[name=nmTglDaftarBaru]").val(),
            },
            dataType : "json",
            success:function(data)
            {
                Toast2.fire({
                    icon: 'success',
                html: '<span class="font-weight-500 ml-3 text-white">Pendaftaran Peserta Berhasil</span>',
                background: '#47c363',
                width: 300
                })
                partnerReset();
                jumlahPendaftar();
                dataPendaftar();
            },
            error:function(err){
                console.log(err);
            },
        });
        

    });  
});  
</script>

<script>
    $(document).ready(function() {

    const Toast3 = Swal.mixin({
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

    $("#btn-delete-daftar").click(function(e) {
        e.preventDefault();

        $.ajax({
            type : "POST",
            url :"{{ route('pelatihan_pendaftaran_delete')}}",
            data: {  
                idDelete: $("#formBatalDaftar input[name=idDelete]").val(),
            },
            dataType : "json",
            success:function(data)
            {
                Toast3.fire({
                    icon: 'success',
                html: '<span class="font-weight-500 ml-3 text-white">Pendaftaran Peserta Dibatalkan</span>',
                background: '#47c363',
                width: 350
                })
                $("#modalBatalDaftar").modal('hide');
                dataPendaftar();
                jumlahPendaftar();
            },
            error:function(err){
                console.log(err);
            },
        });
    });  

    $("#btn-ubah-daftar").click(function(e) {
        e.preventDefault();

        $.ajax({
            type : "POST",
            url :"{{ route('pelatihan_pendaftaran_update')}}",
            data: {  
                idUbah: $("#formUbahDaftar input[name=idUbah]").val(),
                nmTglDaftarUbah: $("#formUbahDaftar input[name=nmTglDaftarUbah]").val(),
            },
            dataType : "json",
            success:function(data)
            {
                Toast3.fire({
                    icon: 'success',
                html: '<span class="font-weight-500 ml-3 text-white">Pendaftaran Peserta Diperbarui</span>',
                background: '#47c363',
                width: 350
                })
                $("#modalUpdate").modal('hide');
                dataPendaftar();
            },
            error:function(err){
                console.log(err);
            },
        });
    });  


});  
</script>

