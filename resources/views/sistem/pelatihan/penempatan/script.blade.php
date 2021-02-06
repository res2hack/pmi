
<script>
    $('#selectAll1').click(function(){
        $('td .cbClassSertifikasi' ).prop('checked', this.checked)
    });
    $('#selectAll2').click(function(){
        $('td .cbClassKompeten' ).prop('checked', this.checked)
    });
    function KlikUbah() {
    $(document).ready(function() {
            $('.ubahData').show();
            $('.dataAwal').hide();
            // $('#dt-penempatan').find('input, select').attr('disabled', false);
        }); 
    };
    function KlikBatal() {
        $(document).ready(function() {
            $('.ubahData').hide();
            $('.dataAwal').show();
            // $('#dt-penempatan').find('input, select').attr('disabled','disabled');
        }); 
    };  
</script>

<script>
    function successToast() {
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
        });
        Toast1.fire({
            icon: 'success',
            html: '<span class="font-weight-500 ml-3 text-white">Penempatan Peserta Diperbarui</span>',
            background: '#47c363',
            width: 300
        });
    });
}
</script>

