<script>

    $(document).ready(function(){
     
    var count =  <?php echo e(count($file_krono)); ?> ;    
        
     $(document).on('click', '.addFile', function(){
    //   <input type="text" value="0" name="nmIdEdit[]" id="nmProdukEdit'+count+'">
      count++;
      var html = '';
      html += '<tr>';
      html += '<td class="pl-2 py-2"><input type="hidden" value="0" name="cekEditBaruFile[]"><input id="nmFileKrono'+count+'" name="nmFileKrono[]" type="file" class="h-45 form-control border-form bg-form" onchange="cekSize();"></td>';
      html += '<td class="py-2 text-center"><a name="removeFile" class="text-danger removeFile " style="cursor:pointer;"> <i class="fas fa-times font-20"></i></a></td></tr>';
      $('#table_lampiran').append(html);
    //   $('#item_unit').select2({
      $('select').select2({
                width: '100%'
                //theme: "bootstrap"
            });
            
        });
        
     });
     

     $(document).on('click', '.removeFile', function(){
        var hapusFile = $(this);
        var idHapusFile = $(this).closest('tr').find('.nmIdEditFile').val();
        hapusFile.closest('tr').remove();
        // alert(id_hapus);
        // var hapus_file = '';
        // hapus_file += '<tr>';   
        // hapus_file += '<td><input type="text" value="'+idHapusFile+'" name="nmHapusFileKrono[]" ></td></tr>';
        // $('#tabel_hapus_krono').append(hapus_file);
       
    });

    $(document).on('click', '.removeFileEdit', function(){
        var hapusFile = $(this);
        var idHapusFile = $(this).closest('tr').find('.nmIdEditFile').val();

        swal.fire({
        title: 'Anda Yakin Ingin Menghapus Lampiran Ini?',
        text: 'Lampiran akan dihapus',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#9557da',
        cancelButtonColor: '#6a687d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
       
            hapusFile.closest('tr').remove();
                // alert(id_hapus);
                var hapus_file = '';
                hapus_file += '<tr>';   
                hapus_file += '<td><input type="text" value="'+idHapusFile+'" name="nmHapusFileKrono[]" ></td></tr>';
                $('#tabel_hapus_krono').append(hapus_file);
        
            }
        });
    });


    function cekSize() {
        $(document).ready(function() {
            var total = 0;
            $('#table_lampiran > tbody  > tr').each(function() {
               
                $(':file').each(function() {    
                    if (this.files && this.files[0]) {
                    total = this.files[0].size;
                    }
                    if(total > 2100000){
                        this.value = "";
                    }
                });

                if(total > 2030000){
                    // alert('Ukuran File Terlalu Besar. Max: 2MB.');
                swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Maks 2 MB Setiap File'
                    });
            }

            });
           
           
        });
    }

</script>





<?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pengaduan/script-file.blade.php ENDPATH**/ ?>