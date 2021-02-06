<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta property="og:locale" content="id_id" />
    <?php echo $__env->yieldContent('meta'); ?>

    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Preloader -->
    <style>
        @keyframes  hidePreloader {
            0% {
                width: 100%;
                height: 100%;
            }

            100% {
                width: 0;
                height: 0;
            }
        }

        body>div.preloader {
            position: fixed;
            background: white;
            width: 100%;
            height: 100%;
            z-index: 1071;
            opacity: 0;
            transition: opacity .5s ease;
            overflow: hidden;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.loaded)>div.preloader {
            opacity: 1;
        }

        body:not(.loaded) {
            overflow: hidden;
        }

        body.loaded>div.preloader {
            animation: hidePreloader .5s linear .5s forwards;
        }
    </style>
    
    <?php echo $__env->yieldContent('style'); ?>

    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector('body').classList.add('loaded');
            }, 300);
        });
    </script>
    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('theme/frontend/assets/img/brand/favicon.png')); ?>" type="image/png"><!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('theme/assets/font-awesome/font-awesome-5.15/all.min.css')); ?>">
    <!-- Quick CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('theme/frontend/assets/libs/bootstrap/dist/css/bootstrap.min.css')); ?>" id="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('theme/frontend/assets/css/quick-website.css')); ?>" id="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('theme/frontend/assets/css/styleku.css')); ?>" id="stylesheet">
    <?php echo $__env->yieldContent('style'); ?>
</head>

