<script>
    function cekKepulangan() {
    
        $(document).ready(function() {
            var kepulangan =  $('#nmKepulangan').val();
            if(kepulangan == 1){
                $('#dijemput').show();
                $('#nmNamaPenjemput').show();
                $('#pulangSendiri').hide();
                $('#Menggunakan').hide();
            }
            else if(kepulangan == 2){
                $('#dijemput').hide();
                $('#nmNamaPenjemput').hide();
                $('#pulangSendiri').show();
                $('#Menggunakan').show();
            }
            else if(kepulangan == 3)
            {
                $('#Transit').show();
                $('#dijemput').hide();
                $('#nmNamaPenjemput').hide();
                $('#pulangSendiri').hide();
                $('#Menggunakan').hide();
            }
            else{
                $('#dijemput').hide();
                $('#nmNamaPenjemput').hide();
                $('#pulangSendiri').hide();
                $('#Menggunakan').hide();
                $('#Transit').hide();
            }
        });  
};
</script>

<script>
    function getKota() {
    $(document).ready(function() {
        
        var kota = {!! $kedatangan->kabkota?:0 !!};

        var url =  "{{ route('kedatangan_get_kab')}}";
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
        
        var kecamatan = {!! $kedatangan->kecamatan?:0 !!};
        var url =  "{{ route('kedatangan_get_kecamatan')}}";
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
    function getDesa() {
    $(document).ready(function() {
        
        var desa = {!! $kedatangan->desa?:0 !!};
        var url =  "{{ route('kedatangan_get_desa')}}";
        $.ajax({
            url : url,
            type : "GET",
            data: {     
                nmKecamatan: $('select[name=nmKecamatan]').val(),
            },
            dataType : "json",
            success:function(data)
            {
            $('select[name="nmDesa"]').empty();
            $('select[name="nmDesa"]').append('<option value="">- Pilih -</option>');
            $.each(data, function(key,value){
                    
                    $('select[name="nmDesa"]').append(
                        '<option value="'+ data[key].id +'" ' + (desa == data[key].id ? 'selected' : false) + '>'+ data[key].nama +'</option>');
                        
            });
            $("#nmDesa").change(); 
            }
        });

    });  
};
</script>

<script>
    function getPekerjaan() {
    $(document).ready(function() {
        
        var pekerjaan = {!! $kedatangan->pekerjaan?:0 !!};
        var url =  "{{ route('kedatangan_get_pekerjaan')}}";
        $.ajax({
            url : url,
            type : "GET",
            data: {     
                nmSektor: $('select[name=nmSektor]').val(),
            },
            dataType : "json",
            success:function(data)
            {
            $('select[name="nmPekerjaan"]').empty();
            $('select[name="nmPekerjaan"]').append('<option value="">- Pilih -</option>');
            $.each(data, function(key,value){
                    
                    $('select[name="nmPekerjaan"]').append(
                        '<option value="'+ data[key].jenis_id +'" ' + (pekerjaan == data[key].jenis_id ? 'selected' : false) + '>'+ data[key].name +'</option>');
                        
            });
            $("#nmPekerjaan").change(); 
            }
        });

    });  
};
</script>

<script>
     function masaKerja() {
    var tglDatang = new Date($('#nmTglBerangkat').val());
    var tglBerangkat = new Date($('#nmTglDatang').val());
    var tahun = tglBerangkat.getFullYear() - tglDatang.getFullYear();
    var bulan = tglBerangkat.getMonth() - tglDatang.getMonth();
    
    if (bulan < 0 || (bulan === 0 && tglBerangkat.getDate() < tglDatang.getDate())) {
        tahun--;
        
    }
    var month = bulan;
    if(month < 0){
        month = bulan + 12;
    }
    var year = tahun;
    if(year < 0){
        year = 0;
    }
    $('#nmMasaKerja').val(year  + "/" +  month);
    }

</script>