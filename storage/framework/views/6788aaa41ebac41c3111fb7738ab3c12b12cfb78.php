<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Starter Kit')); ?></title>

        <!-- Fonts -->
        

        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo e(asset('/css/app.css')); ?>">

        <!-- Scripts -->
        
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <?php echo e($slot); ?>

        </div>


        
        <script src="<?php echo e(asset('/livewire/livewire/dist/livewire.js')); ?>"></script>

        
        <?php echo $__env->make('custom/livewire/script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/layouts/guest.blade.php ENDPATH**/ ?>