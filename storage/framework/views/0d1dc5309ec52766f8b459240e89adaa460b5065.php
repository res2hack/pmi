 

<?php $__env->startSection('title'); ?>
Kelola Data Perusahaan - Ubah Data
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php echo $__env->make('global.custom-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-house-user font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Perusahaan</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold 
                    rounded text-white align-top py-1 px-2">Ubah</span>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('perusahaan_index')); ?>"><u>Perusahaan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('perusahaan_detail', $perusahaan->id)); ?>"><u><?php echo e($perusahaan->nama); ?></u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Ubah Data</span>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('perusahaan_update', $perusahaan->id)); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmTipe" value="edit">
<input type="hidden" name="idPerusahaan" value="<?php echo e($perusahaan->id); ?>">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-7 pb-0 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-weight-500 text-primary">Perusahaan</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmPerusahaan" name="nmPerusahaan" 
                        class="form-control h-45 border-form bg-form text-form font-weight-500" 
                        value="<?php echo e($perusahaan->nama); ?> <?php echo e(old('nmPerusahaan')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmPerusahaan')); ?></small>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                    <textarea id="nmAlamat" name="nmAlamat" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"><?php echo e($perusahaan->alamat); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmAlamat')); ?></small>
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Provinsi</div>
                    <div class="col-md-9">
                        <select name="nmProvinsi" id="nmProvinsi" onchange="getKota();" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $provinsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prov->id); ?>" <?php if($prov->id === $perusahaan->provinsi_id): ?> selected <?php endif; ?>>
                                    <?php echo e($prov->nama); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kab. / Kota</div>
                    <div class="col-md-9">
                        <select name="nmKabKota" id="nmKabKota" onchange="getKecamatan();" class="form-control select2 w-100">
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kecamatan</div>
                    <div class="col-md-9">
                        <select name="nmKecamatan" id="nmKecamatan" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Kontak / Telp.</div>
                    <div class="col-md-8">
                        <textarea id="nmTelp" name="nmTelp" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"><?php echo e($perusahaan->contact_telp); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmTelp')); ?></small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">WhatsApp (WA)</div>
                    <div class="col-md-8">
                        <textarea id="nmWhatsapp" name="nmWhatsapp" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-500"><?php echo e($perusahaan->contact_wa); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmWhatsapp')); ?></small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Email</div>
                    <div class="col-md-8">
                        <input type="email" id="nmEmail" name="nmEmail"  value="<?php echo e($perusahaan->email); ?>"
                        class="form-control h-45 border-form bg-form text-form font-weight-500" 
                        value="<?php echo e(old('nmEmail')); ?>">
                        <small class="text-danger"><?php echo e($errors->first('nmEmail')); ?></small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <span class=" font-weight-bold font-15 text-dark">CP</span>
                        <br>
                        <span class="font-weight-500 text-primary">Contact Person</span>
                    </div>
                    <div class="col-md-8">
                        <textarea id="nmCP" name="nmCP" rows="2" <?php echo e($perusahaan->contact_nama); ?>

                        class="form-control h-45 border-form bg-form text-form font-weight-500"></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmCP')); ?></small>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-2 mt-2  mb-2" style="margin-right:-20px;">
                <div class="font-15 font-weight-bold text-dark">Profil</div> 
                <div class="font-14 font-weight-500 text-primary">Perusahaan</div>
            </div>
            <div class="col-md-10">
                <textarea id="summernote" name="nmProfil" class="summernote"><?php echo $perusahaan->profil; ?></textarea>
                <div class="mt-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" onclick="beriLogin();"
                            id="cbBeriLogin" name="nmBeriLogin" <?php if($user): ?> checked <?php endif; ?>>
                        <label for="cbBeriLogin" class="custom-control-label font-14 font-weight-500 align-top text-primary" style="cursor:pointer;">
                            Beri Hak Akses Login Sistem
                        </label>
                        <?php if($user): ?>
                            <br><span class="text-dark font-12">Pengguna ini memiliki hak akses login sistem. </span>
                            <span class="font-12">
                                Jika anda memperbarui data dengan kondisi <u class="text-danger">tidak dicentang</u>, 
                                maka detail login sebelumnya akan dihapus (Hak akses login dicabut).
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        <div id="detailLogin" <?php if(!$user): ?> style="display:none;" <?php endif; ?> >
            <div class="border-top2-dashed mt-3 border-form"></div>
            <div class="row mt-4 mb-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-md-6">
                            <h5 class="mb-3 text-ungu">
                                <i class="fas fa-user-shield mr-2 align-middle"></i>Detail Login
                            </h5>
                            <div class="border border-form shadow p-4 rounded">
                                <div class="form-group row">
                                    <label class="col-md-4 mt-2 font-weight-bold font-15">
                                        Username <i id="usernameSuccess" class="ml-2 font-18 far fa-check-circle text-success" style="display:none;"></i>
                                    </label>
                                    <div class="col-md-8">
                                        <input name="nmUsername" type="text" class="form-control font-weight-500 bg-form border-form text-form h-42" onchange="cekUsername();" 
                                        value="<?php if($user): ?><?php echo e($user->username); ?><?php endif; ?><?php echo e(old('nmUsername')); ?>">

                                        <span id="usernameError" class="font-12 text-danger font-weight-bold" 
                                                style="display:none;">* Username ini sudah digunakan</span>
                                        <small class="text-danger font-weight-bold"><?php echo e($errors->first('nmUsername')); ?></small>
                                        <input id="nmUsernameFake" type="hidden" name="nmUsernameFake" value="<?php if($user): ?><?php echo e($user->username); ?><?php endif; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 mt-2 font-weight-bold font-15">
                                        Email <i id="emailSuccess" class="ml-2 font-18 far fa-check-circle text-success" style="display:none;"></i>
                                    </label>
                                    <div class="col-md-8">
                                        <input name="nmEmailLogin" type="email" class="form-control font-weight-500 bg-form 
                                            border-form text-form h-42" value="<?php if($user): ?><?php echo e($user->email); ?><?php endif; ?><?php echo e(old('Email')); ?>" onchange="cekEmail();">
                                        
                                        <span id="emailError" class="font-12 text-danger font-weight-bold" style="display:none;">* Email ini sudah digunakan</span>
                                        <span id="formatError" class="font-12 text-danger font-weight-bold" style="display:none;">* Format Email Salah</span>
                                        <small class="text-danger font-weight-bold"><?php echo e($errors->first('nmEmailLogin')); ?></small>
                                        <input id="nmEmailLoginFake" type="hidden" name="nmEmailLoginFake" value="<?php if($user): ?><?php echo e($user->email); ?><?php endif; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 mt-2 font-weight-bold font-15">Password</label>
                                    <div class="col-md-8">
                                        <input name="nmPassword" type="text" class="form-control font-weight-500 bg-form border-form text-form h-42" 
                                                value="<?php if($user): ?><?php echo e($user->sct); ?><?php endif; ?><?php echo e(old('password')); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-2 font-weight-bold font-15">Status</label>
                                    <div class="col-md-8">
                                        <select name="nmStatusAktif" id="nmStatusAktif" class="form-control selectric" style="font-size:16px;" >
                                            <option value="pending" <?php if($user): ?> <?php if($user->status === "pending"): ?> selected <?php endif; ?> <?php endif; ?>>Ditunda</option>
                                            <option value="active" <?php if($user): ?> <?php if($user->status === "active"): ?> selected <?php endif; ?> <?php endif; ?>>Diterima (Aktif)</option>
                                            <option value="banned" <?php if($user): ?> <?php if($user->status === "banned"): ?> selected <?php endif; ?> <?php endif; ?>>Dilarang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            
                        </div>
                        
                    </div>
                    
                </div>
    
            </div>
        </div>
        
    </div>
    <div class="card-footer text-center border-top">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark">
            <span class="font-15"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>

</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>


<?php echo $__env->make('sistem.perusahaan.script-edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    setTimeout(function()
    { 
        getKota();
        getKecamatan();
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

<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    var table3 =  $('#datatable3').DataTable( {
            paging: false,
            });
        
        table3.on( 'order.dt search.dt', function () {
            table3.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
            } );
        } ).draw();
</script>
<script src="<?php echo e(asset('theme/assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/summernote/dist/summernote-bs4.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>

<script>
    $('#summernote').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 200
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/perusahaan/edit.blade.php ENDPATH**/ ?>