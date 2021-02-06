<script>

    $(document).ready(function(){
    
    var count = 1;
        
    $(document).on('click', '.addFileFoto', function(){
        //   <input type="text" value="0" name="nmIdEdit[]" id="nmProdukEdit'+count+'">
        count++;
        var html = '';
        html += '<tr>';
        html += '<td class="py-2"><input type="hidden" value="0" name="cekEditBaruFoto[]"><input id="nmFileTahapFoto'+count+'" name="nmFileTahapFoto[]" type="file" class="h-45 form-control border-form bg-form" onchange="cekSize();"></td>';
        html += '<td class="py-2 text-center"><a name="removeFileFoto" class="text-danger removeFileFoto ml-0" style="cursor:pointer;"> <i class="fas fa-times font-20"></i></a></td></tr>';
        $('#table_foto').append(html);

            
        });
        
    });
    

    $(document).on('click', '.removeFileFoto', function(){
        var hapusFileFoto = $(this);
        var idHapusFileFoto = $(this).closest('tr').find('.nmIdEditFoto').val();
        hapusFileFoto.closest('tr').remove();
    });

    $(document).on('click', '.removeFileFotoEdit', function(){
        var hapusFileFoto = $(this);
        var idHapusFileFoto = $(this).closest('tr').find('.nmIdEditFoto').val();

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
            hapusFileFoto.closest('tr').remove();
                // alert(id_hapus);
                var hapus_file_foto = '';
                hapus_file_foto += '<tr>';   
                hapus_file_foto += '<td><input type="text" value="'+idHapusFileFoto+'" name="nmHapusFileFoto[]" ></td></tr>';
                $('#tabel_hapus_foto').append(hapus_file_foto);
        
            }
        });
    });


    function cekSize() {
        $(document).ready(function() {
            var total = 0;
            $('#table_foto > tbody  > tr').each(function() {
            
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

