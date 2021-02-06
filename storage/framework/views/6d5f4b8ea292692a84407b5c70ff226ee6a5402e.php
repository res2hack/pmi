


<?php $__env->startSection('meta'); ?>
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Prodesmigratif - <?php echo e($prodesmigratif->judul); ?> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<!-- Main content -->
<section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h2 class="text-info">Prodesmigratif</h2>
                <h3 class="text-white my-4 mx-2 font-weight-900" style="line-height:1.2;">
                    <?php echo e($prodesmigratif->judul); ?>

                </h3>
            </div>
        </div>
    </div>
</section>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-10 text-justify mx-auto">
                <div class="row">
                    <div class="col-md-4 img-fluid">
                        <img class="mr-3 avatar w-100 h-100" src="<?php echo e(url($prodesmigratif->img_featured)); ?>" >
                    </div>
                    <div class="col-md-8">
                        <table>
                            <tr class="align-top">
                                <td style="width:25%;" class="font-weight-800">Nama Usaha</td>
                                <td style="width:5%;" class="font-weight-800">:</td>
                                <td class="font-weight-600 text-primary"><?php echo e($prodesmigratif->judul); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-800">Kategori</td>
                                <td class="font-weight-800">:</td>
                                <td class="font-weight-700 text-success"><?php echo e($prodesmigratif->kategori); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-800">Pemilik</td>
                                <td class="font-weight-800">:</td>
                                <td  class="font-weight-700"><?php echo e($prodesmigratif->pemilik); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-800">Kontak</td>
                                <td class="font-weight-800">:</td>
                                <td><?php echo e($prodesmigratif->kontak); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-800">Alamat</td>
                                <td class="font-weight-800">:</td>
                                <td><?php echo e($prodesmigratif->alamat); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="border-bottom">Deskripsi</h5>
                        <?php echo $prodesmigratif->keterangan; ?>

                    </div>
                </div>
                

                <div class="text-center mt-5">
                    <a href="<?php echo e(route('prodesmigratif_front')); ?>" class="btn btn-secondary btn-lg">
                        Kembali ke Prodesmigratif
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts-front.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/prodesmigratif/show.blade.php ENDPATH**/ ?>