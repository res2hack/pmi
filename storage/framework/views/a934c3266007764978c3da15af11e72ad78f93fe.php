<?php if(session('respon')): ?>
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
    <i class="far fa-check-circle mr-2"></i> <?php echo e(session('respon')); ?>

    </div>
</div>
<?php endif; ?>

<?php if(count($respon) > 0): ?> 
<div class="card border shadow">
<div class="card-body">
    <div class="row">
        <div class="col-md-7">
            <h4>
                Tanggapan
                <?php if($pengaduan->status_respon === "open"): ?>
                    <span class="bg-success px-2 py-1 text-white align-top ml-2 rounded font-13 font-weight-500">Open</span>
                <?php else: ?>
                    <span class="bg-dark px-2 py-1 text-white align-top ml-2 rounded font-13 font-weight-500">Closed</span>
                <?php endif; ?>
            </h4>
        </div>
        <div class="col-md-5 text-right">
            <?php if($pengaduan->status_respon === "open"): ?>
                <a href="#" class="text-primary"
                    data-toggle="modal" data-target="#modalResponStatus" 
                    onclick="$('#idRespon').val(<?php echo e($pengaduan->id); ?>);" title="Tutup Kolom Tanya Jawab">
                    <span class="font-14"><i class="fas fas fa-lock mr-1"></i> Tutup Kolom Diskusi
                    </span>
                </a>
            <?php else: ?>
                <a href="#" class="text-primary"
                    data-toggle="modal" data-target="#modalResponStatus" 
                    onclick="$('#idRespon').val(<?php echo e($pengaduan->id); ?>);" title="Buka Kolom Tanya Jawab">
                    <span class="font-14"><i class="fas fas fa-lock-open mr-1"></i> Buka Kolom Diskusi
                    </span>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="border-top mb-3"></div>
    <table id="dt-respon" class="w-100">
        <thead>
            <th></th>
        </thead>
        <?php $__currentLoopData = $respon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                
                <div class="card shadow mb-3 <?php if($res->user_id !== Auth::user()->id ): ?> ml-5 <?php endif; ?>">
                    <div class="card-body border rounded">
                        <div class="font-13 font-weight-500
                            <?php if($res->user_id !== Auth::user()->id ): ?> text-primary <?php else: ?> text-success <?php endif; ?>">
                            <?php echo e($res->username); ?> - <?php echo e($res->create_date); ?>


                            <?php if(!$res->delete_date): ?>
                                <div class="float-right">
                                    <a href="#" class="text-danger"
                                        data-toggle="modal" data-target="#modalResponHapus" 
                                        onclick="$('#nmIdResponHapus').val(<?php echo e($res->id_respon); ?>);" title="Hapus Komentar">
                                        <i class="fas fas fa-times font-14"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if(!$res->delete_date): ?>
                            <div class="text-dark font-14 mt-2"> <?php echo e($res->respon); ?></div>
                        <?php else: ?>
                        <div class="text-dark text-center font-14 mt-2 font-weight-500"> Tanggapan Dihapus</div>
                        <?php endif; ?>
                    </div>
                </div>
                
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>
</div>

<?php else: ?>
<h5 class="mb-4">Belum Ada Respon</h5>
<?php endif; ?>


<?php if($pengaduan->status_respon === "open" || Auth::user()->tipe === "staf"): ?>



<form method="post" action="<?php echo e(route('pengaduan_respon')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<input type="hidden" name="nmIdPengaduan" value="<?php echo e($pengaduan->id); ?>">

        <textarea id="nmRespon" name="nmRespon" rows="4" placeholder="Beri Tanggapan Baru.."
        class="form-control bg-form border-form"><?php echo e(old('nmRespon')); ?></textarea>

        <button type="submit" class="btn btn-lg btn-dark mt-3">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Beri Tanggapan</span>
        </button>
    
</form>
<?php endif; ?><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/sistem/pengaduan/respon.blade.php ENDPATH**/ ?>