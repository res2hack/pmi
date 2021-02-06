 

<?php $__env->startSection('title'); ?>
Kelola Data Lamaran
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php echo $__env->make('global.custom-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-id-card font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Lamaran</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">
                Indeks
            </span>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Lamaran</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="p-3 mb-4 border border-form rounded shadow">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mt-2 text-right font-weight-bold text-dark font-15">Lowongan (SIP)</div>
                        </div>
                        <div class="col-md-10">
                            <select id="nmLowongan" name="nmLowongan" onchange="getLamaran();" class="d-inline form-control select2">
                                
                                <?php $__currentLoopData = $lowongan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $low): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($low->id); ?>" selected>
                                        (<?php echo e($low->jabatan); ?> - <?php echo e($low->negara); ?>) - <?php echo e($low->agency); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-2 table-responsive ">
                    <div class="float-left mr-2">
                        <a href="<?php echo e(route('lamaran_create')); ?>" class="btn btn-primary font-15 py-2" title="Buat Data Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                    </div>
                    <table id="dt-pelamar" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-14">Nama</th>
                                <th class="font-14">Pendidikan</th>
                                <th class="font-14">Tgl. Registrasi</th>
                                <th class="font-13 text-center">Kompetensi</th>
                                <th class="font-13 text-center">Sehat</th>
                                <th class="font-13 text-center">Dokumen</th>
                                <th style="width:8%;"></th>
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
    <?php echo $__env->make('sistem.lamaran.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>
    <?php echo $__env->make('sistem.lamaran.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
         setTimeout(function()
        { 
            $("#nmLowongan").trigger('change');
        }, 500);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/sistem/lamaran/index.blade.php ENDPATH**/ ?>