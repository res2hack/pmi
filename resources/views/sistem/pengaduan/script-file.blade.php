<script>

    $(document).ready(function(){
     
    var count =  {{ count($file_krono) }} ;    
        
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



{{-- <script>
    $('body').on('click', '#btn-fileKrono', function (event) {
    event.preventDefault();
    
    var me = $(this),
        url = me.attr('href'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    
    // var fd = new FormData();
    var nmFileKrono = $('input[name^="nmFileKrono[]"]').map(function(){ 
                return this.value; 
            }).get();

    fd.append('file',files[0]);
    swal.fire({
        title: 'Anda ingin mengunggah lampiran ?',
        text: 'Lampiran akan diunggah',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#9557da',
        cancelButtonColor: '#6a687d',
        confirmButtonText: 'Ya, Proses!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    'nmFileKrono[]': nmFileKrono,
                    '_method': 'PUT',
                    '_token': csrf_token
                },
            //    dataType: 'json',
              
                //or this
                beforeSend: function() {
                    swal_ajax('load');
                },

                success: function (response) {
                    console.log(nmFileKrono);
                    
                    swal.fire({
                        icon: 'success',
                        title: 'Mengirimkan Data',
                        text: 'Data Telah Dikirimkan'
                    })
                    
                },
                error: function (xhr) {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi Kesalahan'
                    });
                }
            });
        }
    });
    });

    function swal_ajax(type) {
    switch (type) {
        case 'load':
            swal.fire({
               title: 'Mengunggah Data',
                html: 'Harap Menunggu...',
                timer: 2000,
                timerProgressBar: true,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            });
            break;
       
    }
}
</script> --}}

