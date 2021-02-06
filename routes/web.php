<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Backup\BackupController as BackupController;
use App\Http\Controllers\Role\UserController as UserController;
use App\Http\Controllers\Role\PermissionController as PermissionController; 
use App\Http\Controllers\Role\RoleController as RoleController;

use App\Http\Controllers\PostPage\CategoryController as CategoryController;
use App\Http\Controllers\PostPage\PageController as PageController;
use App\Http\Controllers\PostPage\PostController as PostController;
use App\Http\Controllers\PostPage\PengumumanController as PengumumanController;
use App\Http\Controllers\PostPage\ProdesmigratifController as ProdesmigratifController;
use App\Http\Controllers\PostPage\KategoriProdesController as KategoriProdesController;

use App\Http\Controllers\Sistem\UsersPartnerController as UsersPartnerController;
use App\Http\Controllers\Sistem\SipController as SipController;
use App\Http\Controllers\Sistem\PerusahaanController as PerusahaanController;
use App\Http\Controllers\Sistem\DirektoriController as DirektoriController;
use App\Http\Controllers\Sistem\MasterKategoriLineController as MasterKategoriLineController;
use App\Http\Controllers\Sistem\MasterPengirimController as MasterPengirimController;
use App\Http\Controllers\Sistem\MasterJabatanController as MasterJabatanController;
use App\Http\Controllers\Sistem\ProvinsiController as ProvinsiController;
use App\Http\Controllers\Sistem\KabKotaController as KabKotaController;
use App\Http\Controllers\Sistem\KecamatanController as KecamatanController;

use App\Http\Controllers\Sistem\JadwalPetugasController as JadwalPetugasController;
use App\Http\Controllers\Sistem\JadwalKeberangkatanController as JadwalKeberangkatanController;
use App\Http\Controllers\Sistem\JadwalKedatanganController as JadwalKedatanganController;
use App\Http\Controllers\Sistem\KedatanganController as KedatanganController;

use App\Http\Controllers\Sistem\PengaduanController as PengaduanController;
use App\Http\Controllers\Sistem\KonsultasiController as KonsultasiController;

