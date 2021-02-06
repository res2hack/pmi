 

<?php $__env->startSection('title'); ?>
Pendaftaran Peserta Pelatihan -  <?php echo e($pelatihan->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php echo $__env->make('sistem.pelatihan.style-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-friends font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Pelatihan - Pendaftaran Peserta</h4> 
            <span class="ml-2 font-11 bg-primary rounded text-white 
                align-top py-1 px-2 font-weight-bold ">Detail
            </span>
        </div>
            
        <span class="font-weight-bold">Pendaftaran Peserta</span>
        <i class="mx-2 fas fa-caret-right"></i>
        <span class="font-weight-500">
            <a href="<?php echo e(route('pelatihan_detail', $pelatihan->id)); ?>"><?php echo e($pelatihan->name); ?></a></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pelatihan_detail', $pelatihan->id)); ?>"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pendaftaran_index')); ?>"><u>Pendaftaran</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark"><?php echo e($pelatihan->name); ?></span>
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
                    <?php if($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai"): ?>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo e(route('pelatihan_penerimaan_detail', $pelatihan->id)); ?>"
                            class="font-weight-bold text-white" title="Proses Penerimaan Pendaftar">
                            <u class="font-14"><i class="fas fa-user-check mr-2"></i>Proses Penerimaan</u>
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
                                <?php if($pelatihan->jml_peserta > 0 && ($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai")): ?>
                                <a href="<?php echo e(route('pelatihan_kelulusan_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Kelulusan Peserta"><i class="fas fa-caret-right font-14 mx-2"></i>Kelulusan 
                                </a>
                                <a href="<?php echo e(route('pelatihan_sertifikasi_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Sertifikasi"><i class="fas fa-caret-right font-14 mx-2"></i>Sertifikasi 
                                </a>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 pt-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kejuruan</div>
            <div class="py-2 col-9 pt-3">
                <span class="text-dark font-weight-bold font-14"><?php echo e($sub_kejuruan); ?> (<?php echo e($kejuruan); ?>)</span>   
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Durasi</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pelatihan->jam_pelajaran); ?> Jam <span class="mx-2">/</span> Kuota: <?php echo e($pelatihan->kuota_peserta); ?> Peserta
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jadwal</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-primary">
                <?php echo e(\Carbon\Carbon::parse($pelatihan->tgl_mulai)->format('d-m-Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($pelatihan->tgl_selesai)->format('d-m-Y')); ?>

            </div>
        </div>
        <div class="form-group row  m-0 ">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jumlah Pendaftar</div>
            <div class="py-2 col-9 font-weight-bold text-primary">
                <div id="jmlPendaftar">Loading Data...</div> 
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

        <?php if($pelatihan->status_pelatihan === "valid"): ?> 
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pendaftaran
            </div>
            <div class="py-2 col-9">
                <span class="<?php if($pelatihan->status_pendaftaran === "tutup"): ?> bg-danger 
                    <?php else: ?> bg-success <?php endif; ?>
                    px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">
                    <?php if($pelatihan->status_pendaftaran === "tutup"): ?>
                        <i class="fas fa-lock mr-1 font-11"></i>
                    <?php else: ?>
                        <i class="fas fa-lock-open mr-1 font-11"></i>
                    <?php endif; ?>
                    <?php echo e($pelatihan->status_pendaftaran); ?>

                </span>

                <?php if($pelatihan->status_pelatihan === "valid"): ?>
                    <span class="ml-3">
                        <?php if($pelatihan->status_pendaftaran === "buka"): ?>
                        <a href="#" class="text-danger"
                            data-toggle="modal" data-target="#modalUbahStatus" 
                            onclick="$('#idUbahStatus').val(<?php echo e($pelatihan->id); ?>);" title="Tutup Kolom Tanya Jawab">
                            <u class="font-14"><i class="fas fa-lock mr-1"></i> Tutup Pendaftaran
                            </u>
                        </a>
                        <?php else: ?>
                            <a href="#" class="text-success"
                                data-toggle="modal" data-target="#modalUbahStatus" 
                                onclick="$('#idUbahStatus').val(<?php echo e($pelatihan->id); ?>);" title="Buka Kolom Tanya Jawab">
                                <u class="font-14"><i class="fas fa-lock-open mr-1"></i> Buka Pendaftaran
                                </u>
                            </a>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        

        <?php if($pelatihan->status_pelatihan === "valid" || $pelatihan->status_pelatihan === "selesai"): ?>
        <div id="dataKosong" class="text-center">
            <p class="mt-3 font-15 font-weight-bold">
                <?php if($pelatihan->jml_pendaftar > 0): ?>
                    Loading Data...
                <?php else: ?>
                    Belum Ada Pendaftar
                <?php endif; ?>
            </p>
            <?php if($pelatihan->status_pendaftaran === "buka" && $pelatihan->jml_pendaftar < 1): ?>
            <a href="" class="btn btn-primary font-14 py-2 mr-2" 
                title="Pendaftaran Peserta Baru" data-toggle="modal" data-target="#modalDaftar">
                <i class="fas fa-plus mr-2"></i>Peserta Baru
            </a>
            <?php endif; ?>
        </div>
        <div id="dataIsi" class="mt-3 table-responsive" style="display:none;">
            <div class="float-left font-weight-bold">
                <div class="pt-2">
                    <i class="fas fa-user-friends text-dark font-12 align-middle mr-2"></i> 
                    <span class="text-dark text-ungu font-18 align-middle">Detail Pendaftar</span>
                </div> 
            </div>
            <?php if($pelatihan->status_pelatihan === "valid" && $pelatihan->status_pendaftaran === "buka"): ?>
                <div class="float-right">
                    <a href="" class="btn btn-primary font-14 py-2" 
                        title="Pendaftaran Peserta Baru" data-toggle="modal" data-target="#modalDaftar">
                        <i class="fas fa-plus mr-2"></i>Peserta Baru
                    </a>
                </div>
            <?php endif; ?>
            <table id="dt-pendaftaran" class="table  w-100">
                <thead>
                    <tr>
                        <th class="py-2" style="width:5%;">#</th>
                        <th class="py-2 font-15">Nama</th>
                        <th class="py-2 font-15 ">NIK</th>
                        <th class="py-2 font-15 ">JK</th>
                        <th class="py-2 font-15">Alamat</th>
                        <th class="py-2 font-15 ">Tgl. Daftar</th>
                        <th class="py-2 font-15 ">No. Daftar</th>
                        <th class="py-2" style="width:10%;">
                            <?php if($pelatihan->status_pelatihan === "selesai"): ?>
                                Diterima
                            <?php endif; ?>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        <?php else: ?>
            <h5 class="mt-5 text-center">Pendaftaran Tidak Bisa Dilakukan 
                Sebelum Status Pelatihan = <strong class="text-ungu">Valid</strong></h5>
            <h6 class="mt-2 font-weight-normal text-center">Tinjau detail Pelatihan dan lakukan validasi 
                <a href="<?php echo e(route('pelatihan_detail', $pelatihan->id)); ?>"><u>di sini</u></a></h6>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('sistem.pelatihan.pendaftaran.modal-daftar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('sistem.pelatihan.pendaftaran.modal-edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('sistem.pelatihan.pendaftaran.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>

<?php echo $__env->make('sistem.pelatihan.pendaftaran.detail-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sistem.pelatihan.pendaftaran.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
     setTimeout(function(){ 
        jumlahPendaftar();
        dataPendaftar();
    }, 1000);
</script>
<script>
    function beriLogin() {
    var checkBox = document.getElementById("cbBeriLogin");
    if (checkBox.checked == true){
        $('#detailLogin').show();
        cekUsername();
        cekEmail();
    } else {
        $('#detailLogin').hide();
        $('#btn-simpan').prop('disabled', false);
    }
}
</script>

<?php echo $__env->make('global.script-partner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/pendaftaran/detail.blade.php ENDPATH**/ ?>