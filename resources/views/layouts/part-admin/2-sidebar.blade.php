<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand ">
            <a href="{{ route('dashboard')}}" class="font-24 font-weight-bold"><span class="text-capitalize text-white">
                <i class="fas fa-seedling font-16 mr-3 text-biru-muda"></i>Simpadu</span></a>
        </div>
        
        <div class="sidebar-brand sidebar-brand-sm text-center">
            <a href="{{ route('dashboard')}}" ><i class="fas fa-seedling font-24 text-biru-muda align-middle"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard')}}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            <li class="nav-item dropdown {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('admin/user/index*')) ? 'active' : '' }}"><a href="{{ route('user_index') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-user-check ml-0 mr-1"></i>Pengguna</a></li>
                    <li class="{{ (request()->is('admin/user/roles*')) ? 'active' : '' }}"><a href="{{ route('role_index') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-user-shield ml-0 mr-1"></i>Role</a></li>
                    <li class="{{ (request()->is('admin/user/permissions*')) ? 'active' : '' }}"><a href="{{ route('permission_index') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-shield-alt ml-0 mr-1"></i>Permissions</a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="menu-header text-biru-muda">Sistem</li>
            <li class="nav-item dropdown {{ (request()->is('admin/master*')) ? 'active' : '' || (request()->is('admin/mst*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-folder-open"></i><span>Master</span></a>
                <ul class="dropdown-menu">
                    {{-- <li class="nav-item {{ (request()->is('admin/master/pengunjung*')) ? 'active' : '' }}"><a class="nav-link" href="#"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pengunjung</span></a></li> --}}
                    <li class="nav-item {{ (request()->is('admin/master/pendidikan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'pendidikan')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pendidikan</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/sektor*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'sektor')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Sektor</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/pekerjaan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'pekerjaan')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pekerjaan</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/mst/jabatan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('jabatan_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Jabatan</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/kategori-konsultasi*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'kategori-konsultasi')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kategori Konsultasi</span></a></li>
                    <li class="nav-item px-auto "><a><div class="border-top border-secondary w-100"></div></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/masalah*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'masalah')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Masalah</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/jenis-pulang*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'jenis-pulang')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Jenis Pulang</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/negara*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'negara')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Negara</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/bandara*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'bandara')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Bandara</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/pesawat*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'pesawat')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pesawat</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/master/imigrasi*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_index', 'imigrasi')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Imigrasi</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/mst/pengirim*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengirim_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pengirim</span></a></li>
                    <li class="nav-item px-auto "><a><div class="border-top border-secondary w-100"></div></a></li>
                    <li class="nav-item {{ (request()->is('admin/mst/provinsi*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('provinsi_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Provinsi</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/mst/kabkota*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('kabkota_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kabupaten</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/mst/kecamatan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('kecamatan_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kecamatan</span></a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/direktori*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-folder"></i><span>Direktori</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ (request()->is('admin/direktori/disnaker*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('disnaker_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Disnaker</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/direktori/blk*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('blk_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>BLK</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/direktori/kbri*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('kbri_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>KBRI</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/direktori/p3mi*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('p3mi_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>P3MI</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/direktori/lsp*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('lsp_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>LSP</span></a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item {{ (request()->is('admin/perusahaan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('perusahaan_index')}}"><i class="fas fa-house-user"></i><span>Data Perusahaan</span></a></li>
            <li class="nav-item {{ (request()->is('admin/penduduk*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('partner_index')}}"><i class="fas fa-user-friends"></i><span>Data Penduduk</span></a></li>
            <li class="nav-item dropdown {{ (request()->is('admin/sip*') || request()->is('admin/lamaran*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-clipboard-list"></i><span>Lowongan</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ (request()->is('admin/sip*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('sip_index')}}"><i class="fas fa-clipboard-list"></i> <span>lowongan (SIP)</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/lamaran*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('lamaran_index')}}"><i class="far fa-id-card"></i> <span>Lamaran</span></a></li>
                    {{-- <li class="nav-item {{ (request()->is('admin/pencaker*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('pencaker_index')}}"><i class="fas fa-user-tie"></i> <span>Pencaker</span></a></li> --}}
                    <li><a></a></li>
                </ul>
            </li>
            
            <li class="nav-item dropdown {{ (request()->is('admin/pelatihan*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-diagnoses"></i><span>Pelatihan</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ (request()->is('admin/pelatihan') || request()->is('admin/pelatihan/create') 
                        || request()->is('admin/pelatihan/detail*') || request()->is('admin/pelatihan/edit*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('pelatihan_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pelatihan</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/pelatihan/pendaftaran*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('pendaftaran_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Pendaftaran</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/pelatihan/penerimaan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('penerimaan_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Penerimaan</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/pelatihan/kelulusan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('kelulusan_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kelulusan</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/pelatihan/sertifikasi*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('sertifikasi_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Sertifikasi</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/pelatihan/penempatan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('penempatan_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Penempatan</span></a></li>
                    <li><a></a></li>
                </ul>
            </li>

            {{-- <li class="nav-item px-auto"><a style="height:20px !important;"><div class="border-top w-100" style="border-color:#323246 !important;"></div></a></li> --}}
            <li class="menu-header text-biru-muda">Helpdesk</li>
            <li class="nav-item dropdown {{ (request()->is('admin/jadwal*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-calendar-check"></i><span>Jadwal</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item {{ (request()->is('admin/jadwal/petugas*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('jadwal_petugas_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Petugas</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/jadwal/keberangkatan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('jadwal_keberangkatan_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Keberangkatan</span></a></li>
                    <li class="nav-item {{ (request()->is('admin/jadwal/kedatangan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('jadwal_kedatangan_index')}}"><i class="fas fa-caret-right ml-0 mr-1"></i><span>Kedatangan</span></a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item {{ (request()->is('admin/kedatangan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('kedatangan_index')}}"><i class="fas fa-plane"></i> <span>Kedatangan</span></a></li>
            {{-- <li class="nav-item px-auto"><a style="height:20px !important;"><div class="border-top w-100" style="border-color:#323246 !important;"></div></a></li> --}}
           
            <li class="nav-item px-auto"><a style="height:20px !important;"><div class="border-top w-100" style="border-color:#323246 !important;"></div></a></li>
            <li class="nav-item {{ (request()->is('admin/pengaduan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengaduan_index')}}"><i class="far fa-paper-plane"></i> <span>Pengaduan</span></a></li>
            <li class="nav-item {{ (request()->is('admin/konsultasi*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('konsultasi_index')}}"><i class="far fa-comments"></i> <span>Konsultasi</span></a></li>
            {{-- <li class="nav-item {{ (request()->is('admin/lowongan*')) ? 'active' : '' }}"><a class="nav-link" href="#"><i class="fas fa-map-signs"></i> <span>Lowongan</span></a></li> --}}
            
            <li class="menu-header text-biru-muda">Portal</li>
            <li class="nav-item dropdown {{ (request()->is('admin/page*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bookmark"></i><span>Halaman</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('admin/page')) ? 'active' : '' }}"><a href="{{ route('page_index') }}" class="nav-link font-15 font-weight-500"><i class="fas fas fa-th-list ml-0 mr-1"></i>Indeks</a></li>
                    <li class="{{ (request()->is('admin/page/create*')) ? 'active' : '' }}"><a href="{{ route('page_create') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-plus ml-0 mr-1"></i>Buat Baru</a></li>
                    <li class="{{ (request()->is('admin/page/sampah*')) ? 'active' : '' }}"><a href="{{ route('page_sampah') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-trash ml-0 mr-1"></i>Sampah</a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/post*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-align-left"></i><span>Artikel</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('admin/post')) ? 'active' : '' }}"><a href="{{ route('post_index') }}" class="nav-link font-15 font-weight-500"><i class="fas fas fa-th-list ml-0 mr-1"></i>Indeks</a></li>
                    <li class="{{ (request()->is('admin/post/create*')) ? 'active' : '' }}"><a href="{{ route('post_create') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-plus ml-0 mr-1"></i>Buat Baru</a></li>
                    <li class="{{ (request()->is('admin/post/category*')) ? 'active' : '' }}"><a href="{{ route('category_index') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-folder-open ml-0 mr-1"></i>Kategori</a></li>
                    {{-- <li class="{{ (request()->is('admin/tag*')) ? 'active' : '' }}"><a href="#" class="nav-link font-15 font-weight-500"><i class="fas fa-tags ml-0 mr-1"></i>Tag</a></li> --}}
                    <li class="{{ (request()->is('admin/post/sampah*')) ? 'active' : '' }}"><a href="{{ route('post_sampah') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-trash ml-0 mr-1"></i>Sampah</a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/pengumuman*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-thumbtack"></i><span>Pengumuman</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('admin/pengumuman')) ? 'active' : '' }}"><a href="{{ route('pengumuman_index') }}" class="nav-link font-15 font-weight-500"><i class="fas fas fa-th-list ml-0 mr-1"></i>Indeks</a></li>
                    <li class="{{ (request()->is('admin/pengumuman/create*')) ? 'active' : '' }}"><a href="{{ route('pengumuman_create') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-plus ml-0 mr-1"></i>Buat Baru</a></li>
                    <li class="{{ (request()->is('admin/pengumuman/sampah*')) ? 'active' : '' }}"><a href="{{ route('pengumuman_sampah') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-trash ml-0 mr-1"></i>Sampah</a></li>
                    <li><a></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/prodesmigratif*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-holding-heart"></i><span>Prodesmigratif</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('admin/prodesmigratif')) ? 'active' : '' }}"><a href="{{ route('prodesmigratif_index') }}" class="nav-link font-15 font-weight-500"><i class="fas fas fa-th-list ml-0 mr-1"></i>Indeks</a></li>
                    <li class="{{ (request()->is('admin/prodesmigratif/create*')) ? 'active' : '' }}"><a href="{{ route('prodesmigratif_create') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-plus ml-0 mr-1"></i>Buat Baru</a></li>
                    <li class="{{ (request()->is('admin/prodesmigratif/kategori*')) ? 'active' : '' }}"><a href="{{ route('kategori_prodesmigratif') }}" class="nav-link font-15 font-weight-500"><i class="fas fa-folder-open ml-0 mr-1"></i>Kategori</a></li>
                    <li><a></a></li>
                </ul>
            </li>

            {{-- <li class="menu-header text-biru-muda">Pengaturan</li>
        
            <li class="nav-item {{ (request()->is('admin/backup*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('backup_index')}}"><i class="fas fa-database"></i> <span>System Backup</span></a></li> --}}
        </ul>

        

            
        </aside>
</div>