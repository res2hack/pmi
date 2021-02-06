<script>
    function getKota() {
    $(document).ready(function() {
        
        var kota = <?php echo $lamaran_first->kabupaten_id?:0; ?>;

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
        
        var kecamatan = <?php echo $lamaran_first->kecamatan_id?:0; ?>;
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
<?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/lamaran/script-edit.blade.php ENDPATH**/ ?>