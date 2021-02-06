<script>

    $(document).ready(function(){
      
    var count = 1;
        
     $(document).on('click', '.addFileAwal', function(){
    //   <input type="text" value="0" name="nmIdEdit[]" id="nmProdukEdit'+count+'">
      count++;
      var html = '';
      html += '<tr>';
      html += '<td class="pl-2 py-2"><input type="hidden" value="0" name="cekEditBaruAwal[]"><input id="nmFileTahapAwal'+count+'" name="nmFileTahapAwal[]" type="file" class="h-45 form-control border-form bg-form" onchange="cekSize();"></td>';
      html += '<td class="py-2 text-center"><a name="removeFileAwal" class="text-danger removeFileAwal ml-0" style="cursor:pointer;"> <i class="fas fa-times font-20"></i></a></td></tr>';
      $('#table_awal').append(html);
    //   $('#item_unit').select2({
      $('select').select2({
                width: '100%'
                //theme: "bootstrap"
            });
            
        });
        
     });
     

     $(document).on('click', '.removeFileAwal', function(){
        var hapusFileAwal = $(this);
        var idHapusFileAwal = $(this).closest('tr').find('.nmIdEditAwal').val();
        hapusFileAwal.closest('tr').remove();
       
    });

    $(document).on('click', '.removeFileAwalEdit', function(){
        var hapusFileAwal = $(this);
        var idHapusFileAwal = $(this).closest('tr').find('.nmIdEditAwal').val();

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
       
            hapusFileAwal.closest('tr').remove();
                // alert(id_hapus);
                var hapus_file_awal = '';
                hapus_file_awal += '<tr>';   
                hapus_file_awal += '<td><input type="text" value="'+idHapusFileAwal+'" name="nmHapusFileAwal[]" ></td></tr>';
                $('#tabel_hapus_awal').append(hapus_file_awal);
        
            }
        });
    });


    function cekSize() {
        $(document).ready(function() {
            var total = 0;
            $('#table_awal > tbody  > tr').each(function() {
               
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

<?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pengaduan/script-tahap-awal.blade.php ENDPATH**/ ?>