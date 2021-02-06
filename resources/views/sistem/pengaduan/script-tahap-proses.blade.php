<script>

    $(document).ready(function(){
    
    var count = 1;
        
    $(document).on('click', '.addFileProses', function(){
    //   <input type="text" value="0" name="nmIdEdit[]" id="nmProdukEdit'+count+'">
    count++;
    var html = '';
    html += '<tr>';
    html += '<td class="pl-2 py-2"><input type="hidden" value="0" name="cekEditBaruProses[]"><input id="nmFileTahapProses'+count+'" name="nmFileTahapProses[]" type="file" class="h-45 form-control border-form bg-form" onchange="cekSize();"></td>';
    html += '<td class="py-2 text-center"><a name="removeFileProses" class="text-danger removeFileProses ml-0" style="cursor:pointer;"> <i class="fas fa-times font-20"></i></a></td></tr>';
    $('#table_proses').append(html);
//   $('#item_unit').select2({
    $('select').select2({
                width: '100%'
                //theme: "bootstrap"
            });
            
        });
        
    });
    

    $(document).on('click', '.removeFileProses', function(){
        var hapusFileProses = $(this);
        var idHapusFileProses = $(this).closest('tr').find('.nmIdEditProses').val();
        hapusFileProses.closest('tr').remove();
    });

    $(document).on('click', '.removeFileProsesEdit', function(){
        var hapusFileProses = $(this);
        var idHapusFileProses = $(this).closest('tr').find('.nmIdEditProses').val();

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
            hapusFileProses.closest('tr').remove();
                // alert(id_hapus);
                var hapus_file_proses = '';
                hapus_file_proses += '<tr>';   
                hapus_file_proses += '<td><input type="text" value="'+idHapusFileProses+'" name="nmHapusFileProses[]" ></td></tr>';
                $('#tabel_hapus_proses').append(hapus_file_proses);
        
            }
        });
    });


    function cekSize() {
        $(document).ready(function() {
            var total = 0;
            $('#table_proses > tbody  > tr').each(function() {
            
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

