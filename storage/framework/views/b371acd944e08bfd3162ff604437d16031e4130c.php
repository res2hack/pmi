 

<?php $__env->startSection('title'); ?>
Kelola Data Jadwal Kedatangan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
    }
    .selectric{
        background-color: #F5F3FF;
        border-color: #C4B5FD;
        font-weight:500;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Jadwal Kedatangan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Jadwal Kedatangan</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Jadwal Kedatangan</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <div class="float-left form-group row mb-2">
                        <div class="col-6 mr-2">
                            <select name="nmBulan" id="nmBulan" onchange="getKedatangan();" class="form-control
                            bg-form font-15 rounded font-weight-bold" style="width:120px;">
                            <?php $__currentLoopData = $bulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                            <option value="<?php echo e('0' . $x->jenis_id); ?>" 
                                    <?php if(now()->format('m') == '0' . $x->jenis_id): ?> selected <?php endif; ?> >
                                <?php echo e($x->name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>

                        <div class="col-4 px-2">
                            <?php $years = []; 
                                for ($year= 2015; $year <= now()->year ; $year++) 
                                $years[$year] = $year;
                            ?>
                            <select id="nmTahun" name="nmTahun" onchange="getKedatangan();" class="form-control 
                                bg-form font-15 rounded font-weight-bold" style="width:80px;">

                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
                                <option class="font-weight-bold" value="<?php echo e($tahun); ?>" 
                                    <?php if(now()->format('Y') == $tahun): ?> selected <?php endif; ?>>

                                    <?php echo e($tahun); ?>

                                </option>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="float-right ml-2">
                        <a href="<?php echo e(route('kedatangan_create')); ?>" class="btn btn-primary font-15 py-2" title="Buat Data Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                    </div>
                    <table id="dt-master" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">Nama TKI</th>
                                <th class="font-15" style="width:25%;">No. Paspor</th>
                                <th class="font-15" style="width:15%;">J. Kedatangan</th>
                                <th class="font-15" style="width:15%;">Sts. Pulang</th>
                                <th style="width:10%;"></th>
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
    <?php echo $__env->make('sistem.kedatangan.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <?php echo $__env->make('sistem.kedatangan.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        setTimeout(function()
        { 
            getKedatangan();
        }, 1000);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/kedatangan/index.blade.php ENDPATH**/ ?>