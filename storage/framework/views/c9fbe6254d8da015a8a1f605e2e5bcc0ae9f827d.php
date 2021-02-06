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
            url: '<?php echo e(route('partner_get_penduduk')); ?>',
            dataType: 'json',
            type: "get",
            quietMillis: 50,
            data: function(term) {
                return {
                    term: term.term
                };
                
            }, 
            processResults: function (data) {
                return {
                    results: data
                };
            },
            success:function(data)
            {
            
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

        var url =  "<?php echo e(route('lamaran_get_kab')); ?>";
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
        
        var kecamatan = '';
        var url =  "<?php echo e(route('lamaran_get_kecamatan')); ?>";
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
<?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/lamaran/script.blade.php ENDPATH**/ ?>