use App\Http\Controllers\Sistem\LamaranController as LamaranController;
use App\Http\Controllers\Sistem\PelatihanController as PelatihanController;
// use App\Http\Controllers\Sistem\PelatihanTerimaController as PelatihanTerimaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::group(['middleware' => [
    'auth:sanctum', 'verified'
]], function(){

    Route::get('/proses-backup', [BackupController::class, 'backup'])->name('backup_process');
    Route::get('/backup', [BackupController::class, 'index'])->name('backup_index');
    // Route::get('/{filename}', [BackupController::class, 'download'])->name('backup_download');
    Route::post('/backup-delete', [BackupController::class, 'delete'])->name('backup_delete');
    

    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin/user/index', [UserController::class, 'index'])->name('user_index');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('user_create');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('user_store');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('user_edit');
    Route::post('/admin/user/update/{id}', [UserController::class, 'update'])->name('user_update');
    Route::post('/admin/user/delete', [UserController::class, 'delete'])->name('user_delete');

    Route::get('/admin/user/cek-username', [UserController::class, 'cek_username'])->name('user_cek_username');
    Route::get('/admin/user/cek-email', [UserController::class, 'cek_email'])->name('user_cek_email');

    Route::get('/admin/user/permission', [PermissionController::class, 'index'])->name('permission_index');
    Route::post('/admin/user/permission/store', [PermissionController::class, 'store'])->name('permission_store');
    Route::get('/admin/user/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission_edit');
    Route::post('/admin/user/permission/update/{id}', [PermissionController::class, 'update'])->name('permission_update');
    Route::post('/admin/user/permission/delete', [PermissionController::class, 'delete_index'])->name('permission_delete_index');

    Route::get('/admin/user/role', [RoleController::class, 'index'])->name('role_index');
    Route::get('/admin/user/role/create', [RoleController::class, 'create'])->name('role_create');
    Route::get('/admin/user/role/edit/{id}', [RoleController::class, 'edit'])->name('role_edit');
    Route::post('/admin/user/role/update/{id}', [RoleController::class, 'update'])->name('role_update');
    Route::post('/admin/user/role/store', [RoleController::class, 'store'])->name('role_store');
    Route::post('/admin/user/role/delete', [RoleController::class, 'delete_index'])->name('role_delete_index');

    // Users Partner
    Route::get('/admin/penduduk/getkabupaten', [UsersPartnerController::class, 'getKabupaten'])->name('partner_get_kabupaten');
    Route::get('/admin/penduduk/getkecamatan', [UsersPartnerController::class, 'getKecamatan'])->name('partner_get_kecamatan');
    Route::get('/admin/penduduk/getpenduduk', [UsersPartnerController::class, 'getPenduduk'])->name('partner_get_penduduk');
    Route::get('/admin/penduduk/nik', [UsersPartnerController::class, 'cek_nik'])->name('partner_cek_nik');
    Route::get('/admin/penduduk/bpjs', [UsersPartnerController::class, 'cek_bpjs'])->name('partner_cek_bpjs');
    Route::get('/admin/penduduk/json', [UsersPartnerController::class, 'index_json'])->name('partner_index_json');
    Route::get('/admin/penduduk', [UsersPartnerController::class, 'index'])->name('partner_index');   
    Route::get('/admin/penduduk/create', [UsersPartnerController::class, 'create'])->name('partner_create');
    Route::post('/admin/penduduk/store-json', [UsersPartnerController::class, 'store_json'])->name('partner_store_json');
    Route::post('/admin/penduduk/store', [UsersPartnerController::class, 'store'])->name('partner_store');
    Route::get('/admin/penduduk/detail/{id}', [UsersPartnerController::class, 'detail'])->name('partner_detail');
    Route::get('/admin/penduduk/edit/{id}', [UsersPartnerController::class, 'edit'])->name('partner_edit');
    Route::post('/admin/penduduk/update/{id}', [UsersPartnerController::class, 'update'])->name('partner_update');
    Route::post('/admin/penduduk/delete', [UsersPartnerController::class, 'delete'])->name('partner_delete');

    Route::get('/admin/penduduk/detail/json', [UsersPartnerController::class, 'detail_json'])->name('partner_detail_json');

    // Page
    Route::get('/admin/page', [PageController::class, 'index'])->name('page_index');
    Route::get('/admin/page/sampah', [PageController::class, 'sampah'])->name('page_sampah');
    Route::get('/admin/page/create', [PageController::class, 'create'])->name('page_create');
    Route::get('/admin/page/edit/{id}', [PageController::class, 'edit'])->name('page_edit');
    Route::get('/admin/page/filter', [PageController::class, 'search_index'])->name('page_search');
    Route::get('/admin/page/sampah/filter', [PageController::class, 'search_sampah'])->name('page_search_sampah');
    Route::get('/admin/page/preview/{id}', [PageController::class, 'preview'])->name('page_preview');
    Route::post('/admin/page/update/{id}', [PageController::class, 'update'])->name('page_update');
    Route::post('/admin/page/store', [PageController::class, 'store'])->name('page_store');
    Route::post('/admin/page/softdelete', [PageController::class, 'softdelete'])->name('page_softdelete');
    Route::post('/admin/page/restore', [PageController::class, 'restore'])->name('page_restore');
    Route::post('/admin/page/delete', [PageController::class, 'delete'])->name('page_delete');

    Route::get('/admin/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman_index');
    Route::get('/admin/pengumuman/sampah', [PengumumanController::class, 'sampah'])->name('pengumuman_sampah');
    Route::get('/admin/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman_create');
    Route::get('/admin/pengumuman/edit/{id}', [PengumumanController::class, 'edit'])->name('pengumuman_edit');
    Route::get('/admin/pengumuman/filter', [PengumumanController::class, 'search_index'])->name('pengumuman_search');
    Route::get('/admin/pengumuman/sampah/filter', [PengumumanController::class, 'search_sampah'])->name('pengumuman_search_sampah');
    Route::get('/admin/pengumuman/preview/{id}', [PengumumanController::class, 'preview'])->name('pengumuman_preview');
    Route::post('/admin/pengumuman/update/{id}', [PengumumanController::class, 'update'])->name('pengumuman_update');
    Route::post('/admin/pengumuman/store', [PengumumanController::class, 'store'])->name('pengumuman_store');
    Route::post('/admin/pengumuman/softdelete', [PengumumanController::class, 'softdelete'])->name('pengumuman_softdelete');
    Route::post('/admin/pengumuman/restore', [PengumumanController::class, 'restore'])->name('pengumuman_restore');
    Route::post('/admin/pengumuman/delete', [PengumumanController::class, 'delete'])->name('pengumuman_delete');

    Route::get('/admin/post', [PostController::class, 'index'])->name('post_index');
    Route::get('/admin/post/sampah', [PostController::class, 'sampah'])->name('post_sampah');
    Route::get('/admin/post/create', [PostController::class, 'create'])->name('post_create');
    Route::get('/admin/post/edit/{id}', [PostController::class, 'edit'])->name('post_edit');
    Route::get('/admin/post/filter', [PostController::class, 'search_index'])->name('post_search');
    Route::get('/admin/post/sampah/filter', [PostController::class, 'search_sampah'])->name('post_search_sampah');
    Route::get('/admin/post/preview/{id}', [PostController::class, 'preview'])->name('post_preview');
    Route::post('/admin/post/update/{id}', [PostController::class, 'update'])->name('post_update');
    Route::post('/admin/post/store', [PostController::class, 'store'])->name('post_store');
    Route::post('/admin/post/softdelete', [PostController::class, 'softdelete'])->name('post_softdelete');
    Route::post('/admin/post/restore', [PostController::class, 'restore'])->name('post_restore');
    Route::post('/admin/post/delete', [PostController::class, 'delete'])->name('post_delete');

    Route::get('/admin/post/category', [CategoryController::class, 'index'])->name('category_index');
    Route::get('/admin/post/category/create', [CategoryController::class, 'create'])->name('category_create');
    Route::get('/admin/post/category/edit/{id}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::get('/admin/post/category/filter', [CategoryController::class, 'search'])->name('category_search');
    Route::post('/admin/post/category/update/{id}', [CategoryController::class, 'update'])->name('category_update');
    Route::post('/admin/post/category/store', [CategoryController::class, 'store'])->name('category_store');
    Route::post('/admin/post/category/delete', [CategoryController::class, 'delete_index'])->name('category_delete_index');

    Route::get('/admin/prodesmigratif', [ProdesmigratifController::class, 'index'])->name('prodesmigratif_index');
    Route::get('/admin/prodesmigratif/create', [ProdesmigratifController::class, 'create'])->name('prodesmigratif_create');
    Route::get('/admin/prodesmigratif/edit/{id}', [ProdesmigratifController::class, 'edit'])->name('prodesmigratif_edit');
    Route::get('/admin/prodesmigratif/filter', [ProdesmigratifController::class, 'search_index'])->name('prodesmigratif_search');
    Route::post('/admin/prodesmigratif/update/{id}', [ProdesmigratifController::class, 'update'])->name('prodesmigratif_update');
    Route::post('/admin/prodesmigratif/store', [ProdesmigratifController::class, 'store'])->name('prodesmigratif_store');
    Route::post('/admin/prodesmigratif/delete', [ProdesmigratifController::class, 'delete'])->name('prodesmigratif_delete');

    Route::get('/admin/prodesmigratif/kategori', [KategoriProdesController::class, 'index'])->name('kategori_prodesmigratif');
    Route::get('/admin/prodesmigratif/kategori/edit/{id}', [KategoriProdesController::class, 'edit'])->name('kategori_prodesmigratif_edit');
    Route::post('/admin/prodesmigratif/kategori/store', [KategoriProdesController::class, 'store'])->name('kategori_prodesmigratif_store');
    Route::post('/admin/prodesmigratif/kategori/update/{id}', [KategoriProdesController::class, 'update'])->name('kategori_prodesmigratif_update');
    Route::get('/admin/prodesmigratif/kategori/search', [KategoriProdesController::class, 'search_index'])->name('kategori_prodesmigratif_search');
    Route::post('/admin/prodesmigratif/kategori/delete', [KategoriProdesController::class, 'delete'])->name('kategori_prodesmigratif_delete');
    // Sistem

    // MASTER

    // Kategori Line

    Route::get('/admin/master/{slug}', [MasterKategoriLineController::class, 'index'])->name('master_index');
    
    Route::post('/admin/master/store', [MasterKategoriLineController::class, 'store'])->name('master_store');
    Route::get('/admin/master/{slug}/edit/{id}', [MasterKategoriLineController::class, 'edit'])->name('master_edit');
    Route::post('/admin/master/update', [MasterKategoriLineController::class, 'update'])->name('master_update');
    Route::post('/admin/master/delete', [MasterKategoriLineController::class, 'delete'])->name('master_delete');

    // Kategori Line JSON
    Route::get('/admin/master/sektor/json', [MasterKategoriLineController::class, 'sektor_json'])->name('sektor_json');
    Route::get('/admin/master/masalah/json', [MasterKategoriLineController::class, 'masalah_json'])->name('masalah_json');
    Route::get('/admin/master/jenis-pulang/json', [MasterKategoriLineController::class, 'jenisPulang_json'])->name('jenisPulang_json');
    Route::get('/admin/master/pendidikan/json', [MasterKategoriLineController::class, 'pendidikan_json'])->name('pendidikan_json');
    Route::get('/admin/master/pekerjaan/json', [MasterKategoriLineController::class, 'pekerjaan_json'])->name('pekerjaan_json');
    Route::get('/admin/master/negara/json', [MasterKategoriLineController::class, 'negara_json'])->name('negara_json');
    Route::get('/admin/master/bandara/json', [MasterKategoriLineController::class, 'bandara_json'])->name('bandara_json');
    Route::get('/admin/master/pesawat/json', [MasterKategoriLineController::class, 'pesawat_json'])->name('pesawat_json');
    Route::get('/admin/master/imigrasi/json', [MasterKategoriLineController::class, 'imigrasi_json'])->name('imigrasi_json');
    // Route::get('/admin/master/pengirim/json', [MasterKategoriLineController::class, 'pengirim_json'])->name('pengirim_json');
    Route::get('/admin/master/kategori-konsultasi/json', [MasterKategoriLineController::class, 'konsultasi_kategori_json'])->name('konsultasi_kategori_json');

    // Pengirim
    Route::get('/admin/mst/pengirim/json', [MasterPengirimController::class, 'index_json'])->name('pengirim_json');
    Route::get('/admin/mst/pengirim', [MasterPengirimController::class, 'index'])->name('pengirim_index');
    Route::get('/admin/mst/pengirim/create', [MasterPengirimController::class, 'create'])->name('pengirim_create');
    Route::get('/admin/mst/pengirim/detail/{id}', [MasterPengirimController::class, 'detail'])->name('pengirim_detail');
    Route::get('/admin/mst/pengirim/edit/{id}', [MasterPengirimController::class, 'edit'])->name('pengirim_edit');
    Route::post('/admin/mst/pengirim/update', [MasterPengirimController::class, 'update'])->name('pengirim_update');
    Route::post('/admin/mst/pengirim/store', [MasterPengirimController::class, 'store'])->name('pengirim_store');
    Route::post('/admin/mst/pengirim/delete', [MasterPengirimController::class, 'delete'])->name('pengirim_delete');

    // Jabatan
    Route::get('/admin/mst/jabatan/json', [MasterJabatanController::class, 'index_json'])->name('jabatan_json');
    Route::get('/admin/mst/jabatan', [MasterJabatanController::class, 'index'])->name('jabatan_index');
    Route::get('/admin/mst/jabatan/create', [MasterJabatanController::class, 'create'])->name('jabatan_create');
    Route::get('/admin/mst/jabatan/detail/{id}', [MasterJabatanController::class, 'detail'])->name('jabatan_detail');
    Route::get('/admin/mst/jabatan/edit/{id}', [MasterJabatanController::class, 'edit'])->name('jabatan_edit');
    Route::post('/admin/mst/jabatan/update', [MasterJabatanController::class, 'update'])->name('jabatan_update');
    Route::post('/admin/mst/jabatan/store', [MasterJabatanController::class, 'store'])->name('jabatan_store');
    Route::post('/admin/mst/jabatan/delete', [MasterJabatanController::class, 'delete'])->name('jabatan_delete');

    // Provinsi
    Route::get('/admin/mst/provinsi/json', [ProvinsiController::class, 'index_json'])->name('provinsi_json');
    Route::get('/admin/mst/provinsi', [ProvinsiController::class, 'index'])->name('provinsi_index');
    Route::get('/admin/mst/provinsi/create', [ProvinsiController::class, 'create'])->name('provinsi_create');
    Route::get('/admin/mst/provinsi/edit/{id}', [ProvinsiController::class, 'edit'])->name('provinsi_edit');
    Route::post('/admin/mst/provinsi/update/{id}', [ProvinsiController::class, 'update'])->name('provinsi_update');
    Route::post('/admin/mst/provinsi/store', [ProvinsiController::class, 'store'])->name('provinsi_store');
    Route::post('/admin/mst/provinsi/delete', [ProvinsiController::class, 'delete'])->name('provinsi_delete');

    // Kabkota
    Route::get('/admin/mst/kabkota/json', [KabKotaController::class, 'index_json'])->name('kabkota_json');
    Route::get('/admin/mst/kabkota', [KabKotaController::class, 'index'])->name('kabkota_index');
    Route::get('/admin/mst/kabkota/create', [KabKotaController::class, 'create'])->name('kabkota_create');
    Route::get('/admin/mst/kabkota/edit/{id}', [KabKotaController::class, 'edit'])->name('kabkota_edit');
    Route::post('/admin/mst/kabkota/update/{id}', [KabKotaController::class, 'update'])->name('kabkota_update');
    Route::post('/admin/mst/kabkota/store', [KabKotaController::class, 'store'])->name('kabkota_store');
    Route::post('/admin/mst/kabkota/delete', [KabKotaController::class, 'delete'])->name('kabkota_delete');

    // Kecamatan
    Route::get('/admin/mst/kecamatan/json', [KecamatanController::class, 'index_json'])->name('kecamatan_json');
    Route::get('/admin/mst/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan_index');
    Route::get('/admin/mst/kecamatan/create', [KecamatanController::class, 'create'])->name('kecamatan_create');
    Route::get('/admin/mst/kecamatan/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan_edit');
    Route::post('/admin/mst/kecamatan/update/{id}', [KecamatanController::class, 'update'])->name('kecamatan_update');
    Route::post('/admin/mst/kecamatan/store', [KecamatanController::class, 'store'])->name('kecamatan_store');
    Route::post('/admin/mst/kecamatan/delete', [KecamatanController::class, 'delete'])->name('kecamatan_delete');



    
    // Perusahaan
    Route::get('/admin/perusahaan/json', [PerusahaanController::class, 'index_json'])->name('perusahaan_json');
    Route::get('/admin/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan_index');
    Route::get('/admin/perusahaan/create', [PerusahaanController::class, 'create'])->name('perusahaan_create');
    Route::get('/admin/perusahaan/detail/{id}', [PerusahaanController::class, 'detail'])->name('perusahaan_detail');
    Route::get('/admin/perusahaan/edit/{id}', [PerusahaanController::class, 'edit'])->name('perusahaan_edit');
    Route::post('/admin/perusahaan/update/{id}', [PerusahaanController::class, 'update'])->name('perusahaan_update');
    Route::post('/admin/perusahaan/store', [PerusahaanController::class, 'store'])->name('perusahaan_store');
    Route::post('/admin/perusahaan/delete', [PerusahaanController::class, 'delete'])->name('perusahaan_delete');
    Route::get('/admin/perusahaan/getkabupaten', [PerusahaanController::class, 'getkabupaten'])->name('perusahaan_get_kabupaten');
    Route::get('/admin/perusahaan/getkecamatan', [PerusahaanController::class, 'getKecamatan'])->name('perusahaan_get_kecamatan');

    // SIP
    Route::get('/admin/sip/json', [SipController::class, 'index_json'])->name('sip_json');
    Route::get('/admin/sip', [SipController::class, 'index'])->name('sip_index');
    Route::get('/admin/sip/create', [SipController::class, 'create'])->name('sip_create');
    Route::get('/admin/sip/detail/{id}', [SipController::class, 'detail'])->name('sip_detail');
    Route::get('/admin/sip/edit/{id}', [SipController::class, 'edit'])->name('sip_edit');
    Route::post('/admin/sip/update/{id}', [SipController::class, 'update'])->name('sip_update');
    Route::post('/admin/sip/store', [SipController::class, 'store'])->name('sip_store');
    Route::post('/admin/sip/delete', [SipController::class, 'delete'])->name('sip_delete');

    // Lamaran
    Route::get('/admin/lamaran/json', [LamaranController::class, 'index_json'])->name('lamaran_json');
    Route::get('/admin/lamaran', [LamaranController::class, 'index'])->name('lamaran_index');
    Route::get('/admin/lamaran/create', [LamaranController::class, 'create'])->name('lamaran_create');
    Route::get('/admin/lamaran/detail/{id}', [LamaranController::class, 'detail'])->name('lamaran_detail');
    Route::get('/admin/lamaran/edit/{id}', [LamaranController::class, 'edit'])->name('lamaran_edit');
    Route::post('/admin/lamaran/update', [LamaranController::class, 'update'])->name('lamaran_update');
    Route::post('/admin/lamaran/store', [LamaranController::class, 'store'])->name('lamaran_store');
    Route::post('/admin/lamaran/delete', [LamaranController::class, 'delete'])->name('lamaran_delete');
    
    Route::get('/admin/lamaran/getkabkota', [LamaranController::class, 'getKabupaten'])->name('lamaran_get_kab');
    Route::get('/admin/lamaran/getkecamatan', [LamaranController::class, 'getKecamatan'])->name('lamaran_get_kecamatan');
    
    
    // PELATIHAN

    // Master Peserta Pelatihan
    Route::get('/admin/pelatihan/json', [PelatihanController::class, 'index_json'])->name('pelatihan_json');
    Route::get('/admin/pelatihan', [PelatihanController::class, 'index'])->name('pelatihan_index');
    Route::get('/admin/pelatihan/create', [PelatihanController::class, 'create'])->name('pelatihan_create');
    Route::get('/admin/pelatihan/detail/{id}', [PelatihanController::class, 'detail'])->name('pelatihan_detail');
    Route::get('/admin/pelatihan/edit/{id}', [PelatihanController::class, 'edit'])->name('pelatihan_edit');
    Route::post('/admin/pelatihan/update', [PelatihanController::class, 'update'])->name('pelatihan_update');
    Route::post('/admin/pelatihan/store', [PelatihanController::class, 'store'])->name('pelatihan_store');
    Route::post('/admin/pelatihan/delete', [PelatihanController::class, 'delete'])->name('pelatihan_delete');
    
    Route::get('/admin/pelatihan/getkabkota', [PelatihanController::class, 'getKabupaten'])->name('pelatihan_get_kab');
    Route::get('/admin/pelatihan/getkecamatan', [PelatihanController::class, 'getKecamatan'])->name('pelatihan_get_kecamatan');  
    
    Route::get('/admin/pelatihan/detail/json/{id}', [PelatihanController::class, 'getPelatihanDetail'])->name('pelatihan_detail_json');

    Route::post('/admin/pelatihan/selesai/{id}', [PelatihanController::class, 'pelatihan_selesai'])->name('pelatihan_selesai');

    // Pelatihan - Sub Pendaftaran
    Route::get('/admin/pelatihan/pendaftaran/json', [PelatihanController::class, 'pendaftaran_detail_json'])->name('pendaftaran_detail_json');
    Route::post('/admin/pelatihan/pendaftaran/peserta/store', [PelatihanController::class, 'pendaftaran_store_baru'])->name('pelatihan_pendaftaran_store_baru');
    Route::post('/admin/pelatihan/pendaftaran/peserta/update', [PelatihanController::class, 'pendaftaran_update'])->name('pelatihan_pendaftaran_update');
    Route::post('/admin/pelatihan/pendaftaran/ubah-status', [PelatihanController::class, 'pendaftaran_ubah_Status'])->name('pelatihan_pendaftaran_ubah_status');
    Route::post('/admin/pelatihan/pendaftaran/peserta/exists/store', [PelatihanController::class, 'pendaftaran_store_exists'])->name('pelatihan_pendaftaran_store_exists');
    Route::get('/admin/pelatihan/pendaftaran/detail/{id}', [PelatihanController::class, 'pendaftaran_detail'])->name('pelatihan_pendaftaran_detail');
    Route::post('/admin/pelatihan/pendaftaran/peserta/delete', [PelatihanController::class, 'pendaftaran_delete'])->name('pelatihan_pendaftaran_delete');
    Route::get('/admin/pelatihan/pendaftaran/duplikat', [PelatihanController::class, 'pendaftaran_duplikat'])->name('pelatihan_pendaftaran_duplikat');

    Route::get('/admin/pelatihan/pendaftaran/index-json', [PelatihanController::class, 'pendaftaran_index_json'])->name('pendaftaran_index_json');
    Route::get('/admin/pelatihan/pendaftaran/index', [PelatihanController::class, 'pendaftaran_index'])->name('pendaftaran_index');

    // Pelatihan - Sub Penerimaan
    Route::get('/admin/pelatihan/penerimaan/detail/json', [PelatihanController::class, 'penerimaan_detail_json'])->name('pelatihan_penerimaan_detail_json');
    Route::post('/admin/pelatihan/penerimaan/update', [PelatihanController::class, 'penerimaan_update'])->name('pelatihan_penerimaan_update');
    
    Route::get('/admin/pelatihan/penerimaan/index-json', [PelatihanController::class, 'penerimaan_index_json'])->name('penerimaan_index_json');
    Route::get('/admin/pelatihan/penerimaan/index', [PelatihanController::class, 'penerimaan_index'])->name('penerimaan_index');
    Route::get('/admin/pelatihan/penerimaan/detail/{id}', [PelatihanController::class, 'penerimaan_detail'])->name('pelatihan_penerimaan_detail');

    // Pelatihan - Sub Kelulusan
    Route::get('/admin/pelatihan/kelulusan/detail/json', [PelatihanController::class, 'kelulusan_detail_json'])->name('pelatihan_kelulusan_detail_json');
    Route::post('/admin/pelatihan/kelulusan/update', [PelatihanController::class, 'kelulusan_update'])->name('pelatihan_kelulusan_update');
    
    Route::get('/admin/pelatihan/kelulusan/index-json', [PelatihanController::class, 'kelulusan_index_json'])->name('kelulusan_index_json');
    Route::get('/admin/pelatihan/kelulusan/index', [PelatihanController::class, 'kelulusan_index'])->name('kelulusan_index');
    Route::get('/admin/pelatihan/kelulusan/detail/{id}', [PelatihanController::class, 'kelulusan_detail'])->name('pelatihan_kelulusan_detail');
    

    // Pelatihan - Sub Sertifikasi
    Route::get('/admin/pelatihan/sertifikasi/detail/json', [PelatihanController::class, 'sertifikasi_detail_json'])->name('pelatihan_sertifikasi_detail_json');
    Route::post('/admin/pelatihan/sertifikasi/update', [PelatihanController::class, 'sertifikasi_update'])->name('pelatihan_sertifikasi_update');
    
    Route::get('/admin/pelatihan/sertifikasi/index-json', [PelatihanController::class, 'sertifikasi_index_json'])->name('sertifikasi_index_json');
    Route::get('/admin/pelatihan/sertifikasi/index', [PelatihanController::class, 'sertifikasi_index'])->name('sertifikasi_index');
    Route::get('/admin/pelatihan/sertifikasi/detail/{id}', [PelatihanController::class, 'sertifikasi_detail'])->name('pelatihan_sertifikasi_detail');

    // Pelatihan - Sub Penempatan
    // Route::get('/admin/pelatihan/penempatan/detail/json', [PelatihanController::class, 'penempatan_detail_json'])->name('pelatihan_penempatan_detail_json');
    Route::post('/admin/pelatihan/penempatan/update', [PelatihanController::class, 'penempatan_update'])->name('pelatihan_penempatan_update');
    
    Route::get('/admin/pelatihan/penempatan/index-json', [PelatihanController::class, 'penempatan_index_json'])->name('penempatan_index_json');
    Route::get('/admin/pelatihan/penempatan/index', [PelatihanController::class, 'penempatan_index'])->name('penempatan_index');
    Route::get('/admin/pelatihan/penempatan/detail/{id}', [PelatihanController::class, 'penempatan_detail'])->name('pelatihan_penempatan_detail');


    // Jadwal Petugas
    Route::get('/admin/jadwal/petugas/json', [JadwalPetugasController::class, 'index_json'])->name('jadwal_petugas_json');
    Route::get('/admin/jadwal/petugas', [JadwalPetugasController::class, 'index'])->name('jadwal_petugas_index');
    Route::get('/admin/jadwal/petugas/create', [JadwalPetugasController::class, 'create'])->name('jadwal_petugas_create');
    Route::get('/admin/jadwal/petugas/detail/{id}', [JadwalPetugasController::class, 'detail'])->name('jadwal_petugas_detail');
    Route::get('/admin/jadwal/petugas/edit/{id}', [JadwalPetugasController::class, 'edit'])->name('jadwal_petugas_edit');
    Route::post('/admin/jadwal/petugas/update', [JadwalPetugasController::class, 'update'])->name('jadwal_petugas_update');
    Route::post('/admin/jadwal/petugas/store', [JadwalPetugasController::class, 'store'])->name('jadwal_petugas_store');
    Route::post('/admin/jadwal/petugas/delete', [JadwalPetugasController::class, 'delete'])->name('jadwal_petugas_delete');

    // Jadwal Kedatangan
    Route::get('/admin/jadwal/kedatangan/json', [JadwalKedatanganController::class, 'index_json'])->name('jadwal_kedatangan_json');
    Route::get('/admin/jadwal/kedatangan', [JadwalKedatanganController::class, 'index'])->name('jadwal_kedatangan_index');
    Route::get('/admin/jadwal/kedatangan/create', [JadwalKedatanganController::class, 'create'])->name('jadwal_kedatangan_create');
    Route::get('/admin/jadwal/kedatangan/detail/{id}', [JadwalKedatanganController::class, 'detail'])->name('jadwal_kedatangan_detail');
    Route::get('/admin/jadwal/kedatangan/edit/{id}', [JadwalKedatanganController::class, 'edit'])->name('jadwal_kedatangan_edit');
    Route::post('/admin/jadwal/kedatangan/update', [JadwalKedatanganController::class, 'update'])->name('jadwal_kedatangan_update');
    Route::post('/admin/jadwal/kedatangan/store', [JadwalKedatanganController::class, 'store'])->name('jadwal_kedatangan_store');
    Route::post('/admin/jadwal/kedatangan/delete', [JadwalKedatanganController::class, 'delete'])->name('jadwal_kedatangan_delete');


    // keberangkatan
    Route::get('/admin/jadwal/keberangkatan/json', [JadwalKeberangkatanController::class, 'index_json'])->name('jadwal_keberangkatan_json');
    Route::get('/admin/jadwal/keberangkatan', [JadwalKeberangkatanController::class, 'index'])->name('jadwal_keberangkatan_index');
    Route::get('/admin/jadwal/keberangkatan/create', [JadwalKeberangkatanController::class, 'create'])->name('jadwal_keberangkatan_create');
    Route::get('/admin/jadwal/keberangkatan/detail/{id}', [JadwalKeberangkatanController::class, 'detail'])->name('jadwal_keberangkatan_detail');
    Route::get('/admin/jadwal/keberangkatan/edit/{id}', [JadwalKeberangkatanController::class, 'edit'])->name('jadwal_keberangkatan_edit');
    Route::post('/admin/jadwal/keberangkatan/update', [JadwalKeberangkatanController::class, 'update'])->name('jadwal_keberangkatan_update');
    Route::post('/admin/jadwal/keberangkatan/store', [JadwalKeberangkatanController::class, 'store'])->name('jadwal_keberangkatan_store');
    Route::post('/admin/jadwal/keberangkatan/delete', [JadwalKeberangkatanController::class, 'delete'])->name('jadwal_keberangkatan_delete');
    
    Route::get('/admin/jadwal/keberangkatan/getkabkota', [KedatanganController::class, 'getKabKota'])->name('jadwal_keberangkatan_get_kab');
    Route::get('/admin/jadwal/keberangkatan/getkecamatan', [KedatanganController::class, 'getKecamatan'])->name('jadwal_keberangkatan_get_kecamatan');
    Route::get('/admin/jadwal/keberangkatan/getdesa', [KedatanganController::class, 'getDesa'])->name('jadwal_keberangkatan_get_desa');
    Route::get('/admin/jadwal/keberangkatan/getpekerjaan', [KedatanganController::class, 'getPekerjaan'])->name('jadwal_keberangkatan_get_pekerjaan');


    // Kedatangan
    Route::get('/admin/kedatangan/json', [KedatanganController::class, 'index_json'])->name('kedatangan_json');
    Route::get('/admin/kedatangan', [KedatanganController::class, 'index'])->name('kedatangan_index');
    Route::get('/admin/kedatangan/create', [KedatanganController::class, 'create'])->name('kedatangan_create');
    Route::get('/admin/kedatangan/detail/{id}', [KedatanganController::class, 'detail'])->name('kedatangan_detail');
    Route::get('/admin/kedatangan/edit/{id}', [KedatanganController::class, 'edit'])->name('kedatangan_edit');
    Route::post('/admin/kedatangan/update', [KedatanganController::class, 'update'])->name('kedatangan_update');
    Route::post('/admin/kedatangan/store', [KedatanganController::class, 'store'])->name('kedatangan_store');
    Route::post('/admin/kedatangan/delete', [KedatanganController::class, 'delete'])->name('kedatangan_delete');
    
    Route::get('/admin/kedatangan/getkabkota', [KedatanganController::class, 'getKabKota'])->name('kedatangan_get_kab');
    Route::get('/admin/kedatangan/getkecamatan', [KedatanganController::class, 'getKecamatan'])->name('kedatangan_get_kecamatan');
    Route::get('/admin/kedatangan/getdesa', [KedatanganController::class, 'getDesa'])->name('kedatangan_get_desa');
    Route::get('/admin/kedatangan/getpekerjaan', [KedatanganController::class, 'getPekerjaan'])->name('kedatangan_get_pekerjaan');
    
    // Pengaduan
    Route::get('/admin/pengaduan/json', [PengaduanController::class, 'index_json'])->name('pengaduan_json');
    Route::get('/admin/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan_index');
    Route::get('/admin/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan_create');
    Route::get('/admin/pengaduan/detail/{id}', [PengaduanController::class, 'detail'])->name('pengaduan_detail');
    Route::get('/admin/pengaduan/edit/{id}', [PengaduanController::class, 'edit'])->name('pengaduan_edit');
    Route::post('/admin/pengaduan/update', [PengaduanController::class, 'update'])->name('pengaduan_update');
    Route::post('/admin/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan_store');
    Route::post('/admin/pengaduan/delete', [PengaduanController::class, 'delete'])->name('pengaduan_delete');
    Route::get('/admin/pengaduan/sampah-json', [PengaduanController::class, 'sampah_json'])->name('pengaduan_sampah_json');
    Route::get('/admin/pengaduan/sampah', [PengaduanController::class, 'index_sampah'])->name('pengaduan_sampah');
    Route::post('/admin/pengaduan/restore', [PengaduanController::class, 'restore'])->name('pengaduan_restore');
    Route::post('/admin/pengaduan/destroy', [PengaduanController::class, 'destroy'])->name('pengaduan_destroy');
    Route::get('/admin/pengaduan/pptkis', [PengaduanController::class, 'getDetailPptkis'])->name('pengaduan_pptkis');

    // Route::put('/admin/pengaduan/filekrono', [PengaduanController::class, 'uploadFileKrono'])->name('pengaduan_file_krono');
    Route::get('/admin/pengaduan/getkabkota', [PengaduanController::class, 'getKabKota'])->name('pengaduan_get_kab');
    Route::get('/admin/pengaduan/getkecamatan', [PengaduanController::class, 'getKecamatan'])->name('pengaduan_get_kecamatan');
    Route::get('/admin/pengaduan/getdesa', [PengaduanController::class, 'getDesa'])->name('pengaduan_get_desa');
    Route::get('/admin/pengaduan/getpekerjaan', [PengaduanController::class, 'getPekerjaan'])->name('pengaduan_get_pekerjaan');

    // Penanganan Pengaduan

    Route::get('/admin/pengaduan/tindak-lanjut/{id}', [PengaduanController::class, 'penanganan'])->name('pengaduan_penanganan');
    Route::post('/admin/pengaduan/tindak-lanjut/store/{id}', [PengaduanController::class, 'penanganan_store'])->name('pengaduan_penanganan_store');

    //  Respon Pengaduan
    Route::post('/admin/pengaduan//status', [PengaduanController::class, 'pengaduan_status'])->name('pengaduan_status');
    Route::post('/admin/pengaduan/respon', [PengaduanController::class, 'respon'])->name('pengaduan_respon');
    Route::post('/admin/pengaduan/respon/hapus', [PengaduanController::class, 'respon_hapus'])->name('pengaduan_respon_hapus');
    Route::post('/admin/pengaduan/respon/status', [PengaduanController::class, 'respon_status'])->name('pengaduan_respon_status');
    
    // Konsultasi
    Route::get('/admin/konsultasi/json', [KonsultasiController::class, 'index_json'])->name('konsultasi_json');
    Route::get('/admin/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi_index');
    Route::get('/admin/konsultasi/create', [KonsultasiController::class, 'create'])->name('konsultasi_create');
    Route::get('/admin/konsultasi/detail/{id}', [KonsultasiController::class, 'detail'])->name('konsultasi_detail');
    Route::get('/admin/konsultasi/edit/{id}', [KonsultasiController::class, 'edit'])->name('konsultasi_edit');
    Route::post('/admin/konsultasi/update', [KonsultasiController::class, 'update'])->name('konsultasi_update');
    Route::post('/admin/konsultasi/store', [KonsultasiController::class, 'store'])->name('konsultasi_store');
    Route::post('/admin/konsultasi/delete', [KonsultasiController::class, 'delete'])->name('konsultasi_delete');
    Route::post('/admin/konsultasi//status', [KonsultasiController::class, 'konsultasi_status'])->name('konsultasi_status');

    Route::post('/admin/konsultasi/respon', [KonsultasiController::class, 'respon'])->name('konsultasi_respon');
    Route::post('/admin/konsultasi/respon/hapus', [KonsultasiController::class, 'respon_hapus'])->name('konsultasi_respon_hapus');
    Route::post('/admin/konsultasi/respon/status', [KonsultasiController::class, 'respon_status'])->name('konsultasi_respon_status');
    //  DIREKTORI

    // Disnaker
    Route::get('/admin/direktori/json', [DirektoriController::class, 'direktori_json'])->name('direktori_json');

    Route::get('/admin/direktori/disnaker', [DirektoriController::class, 'disnaker_index'])->name('disnaker_index');
    Route::get('/admin/direktori/disnaker/create', [DirektoriController::class, 'disnaker_create'])->name('disnaker_create');
    Route::get('/admin/direktori/disnaker/detail/{id}', [DirektoriController::class, 'disnaker_detail'])->name('disnaker_detail');
    Route::get('/admin/direktori/disnaker/edit/{id}', [DirektoriController::class, 'disnaker_edit'])->name('disnaker_edit');
    Route::post('/admin/direktori/disnaker/update/{id}', [DirektoriController::class, 'disnaker_update'])->name('disnaker_update');
    Route::post('/admin/direktori/disnaker/store', [DirektoriController::class, 'disnaker_store'])->name('disnaker_store');
    Route::post('/admin/direktori/disnaker/delete', [DirektoriController::class, 'disnaker_delete'])->name('disnaker_delete');

    // BLK
    Route::get('/admin/direktori/blk', [DirektoriController::class, 'blk_index'])->name('blk_index');
    Route::get('/admin/direktori/blk/create', [DirektoriController::class, 'blk_create'])->name('blk_create');
    Route::get('/admin/direktori/blk/detail/{id}', [DirektoriController::class, 'blk_detail'])->name('blk_detail');
    Route::get('/admin/direktori/blk/edit/{id}', [DirektoriController::class, 'blk_edit'])->name('blk_edit');
    Route::post('/admin/direktori/blk/update/{id}', [DirektoriController::class, 'blk_update'])->name('blk_update');
    Route::post('/admin/direktori/blk/store', [DirektoriController::class, 'blk_store'])->name('blk_store');
    Route::post('/admin/direktori/blk/delete', [DirektoriController::class, 'blk_delete'])->name('blk_delete');

    // KBRI
    Route::get('/admin/direktori/kbri', [DirektoriController::class, 'kbri_index'])->name('kbri_index');
    Route::get('/admin/direktori/kbri/create', [DirektoriController::class, 'kbri_create'])->name('kbri_create');
    Route::get('/admin/direktori/kbri/detail/{id}', [DirektoriController::class, 'kbri_detail'])->name('kbri_detail');
    Route::get('/admin/direktori/kbri/edit/{id}', [DirektoriController::class, 'kbri_edit'])->name('kbri_edit');
    Route::post('/admin/direktori/kbri/update/{id}', [DirektoriController::class, 'kbri_update'])->name('kbri_update');
    Route::post('/admin/direktori/kbri/store', [DirektoriController::class, 'kbri_store'])->name('kbri_store');
    Route::post('/admin/direktori/kbri/delete', [DirektoriController::class, 'kbri_delete'])->name('kbri_delete');

    // P3MI
    Route::get('/admin/direktori/p3mi', [DirektoriController::class, 'p3mi_index'])->name('p3mi_index');
    Route::get('/admin/direktori/p3mi/create', [DirektoriController::class, 'p3mi_create'])->name('p3mi_create');
    Route::get('/admin/direktori/p3mi/detail/{id}', [DirektoriController::class, 'p3mi_detail'])->name('p3mi_detail');
    Route::get('/admin/direktori/p3mi/edit/{id}', [DirektoriController::class, 'p3mi_edit'])->name('p3mi_edit');
    Route::post('/admin/direktori/p3mi/update/{id}', [DirektoriController::class, 'p3mi_update'])->name('p3mi_update');
    Route::post('/admin/direktori/p3mi/store', [DirektoriController::class, 'p3mi_store'])->name('p3mi_store');
    Route::post('/admin/direktori/p3mi/delete', [DirektoriController::class, 'p3mi_delete'])->name('p3mi_delete');

    // P3MI
    Route::get('/admin/direktori/lsp', [DirektoriController::class, 'lsp_index'])->name('lsp_index');
    Route::get('/admin/direktori/lsp/create', [DirektoriController::class, 'lsp_create'])->name('lsp_create');
    Route::get('/admin/direktori/lsp/detail/{id}', [DirektoriController::class, 'lsp_detail'])->name('lsp_detail');
    Route::get('/admin/direktori/lsp/edit/{id}', [DirektoriController::class, 'lsp_edit'])->name('lsp_edit');
    Route::post('/admin/direktori/lsp/update/{id}', [DirektoriController::class, 'lsp_update'])->name('lsp_update');
    Route::post('/admin/direktori/lsp/store', [DirektoriController::class, 'lsp_store'])->name('lsp_store');
    Route::post('/admin/direktori/lsp/delete', [DirektoriController::class, 'lsp_delete'])->name('lsp_delete');
    
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('layouts/app');
// })->name('dashboard');


// Order is important in route file. Put the most generic in last.
Route::get('/browse/filter', [PostController::class, 'cari'])->name('post_cari');
Route::get('/p/{slug}', [PageController::class, 'show'])->name('page_show');
Route::get('/pengumuman', [PengumumanController::class, 'front'])->name('pengumuman_front');
Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman_show');
Route::get('/prodesmigratif', [ProdesmigratifController::class, 'front'])->name('prodesmigratif_front');
Route::get('/prodesmigratif/ft', [ProdesmigratifController::class, 'kategori_front'])->name('prodesmigratif_kategori_front');
Route::get('/prodesmigratif/s', [ProdesmigratifController::class, 'search_front'])->name('prodesmigratif_search_front');
Route::get('/prodesmigratif/{slug}', [ProdesmigratifController::class, 'show'])->name('prodesmigratif_show');
Route::get('/portal', [PostController::class, 'portal'])->name('post_portal');
Route::get('/{kategori}/{slug}', [PostController::class, 'show'])->name('post_show');
Route::get('/{kategori}', [PostController::class, 'post_category'])->name('post_category');

