 

<?php if(Auth::user()->tipe == "staf" && (auth()->user()->hasRole(['superadmin', 'admin']) || auth()->user()->can(['pelatihan']))): ?>

<?php $__env->startSection('title'); ?>
Kelola Program Pelatihan - Indeks
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
    <div class="row">
        <div class="col-1 my-auto">
            <i class="fas fa-diagnoses font-24"></i>
        </div>
        <div class="col-11">
            <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Program Pelatihan</h4> 
                <span class="ml-2 font-11 bg-primary rounded 
                    font-weight-bold text-white align-top py-1 px-2">Indeks</span></div>
            <span class="font-weight-bold">Daftar Program Pelatihan</span>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
    <i class="fas fa-angle-right mx-2"></i>
    <span class="font-weight-bold text-dark">Pelatihan</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <div class="float-left mr-2">
                        <?php $years = []; 
                                for ($year= 2020; $year <= now()->year ; $year++) 
                                $years[$year] = $year;
                            ?>
                            <select id="nmTahun" name="nmTahun" onchange="getPelatihan();" class="form-control 
                                bg-form border-form font-15 rounded font-weight-bold" style="width:135px;">

                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
                                <option class="font-weight-bold" value="<?php echo e($tahun); ?>" 
                                    <?php if(now()->format('Y') == $tahun): ?> selected <?php endif; ?>>

                                    Periode: <?php echo e($tahun); ?>

                                </option>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                    </div>
                    <div class="float-right ml-2">
                        <a href="<?php echo e(route('pelatihan_create')); ?>" class="btn btn-primary font-15 py-2" title="Buat Data Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                    </div>
                    <table id="dt-pelatihan" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">Nama Program</th>
                                <th class="font-15">Jadwal</th>
                                <th class="font-15">Kejuruan</th>
                                <th class="font-15">Anggaran</th>
                                <th class="font-15">Status</th>
                                <th style="width:5%;"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('sistem.pelatihan.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <?php echo $__env->make('sistem.pelatihan.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        setTimeout(function()
        { 
            getPelatihan();
        }, 500);
    </script>
<?php $__env->stopSection(); ?>

<?php else: ?>
    <?php echo $__env->make('global.dilarang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/index.blade.php ENDPATH**/ ?>