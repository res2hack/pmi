 

<?php if(auth()->user()->hasRole(['superadmin', 'admin']) || auth()->user()->can(['pelatihan'])): ?>

<?php $__env->startSection('title'); ?>
Kelola Program Pelatihan - Ubah <?php echo e($pelatihan->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

    <?php echo $__env->make('global.custom-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-diagnoses font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Program Pelatihan</h4> 
            <span class="ml-2 font-11 font-weight-bold bg-primary 
                rounded text-white align-top py-1 px-2">Ubah
            </span>
        </div>
            
        <span class="font-weight-bold">Ubah Data Pelatihan</span>
        <i class="mx-2 fas fa-caret-right"></i>
        <span class="font-weight-500 text-primary"><?php echo e($pelatihan->name); ?></span> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pelatihan_index')); ?>"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pelatihan_detail', $pelatihan->id)); ?>"><u><?php echo e($pelatihan->name); ?></u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Ubah</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('pelatihan_update')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmTipe" value="edit">
<input type="hidden" name="nmID" value="<?php echo e($pelatihan->id); ?>">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6 pb-0 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Program</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmPelatihan" name="nmPelatihan" 
                            class="form-control h-45 border-form bg-form text-form font-weight-500" 
                            value="<?php echo e($pelatihan->name); ?><?php echo e(old('nmPelatihan')); ?>">
                        <small class="text-danger"><?php echo e($errors->first('nmPelatihan')); ?></small>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kejuruan</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmKejuruan" id="nmKejuruan" class="form-control select2 w-100">
                                <?php $__currentLoopData = $kejuruan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <optgroup label="<?php echo e($x->name); ?>">
                                        <?php $__currentLoopData = $sub_kejuruan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($y->join1_id == $x->jenis_id): ?>
                                            <option value="<?php echo e($x->jenis_id); ?>|<?php echo e($y->jenis_id); ?>"
                                                <?php if($y->jenis_id === $pelatihan->sub_kejuruan_id): ?> selected <?php endif; ?>>
                                                <?php echo e($y->name); ?>

                                            </option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </optgroup>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Sumber Dana</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmSumberDana" id="nmSumberDana" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $sumber_dana; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sd->jenis_id); ?>" 
                                        <?php if($sd->jenis_id === $pelatihan->sumber_dana_id): ?> selected <?php endif; ?>>
                                        <?php echo e($sd->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Anggaran</div>
                    <div class="col-md-9">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-form-tua border-form font-weight-bold">Rp</div>
                            </div>
                            <input type="text" id="nmAnggaran" name="nmAnggaran"  onchange="formatUang();"
                                class="form-control h-45 border-form bg-form text-form font-weight-500" 
                                value="<?php echo e($pelatihan->anggaran); ?>">
                        </div>
    
                        <small class="text-danger"><?php echo e($errors->first('nmAnggaran')); ?></small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                        <span class="font-15 font-weight-bold text-dark">Metode</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Pelatihan</span>
                    </div>
                    <div class="col-md-9">
                        <select name="nmMetode" id="nmMetode" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $metode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $met): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($met->jenis_id); ?>" 
                                    <?php if($met->jenis_id === $pelatihan->metode_pelatihan_id): ?> selected <?php endif; ?>>
                                    <?php echo e($met->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">Kuota</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Peserta</span>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group mb-2">
                            <div class="input-group mb-2">
                                <input type="number" id="nmKuota" name="nmKuota"  value="<?php echo e($pelatihan->kuota_peserta); ?>"
                                    class="form-control h-45 border-form bg-form text-form font-weight-500">
                                <div class="input-group-append">
                                    <div class="input-group-text border-form bg-form-tua text-dark font-weight-500">Peserta</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="col-md-6">
                
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Total Jam</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Pelajaran</span>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group mb-2">
                            <div class="input-group mb-2">
                                <input type="number" id="nmJamPelajaran" name="nmJamPelajaran"  value="<?php echo e($pelatihan->jam_pelajaran); ?>"
                                    class="form-control h-45 border-form bg-form text-form font-weight-500">
                                <div class="input-group-append">
                                  <div class="input-group-text border-form bg-form-tua text-dark font-weight-500">Jam</div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
               
               
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Tanggal</span>
                        <br>
                        <span class="font-13 text-success font-weight-500">Mulai</span>
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglMulai" name="nmTglMulai" 
                        class="form-control h-45 border-form bg-form text-form font-weight-500" 
                        value="<?php echo e($pelatihan->tgl_mulai); ?><?php echo e(old('nmTglMulai')); ?>">
                       
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Tanggal</span>
                        <br>
                        <span class="font-13 text-danger font-weight-500">Selesai</span>
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglSelesai" name="nmTglSelesai" 
                            class="form-control h-45 border-form bg-form text-form font-weight-500" 
                            value="<?php echo e($pelatihan->tgl_selesai); ?><?php echo e(old('nmTglSelesai')); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class=" font-weight-bold font-15 text-dark">Keterangan</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">(Deskripsi)</span>
                    </div>
                    <div class="col-md-9">
                        <textarea id="nmKeterangan" name="nmKeterangan" rows="3"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"><?php echo e($pelatihan->keterangan); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmKeterangan')); ?></small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                        <span class="font-15 font-weight-bold text-dark">Status</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Pelatihan</span>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmStatusPelatihan" id="nmStatusPelatihan" 
                                    onchange="statusPendaftaran();"
                                    class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                <option value="batal" <?php if($pelatihan->status_pelatihan === "batal"): ?> selected <?php endif; ?>>Batal</option>
                                <option value="draft" <?php if($pelatihan->status_pelatihan === "draft"): ?> selected <?php endif; ?>>Draft</option>
                                <option value="valid" <?php if($pelatihan->status_pelatihan === "valid"): ?> selected <?php endif; ?>>Valid</option>
                                <option value="selesai" <?php if($pelatihan->status_pelatihan === "selesai"): ?> selected <?php endif; ?>>Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="statusPendaftaran" style="display:none;">
                    <div class="form-group row">
                        <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">
                            <span class="font-15 font-weight-bold text-dark">Tipe</span>
                            <br>
                            <span class="font-13 text-primary font-weight-500">Pendaftaran</span>
                        </div>
                        <div class="col-md-9 mt-1">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdTerbuka" name="nmTipePendaftaran" class="custom-control-input" value="terbuka" >
                                <label class="custom-control-label font-weight-bold" for="rdTerbuka" style="cursor:pointer;">Terbuka</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdTertutup" name="nmTipePendaftaran" class="custom-control-input" value="tertutup" checked>
                                <label class="custom-control-label font-weight-bold" for="rdTertutup" style="cursor:pointer;">Tertutup</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">
                            <span class="font-15 font-weight-bold text-dark">Status</span>
                            <br>
                            <span class="font-13 text-primary font-weight-500">Pendaftaran</span>
                        </div>
                        <div class="col-md-9 mt-1">
                            <div class="custom-control custom-radio custom-control-inline" id="rdCekBuka">
                                <input type="radio" id="rdBuka" name="nmStatusPendaftaran" class="custom-control-input" value="buka" >
                                <label class="custom-control-label font-weight-bold" for="rdBuka" style="cursor:pointer;">Buka</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline" id="rdCekTutup">
                                <input type="radio" id="rdTutup" name="nmStatusPendaftaran" class="custom-control-input" value="tutup" checked>
                                <label class="custom-control-label font-weight-bold" for="rdTutup" style="cursor:pointer;">Tutup</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="font-weight-500 font-12">
                            <ul>
                                <li style="line-height:16px;">
                                <span class="text-success">Tipe Pendaftaran Terbuka: </span>User Yang Memiliki Akses Login Sistem Bisa Melakukan Pendaftaran Mandiri.</li>
                                <li class="mt-2" style="line-height:16px;">
                                    Status Pendaftaran akan <span class="text-danger">"Tutup"</span> Otomatis Jika Status Pelatihan 
                                    <span class="text-dark">Batal, Draft,</span> ataupun <span class="text-dark">Selesai</span>.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark">
            <span class="font-15"><i class="fas fa-check mr-2"></i>Perbarui</span>
        </button>
    </div>
</div>

</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('theme/assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>

<script>
    function formatUang() {
        $(document).ready(function() {
            $('#nmAnggaran').val($('#nmAnggaran').val().toString().replace(".","").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
        });
    }
</script>
<script>
    window.onload = function() {
   formatUang();
   $('#nmStatusPelatihan').trigger('change');
    };
</script>
<script>
    function statusPendaftaran(){
        $status_pelatihan = $('#nmStatusPelatihan').val();
        $status_pendaftaran = '<?php echo e($pelatihan->status_pendaftaran); ?>';

        if($status_pelatihan == "valid" || $status_pelatihan == "selesai"){
            $('#statusPendaftaran').show();
        }else{
            $('#statusPendaftaran').hide();
        }
        if($status_pelatihan == "selesai")
        {
            $('#rdCekBuka').hide();
            $('#rdTutup').prop("checked", "checked");
            // alert($status_pelatihan);
        }
        else{
            $('#rdCekBuka').show();
             if($status_pendaftaran == "buka"){
                $('#rdBuka').prop("checked", "checked"); 
            }
           
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php else: ?>
    <?php echo $__env->make('global.dilarang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/edit.blade.php ENDPATH**/ ?>