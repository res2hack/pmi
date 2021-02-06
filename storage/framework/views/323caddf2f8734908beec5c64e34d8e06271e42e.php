<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title'); ?></title>

<link rel="stylesheet" href="<?php echo e(asset('theme/assets/dropzone/dist/min/dropzone.min.css')); ?>">
<!-- General CSS Files -->
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/bootstrap/dist/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('theme/assets/font-awesome/font-awesome-5.15/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/selectric/public/selectric.css')); ?>">


<!-- Template CSS -->
<link rel="stylesheet" href="<?php echo e(asset('theme/assets/css/components.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('theme/assets/css/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('theme/assets/css/styleku.css')); ?>">


<?php echo $__env->yieldContent('style'); ?>

</head>

<body>
    
    <div id="app">
        <div class="main-wrapper">
            <?php echo $__env->make('layouts.part-admin.1-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layouts.part-admin.2-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layouts.part-admin.3-body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layouts.part-admin.4-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <!-- General JS Scripts -->
    
    <script src="<?php echo e(asset('theme/node_modules/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/node_modules/popper.js/dist/popper-work.min.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/node_modules/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/node_modules/selectric/public/jquery.selectric.min.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/node_modules/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/assets/js/stisla.js')); ?>"></script>
    

    <!-- Template JS File -->
    <script src="<?php echo e(asset('theme/assets/js/scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/assets/js/custom.js')); ?>"></script>

    <!-- Page Specific JS File -->
    <?php echo $__env->yieldContent('script'); ?>

    </body>
</html>
<?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/layouts/admin.blade.php ENDPATH**/ ?>