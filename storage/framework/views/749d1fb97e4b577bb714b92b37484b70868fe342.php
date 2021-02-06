<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <i class="far fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

        </div>
    </div>
<?php endif; ?>

<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        Ada Kesalahan - Data Tidak Bisa Disimpan
        </div>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <i class="far fa-check-circle mr-2"></i> <?php echo e(session('error')); ?>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/global/notifikasi.blade.php ENDPATH**/ ?>