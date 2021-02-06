<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand ">
            <a href="<?php echo e(route('dashboard')); ?>" class="font-24 font-weight-bold"><span class="text-capitalize text-white">
                <i class="fas fa-seedling font-16 mr-3 text-biru-muda"></i>Simpadu</span></a>
        </div>
        
        <div class="sidebar-brand sidebar-brand-sm text-center">
            <a href="<?php echo e(route('dashboard')); ?>" ><i class="fas fa-seedling font-24 text-biru-muda align-middle"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item <?php echo e((request()->is('admin/dashboard')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/user*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e((request()->is('admin/user/index*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('user_index')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-user-check ml-0 mr-1"></i>Pengguna</a></li>
                    <li class="<?php echo e((request()->is('admin/user/roles*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('role_index')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-user-shield ml-0 mr-1"></i>Role</a></li>
                    <li class="<?php echo e((request()->is('admin/user/permissions*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('permission_index')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-shield-alt ml-0 mr-1"></i>Permissions</a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="menu-header text-biru-muda">Sistem</li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/master*')) ? 'active' : '' || (request()->is('admin/mst*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-folder-open"></i><span>Master</span></a>
                <ul class="dropdown-menu">
                    
                    <li class="nav-item <?php echo e((request()->is('admin/master/pendidikan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'pendidikan')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pendidikan</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/sektor*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'sektor')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Sektor</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/pekerjaan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'pekerjaan')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pekerjaan</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/mst/jabatan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('jabatan_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Jabatan</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/kategori-konsultasi*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'kategori-konsultasi')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kategori Konsultasi</span></a></li>
                    <li class="nav-item px-auto "><a><div class="border-top border-secondary w-100"></div></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/masalah*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'masalah')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Masalah</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/jenis-pulang*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'jenis-pulang')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Jenis Pulang</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/negara*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'negara')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Negara</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/bandara*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'bandara')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Bandara</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/pesawat*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'pesawat')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pesawat</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/master/imigrasi*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('master_index', 'imigrasi')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Imigrasi</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/mst/pengirim*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('pengirim_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pengirim</span></a></li>
                    <li class="nav-item px-auto "><a><div class="border-top border-secondary w-100"></div></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/mst/provinsi*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('provinsi_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Provinsi</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/mst/kabkota*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('kabkota_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kabupaten</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/mst/kecamatan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('kecamatan_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kecamatan</span></a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/direktori*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-folder"></i><span>Direktori</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item <?php echo e((request()->is('admin/direktori/disnaker*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('disnaker_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Disnaker</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/direktori/blk*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('blk_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>BLK</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/direktori/kbri*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('kbri_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>KBRI</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/direktori/p3mi*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('p3mi_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>P3MI</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/direktori/lsp*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('lsp_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>LSP</span></a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item <?php echo e((request()->is('admin/perusahaan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('perusahaan_index')); ?>"><i class="fas fa-house-user"></i><span>Data Perusahaan</span></a></li>
            <li class="nav-item <?php echo e((request()->is('admin/penduduk*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('partner_index')); ?>"><i class="fas fa-user-friends"></i><span>Data Penduduk</span></a></li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/sip*') || request()->is('admin/lamaran*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-clipboard-list"></i><span>Lowongan</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item <?php echo e((request()->is('admin/sip*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('sip_index')); ?>"><i class="fas fa-clipboard-list"></i> <span>lowongan (SIP)</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/lamaran*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('lamaran_index')); ?>"><i class="far fa-id-card"></i> <span>Lamaran</span></a></li>
                    
                    <li><a></a></li>
                </ul>
            </li>
            
            <li class="nav-item dropdown <?php echo e((request()->is('admin/pelatihan*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-diagnoses"></i><span>Pelatihan</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item <?php echo e((request()->is('admin/pelatihan') || request()->is('admin/pelatihan/create') 
                        || request()->is('admin/pelatihan/detail*') || request()->is('admin/pelatihan/edit*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('pelatihan_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pelatihan</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/pelatihan/pendaftaran*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('pendaftaran_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pendaftaran</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/pelatihan/penerimaan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('penerimaan_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Penerimaan</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/pelatihan/kelulusan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('kelulusan_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kelulusan</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/pelatihan/sertifikasi*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('sertifikasi_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Sertifikasi</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/pelatihan/penempatan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('penempatan_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Penempatan</span></a></li>
                    <li><a></a></li>
                </ul>
            </li>

            
            <li class="menu-header text-biru-muda">Helpdesk</li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/jadwal*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-calendar-check"></i><span>Jadwal</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item <?php echo e((request()->is('admin/jadwal/petugas*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('jadwal_petugas_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Petugas</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/jadwal/keberangkatan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('jadwal_keberangkatan_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Keberangkatan</span></a></li>
                    <li class="nav-item <?php echo e((request()->is('admin/jadwal/kedatangan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('jadwal_kedatangan_index')); ?>"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kedatangan</span></a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item <?php echo e((request()->is('admin/kedatangan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('kedatangan_index')); ?>"><i class="fas fa-plane"></i> <span>Kedatangan</span></a></li>
            
           
            <li class="nav-item px-auto"><a style="height:20px !important;"><div class="border-top w-100" style="border-color:#323246 !important;"></div></a></li>
            <li class="nav-item <?php echo e((request()->is('admin/pengaduan*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('pengaduan_index')); ?>"><i class="far fa-paper-plane"></i> <span>Pengaduan</span></a></li>
            <li class="nav-item <?php echo e((request()->is('admin/konsultasi*')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('konsultasi_index')); ?>"><i class="far fa-comments"></i> <span>Konsultasi</span></a></li>
            
            
            <li class="menu-header text-biru-muda">Portal</li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/page*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bookmark"></i><span>Halaman</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e((request()->is('admin/page')) ? 'active' : ''); ?>"><a href="<?php echo e(route('page_index')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fas fa-th-list ml-0 mr-1"></i>Indeks</a></li>
                    <li class="<?php echo e((request()->is('admin/page/create*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('page_create')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-plus ml-0 mr-1"></i>Buat Baru</a></li>
                    <li class="<?php echo e((request()->is('admin/page/sampah*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('page_sampah')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-trash ml-0 mr-1"></i>Sampah</a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/post*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-align-left"></i><span>Artikel</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e((request()->is('admin/post')) ? 'active' : ''); ?>"><a href="<?php echo e(route('post_index')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fas fa-th-list ml-0 mr-1"></i>Indeks</a></li>
                    <li class="<?php echo e((request()->is('admin/post/create*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('post_create')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-plus ml-0 mr-1"></i>Buat Baru</a></li>
                    <li class="<?php echo e((request()->is('admin/post/category*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('category_index')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-folder-open ml-0 mr-1"></i>Kategori</a></li>
                    
                    <li class="<?php echo e((request()->is('admin/post/sampah*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('post_sampah')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-trash ml-0 mr-1"></i>Sampah</a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/pengumuman*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-thumbtack"></i><span>Pengumuman</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e((request()->is('admin/pengumuman')) ? 'active' : ''); ?>"><a href="<?php echo e(route('pengumuman_index')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fas fa-th-list ml-0 mr-1"></i>Indeks</a></li>
                    <li class="<?php echo e((request()->is('admin/pengumuman/create*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('pengumuman_create')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-plus ml-0 mr-1"></i>Buat Baru</a></li>
                    <li class="<?php echo e((request()->is('admin/pengumuman/sampah*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('pengumuman_sampah')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-trash ml-0 mr-1"></i>Sampah</a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown <?php echo e((request()->is('admin/prodesmigratif*')) ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-holding-heart"></i><span>Prodesmigratif</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e((request()->is('admin/prodesmigratif')) ? 'active' : ''); ?>"><a href="<?php echo e(route('prodesmigratif_index')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fas fa-th-list ml-0 mr-1"></i>Indeks</a></li>
                    <li class="<?php echo e((request()->is('admin/prodesmigratif/create*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('prodesmigratif_create')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-plus ml-0 mr-1"></i>Buat Baru</a></li>
                    <li class="<?php echo e((request()->is('admin/prodesmigratif/kategori*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('kategori_prodesmigratif')); ?>" class="nav-link font-15 font-weight-500"><i class="fas fa-folder-open ml-0 mr-1"></i>Kategori</a></li>
                    <li><a></a></li>
                </ul>
            </li>

            
        </ul>

        

            
        </aside>
</div><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/layouts/part-admin/2-sidebar.blade.php ENDPATH**/ ?>