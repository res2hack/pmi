<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/select2/dist/css/select2.min.css')); ?>">
<style>
    .dropdown-toggle::after {
    display: none !important;
}
.dropleft .dropdown-toggle::before {
    display: none !important;
    }
.table:not(.table-sm) thead th {
    background-color: #d2ddfd;
    color: #242425;
}
.table td{
    vertical-align: unset;
    padding-top: 5px;
    padding-bottom:5px;
}
.section {
    position: relative;
    z-index: unset;
}
</style>
<?php echo $__env->make('global.custom-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/style-detail.blade.php ENDPATH**/ ?>