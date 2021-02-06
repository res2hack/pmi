 

<?php $__env->startSection('title'); ?>
Kelola Data Master Bandara
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Master Data Bandara</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Bandara</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Bandara</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-md-4">
        <form method="POST" action="<?php echo e(route('master_store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card shadow border-top5 border-form ">
                <div class="card-body mt-0 pb-1 ">

                    <input type="hidden" name="nmStatus" value="baru">
                    <input type="hidden" name="nmRedirect" value="back">
                    <input type="hidden" name="nmJenisKategori" value="m_bandara">

                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Kode Bandara</div>
                        <input type="text" name="nmKode" class="form-control font-weight-500 h-42 bg-form border-form">
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Nama Bandara</div>
                        <textarea name="nmName" class="form-control font-weight-500 
                                    bg-form border-form" rows="3" required></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmName')); ?></small>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="nmJoin1" value="m_negara">
                        <?php 
                            use Illuminate\Support\Facades\DB;
                            $negara = DB::table('master_kategori_line')->select('jenis_id', 'name')
                                    ->where('jenis', 'm_negara')->get();
                        ?>
                        <div class="font-weight-bold font-16 mb-1 text-dark">Negara</div>
                        <select name="nmJoin1_ID" id="nmJoin1_ID" class="form-control selectric" style="font-size:16px;" >
                            <?php $__currentLoopData = $negara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($x->jenis_id); ?>"><?php echo e($x->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Kota</div>
                        <input type="text" name="nmTag1" class="form-control font-weight-500 h-42 bg-form border-form">
                    </div>
                </div>
                <div class="card-footer border-top mt-2 py-3">
                    <button type="submit" class="btn btn-lg btn-dark">
                        <i class="fas fa-check mr-2 font-14"></i>
                        <span class="font-16"> Tambah</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <table id="dt-master" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">Nama Bandara</th>
                                <th class="font-15">Negara</th>
                                <th></th>
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
    <?php echo $__env->make('sistem.master.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <?php echo $__env->make('sistem.master.bandara.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/master/bandara/index.blade.php ENDPATH**/ ?>