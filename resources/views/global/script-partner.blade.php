<script>
    function cekNik(){
        $(document).ready(function() {

        let nik = $("input[name=nmNIK]").val(); 
        let cek_nik;
        $.ajax({
                type : "GET",
                url :"{{ route('partner_cek_nik')}}",
                data: {  
                    nmNIK: nik,
                },
                dataType : "json",
                success:function(data)
                {
                    cek_nik = data[0];
                    if(cek_nik !== null){
                        swal.fire({
                            icon: 'error',
                            title: 'Duplikat Data',
                            text: 'Penduduk Dengan NIK Ini Sudah Ada Dalam Sistem'
                        });
                        $('.btnproses').hide();
                    }
                    else{
                        $('.btnproses').show();
                    }
                },
                error:function(err){
                    console.log(err);
                },
            });
        });
    }
</script>

<script>
    function cekBpjs(){
        $(document).ready(function() {

        let bpjs = $("input[name=nmBPJS]").val(); 
        let cek_bpjs;
        $.ajax({
                type : "GET",
                url :"{{ route('partner_cek_bpjs')}}",
                data: {  
                    nmBPJS: bpjs,
                },
                dataType : "json",
                success:function(data)
                {
                    cek_bpjs = data[0];
                    if(cek_bpjs !== null){
                        swal.fire({
                            icon: 'error',
                            title: 'Duplikat Data',
                            text: 'Penduduk Dengan No. BPJS Ini Sudah Ada Dalam Sistem'
                        });
                        $('.btnproses').hide();
                    }
                    else{
                        $('.btnproses').show();
                    }
                },
                error:function(err){
                    console.log(err);
                },
            });
        });
    }
</script>