<body>

    
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-cookies" data-backdrop="false" aria-labelledby="modal-cookies" aria-hidden="true">
        <div class="modal-dialog modal-dialog-aside left-4 right-4 bottom-4">
            <div class="modal-content bg-dark-dark">
                <div class="modal-body">
                    <!-- Text -->
                    <p class="text-sm text-white mb-3">
                        We use cookies so that our themes work for you. By using our website, you agree to our use of cookies.
                    </p>
                    <!-- Buttons -->
                    <a href="pages/utility/terms.html" class="btn btn-sm btn-white" target="_blank">Learn more</a>
                    <button type="button" class="btn btn-sm btn-primary mr-2" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img alt="Image placeholder" src="<?php echo e(asset('theme/frontend/assets/img/brand/logo.png')); ?>" id="navbar-logo" class="h-100">
            </a>
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mt-4 mt-lg-0 ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link text-primary" href="<?php echo e(route('home')); ?>">Depan</a>
                    </li>
                    <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                        <a class="nav-link text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profil<i class="fas fa-angle-down ml-3"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-single">
                            <a href="<?php echo e(url('p/profil-upt')); ?>" class="dropdown-item">UPT</a>
                            <a href="<?php echo e(url('p/visi-misi')); ?>" class="dropdown-item">Visi Misi</a>
                            <a href="<?php echo e(url('p/tupoksi')); ?>" class="dropdown-item">Tupoksi</a>
                            <!-- <div class="dropdown-divider"></div>
                            <a href="login.html" class="dropdown-item">Login</a> -->
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-primary" href="<?php echo e(route('post_portal')); ?>">Berita & Artikel</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-primary" href="<?php echo e(route('pengumuman_front')); ?>">Pengumuman</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-primary" href="docs/index.html">Galeri</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-primary" href="docs/index.html">Kontak</a>
                    </li>
                    <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                        <a class="nav-link text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Link<i class="fas fa-angle-down ml-3"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-single">
                            <a href="http://disnakertrans.jatimprov.go.id/" class="dropdown-item">Disnakertrans Jatim</a>
                            <a href="https://sipp.menpan.go.id/" class="dropdown-item">SIPP Menpan</a>
                            <a href="https://www.lapor.go.id/" class="dropdown-item">Lapor.go.id</a>
                            <div class="dropdown-divider"></div>
                            <a href="http://p3tki-jatim.go.id/simpadupmi/" class="dropdown-item" title="Pengajuan Surat Jalan PMI">Pengajuan SJ PMI</a>
                            <a href="login.html" class="dropdown-item" title="Download Aplikasi Emergency Call">Aplikasi Emergency Call</a>
                        </div>
                    </li>
                </ul>
                <!-- Button -->
                <!-- <a class="navbar-btn btn btn-sm btn-primary d-none d-lg-inline-block ml-3" href="https://github.com/webpixels/quick-website-ui-kit-demo/archive/master.zip">
                    Download Free
                </a> -->
                <!-- Mobile button -->
                <!-- <div class="d-lg-none text-center">
                    <a href="https://webpixels.io/themes/quick-website-ui-kit" class="btn btn-block btn-sm btn-warning">See more details</a>
                </div> -->
            </div>
        </div>
    </nav>


    <?php echo $__env->yieldContent('content'); ?>


    
    <footer class="position-relative" id="footer-main">
        <div class="footer pt-lg-7 footer-dark bg-light-dark">
            <!-- SVG shape -->
            <div class="shape-container shape-line shape-position-top shape-orientation-inverse">
                <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve">
                    <polygon points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
            <!-- Footer -->
            <div class="container pt-4">
                <div class="row">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <!-- Theme's logo -->
                        <!-- <a href="index.html">
                            <img alt="Image placeholder" src="<?php echo e(asset('theme/frontend/assets/img/brand/light.svg')); ?>" id="footer-logo">
                        </a> -->
                        <!-- Webpixels' mission -->
                        <h5 class="text-white pr-lg-4">UPT-P3TKI Dinaskertrans JATIM</h5>
                        <p class="text-sm opacity-8 pr-lg-4">Jl. Bendul Merisi No.2, Jagir, Kec. Wonokromo, Kota Surabaya, Jawa Timur 60244.</p>
                        <div class="font-12"><i class="fas fa-phone mr-2"></i> (031) 99842200, 99842221</div>
                        <div class="font-12"><i class="fas fa-envelope mr-2"></i> tkijatim@gmail.com</div>
                        <!-- Social -->
                        <ul class="nav mt-4">
                            <li class="nav-item">
                                <a class="nav-link pl-0" href="#" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
                        <h6 class="heading mb-3">Menu</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Profil</a></li>
                            <li><a href="#">Berita & Artikel</a></li>
                            <li><a href="#">Pengumuman</a></li>
                            <li><a href="#">Galeri</a></li>
                            <li><a href="#">Kontak</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3">Link</h6>
                        <ul class="list-unstyled">
                            <li><a href="http://disnakertrans.jatimprov.go.id/">Disnakertrans Jatim</a></li>
                            <li><a href="https://kemnaker.go.id/">Kemnaker</a></li>
                            <li><a href="https://www.lapor.go.id/" class="dropdown-item">Lapor.go.id</a></li>
                            <li><a href="https://sipp.menpan.go.id/" class="dropdown-item">SIPP Menpan</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3">Aplikasi</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Simpadu</a></li>
                            <li><a href="#">Simpadu PMI</a></li>
                            <li><a href="#">Simdarat</a></li>
                            <li><a href="#">Emergency Call</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="divider divider-fade divider-dark my-4">
                <div class="row align-items-center justify-content-md-between pb-4">
                    <div class="col-md-6">
                        <div class="copyright text-sm font-weight-bold text-center text-md-left">
                            &copy; 2020 <a href="#" class="font-weight-bold" target="_blank">UPT-P3TKI Jatim</a>. All rights reserved
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Terms
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Privacy
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Cookies
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="<?php echo e(asset('theme/frontend/assets/libs/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/frontend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('theme/frontend/assets/libs/svg-injector/dist/svg-injector.min.js')); ?>"></script>
    
    <!-- Quick JS -->
    <script src="<?php echo e(asset('theme/frontend/assets/js/quick-website.js')); ?>"></script>

    <?php echo $__env->yieldContent('script'); ?>

</body>

</html><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/layouts-front/base.blade.php ENDPATH**/ ?>