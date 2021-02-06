<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <?php echo $__env->yieldContent('tombol-baru'); ?>
                    <table id="dt-direktori" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15" style="width:30%;">Nama
                                    <?php if($tipe === "blk"): ?> BLK <?php elseif($tipe === "disnaker"): ?> Dinas
                                    <?php elseif($tipe === "p3mi"): ?> P3MI <?php else: ?> KBRI <?php endif; ?>
                                </th>
                                <th class="font-15" style="width:23%;">Alamat</th>
                                <th class="font-15" style="width:22%;">Kontak</th>
                                <th class="font-15">Tampil</th>
                                <th class="font-15"><?php if($tipe === "blk"): ?> Legal <?php else: ?> Valid <?php endif; ?></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/direktori/content.blade.php ENDPATH**/ ?>