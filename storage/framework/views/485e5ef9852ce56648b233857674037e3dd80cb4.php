 

<?php $__env->startSection('title'); ?>
Kelulusan Peserta Pelatihan - <?php echo e($pelatihan->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php echo $__env->make('sistem.pelatihan.style-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-check-circle font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Pelatihan - Kelulusan Peserta</h4> 
            <span class="ml-2 font-11 bg-primary rounded text-white 
            align-top py-1 px-2 font-weight-bold ">Detail
        </span>
        </div>
            
        <span class="font-weight-bold">Kelulusan Peserta</span>
        <i class="mx-2 fas fa-caret-right"></i>
        <span class="font-weight-500 text-primary">
            <a href="<?php echo e(route('pelatihan_detail', $pelatihan->id)); ?>"><?php echo e($pelatihan->name); ?></a>
        </span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pelatihan_detail', $pelatihan->id)); ?>"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('kelulusan_index')); ?>"><u>Kelulusan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Detail</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<input type="hidden" name="nmIDpelatihan" value="<?php echo e($pelatihan->id); ?>">
<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        
        <div class="form-group row mb-0 mx-0">
            <div class="col-12 py-3 bg-detail">
                <div class="row">
                    <div class="col-md-6">
                        <span class="font-15 text-uppercase font-weight-bold bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-diagnoses font-14 mr-2 text-white"></i>  <?php echo e($pelatihan->name); ?>

                        </span>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo e(route('pelatihan_sertifikasi_detail', $pelatihan->id)); ?>" 
                            class="font-weight-bold text-white" title="Proses Kelulusan Peserta Pelatihan">
                            <u class="font-14"><i class="fas fa-clipboard-check mr-2"></i>Proses Sertifikasi</u>
                        </a>
                        <div class="btn-group dropleft ml-3 " title="Menu Lainnya">
                            <a type="button" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v text-white"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="<?php echo e(route('pelatihan_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Detail Pelatihan" target="_blank">
                                    <i class="fas fa-diagnoses font-14 mx-2"></i>Detail Pelatihan 
                                </a>
                                <a href="<?php echo e(route('pelatihan_penerimaan_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Kembali Ke Penerimaan Peserta"><i class="fas fa-caret-left font-14 mx-2"></i>Penerimaan 
                                </a>
                                <a href="<?php echo e(route('pelatihan_pendaftaran_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Pendaftaran Peserta"><i class="fas fa-caret-left font-14 mx-2"></i>Pendaftaran 
                                </a>
                                <?php if($pelatihan->jml_peserta > 0 && ($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai")): ?>
                                
                                <a href="<?php echo e(route('pelatihan_penempatan_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Penempatan"><i class="fas fa-caret-right font-14 mx-2"></i>Penempatan 
                                </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('pelatihan_create')); ?>" class="text-success dropdown-item" 
                                    title="Buat Program Pelatihan Baru"><i class="fas fa-plus mr-2 font-12"></i>Pelatihan Baru 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 pt-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kejuruan</div>
            <div class="py-2 col-9 pt-3">
                <span class="text-dark font-weight-bold font-14"><?php echo e($sub_kejuruan); ?> (<?php echo e($kejuruan); ?>)</span>   
            </div>
        </div>
        <div class="form-group row  m-0 ">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pelatihan
            </div>
            <div class="py-2 col-9 font-weight-bold text-primary">
                <span class="<?php if($pelatihan->status_pelatihan === "valid"): ?> bg-ungu 
                    <?php elseif($pelatihan->status_pelatihan === "selesai"): ?> bg-success
                    <?php elseif($pelatihan->status_pelatihan === "draft"): ?> bg-warning
                    <?php elseif($pelatihan->status_pelatihan === "batal"): ?> bg-danger <?php endif; ?>
                    px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">

                    <?php if($pelatihan->status_pelatihan === "valid"): ?>
                        <i class="fas fa-check mr-1 font-11"></i>
                    <?php elseif($pelatihan->status_pelatihan === "selesai"): ?>
                        <i class="far fa-check-circle mr-1 font-11"></i>
                       
                    <?php endif; ?>
                    <?php echo e($pelatihan->status_pelatihan); ?>

                </span>
            </div> 
        </div>

        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Durasi</div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                <?php echo e($pelatihan->jam_pelajaran); ?> Jam 
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jadwal</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-primary">
                <?php echo e(\Carbon\Carbon::parse($pelatihan->tgl_mulai)->format('d-m-Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($pelatihan->tgl_selesai)->format('d-m-Y')); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jumlah Peserta</div>
            <div class="py-2 col-9 font-weight-bold text-primary">
                <span id="jmlPeserta" class="text-primary">0 Orang</span>
                <span id="jmlDetailPeserta" class="text-dark"></span> 
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jumlah Kelulusan</div>
            <div class="py-2 col-9 font-weight-bold text-primary">
                <span id="jmlLulus" class="text-primary">0 Peserta</span>
                <span id="jmlDetailLulus" class="text-dark"></span> 
            </div>
        </div>
        <?php if($pelatihan->status_pelatihan === "valid"): ?>
        <div class="form-group row m-0">
            <div class="py-3 col-3 bg-light3 border-right"></div>
            <div class="py-3 col-9 bg-light3">
                <a data-toggle="modal" data-target="#modalSelesai"  title="Update Status Pelatihan Menjadi Selesai" 
                    class="btn btn-success text-white" style="cursor:pointer;"> 
                        <i class="far fa-check-circle mr-2"></i>Pelatihan Selesai
                </a>
            </div>
        </div>
        <?php endif; ?>

        <div class="row mt-2"></div>

        <form method="POST" action="<?php echo e(route('pelatihan_kelulusan_update')); ?>" id="formKelulusan">
        <?php echo csrf_field(); ?>
            <div id="" class="mt-3 table-responsive">
                <div class="float-left font-weight-bold">
                    <div class="pt-2">
                        <i class="far fa-check-circle text-dark font-14 align-middle mr-2"></i> 
                        <span class="text-dark text-ungu font-18 align-middle">Kelulusan Peserta</span>
                    </div> 
                </div>

                <?php if($pelatihan->status_pelatihan === "valid"): ?>
                <div class="float-right">
                    <a id="btnUbah" onclick="KlikUbah();" 
                        class="iconStatus btn btn-primary text-white font-14 py-2" 
                        title="Ubah Kelulusan Peserta" style="cursor:pointer;">
                        <i class="fas fa-edit mr-2"></i>Ubah Kelulusan
                    </a>
                    <a id="btnBatal" onclick="KlikBatal();" 
                        class="ubahCheckbox btn btn-secondary text-dark font-14 py-2" 
                        title="Batal" style="cursor:pointer;display:none;">
                        <i class="fas fa-times"></i>
                    </a>
                    <a class="btnSimpan ubahCheckbox btn btn-dark text-white font-14 py-2 ml-2" 
                        title="Batal" style="cursor:pointer;display:none;">
                        <i class="fas fa-check mr-2"></i>Simpan
                    </a>
                </div>
                <?php endif; ?>

                <table id="dt-kelulusan" class="table  w-100">
                    <thead>
                        <tr>
                            <th class="py-2" style="width:5%;">#</th>
                            <th class="py-2 font-14">Nama</th>
                            <th class="py-2 font-14 ">NIK</th>
                            <th class="py-2 font-14 ">JK</th>
                            <th class="py-2 font-14">Alamat</th>
                            <th class="py-2 font-14 ">Tgl. Daftar</th>
                            <th class="py-2 font-14 ">No. Daftar</th>
                            <th class="py-2 font-14" style="width:5%;">
                                <span class="iconStatus">Lulus</span>
                                <div class="text-center">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label for="selectAll" class="ubahCheckbox custom-control-label font-14 
                                        font-weight-500 align-top text-primary" style="cursor:pointer;display:none;"></label>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>

                <?php if($pelatihan->status_pelatihan === "valid"): ?>
                <div class="float-right">
                    <a id="btnUbah" onclick="KlikUbah();" 
                        class="iconStatus btn btn-primary text-white font-14 py-2" 
                        title="Ubah Kelulusan Peserta" style="cursor:pointer;">
                        <i class="fas fa-edit mr-2"></i>Ubah Kelulusan
                    </a>
                    <a id="btnBatal" onclick="KlikBatal();" 
                        class="ubahCheckbox btn btn-secondary text-dark font-14 py-2" 
                        title="Batal" style="cursor:pointer;display:none;">
                        <i class="fas fa-times"></i>
                    </a>
                    <a class="btnSimpan ubahCheckbox btn btn-dark text-white font-14 py-2 ml-2" 
                    title="Batal" style="cursor:pointer;display:none;">
                    <i class="fas fa-check mr-2"></i>Simpan
                </a>
                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<?php echo $__env->make('sistem.pelatihan.modal-selesai', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>

<?php echo $__env->make('sistem.pelatihan.kelulusan.detail-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('sistem.pelatihan.kelulusan.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script>
     setTimeout(function(){ 
        jumlahPendaftar();
        dataPendaftar();
    }, 1000);
</script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/kelulusan/detail.blade.php ENDPATH**/ ?>