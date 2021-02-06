<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterKategoriLine as MasterKategoriLine;
use App\Models\Pengaduan as Pengaduan;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PengaduanController extends Controller
{

    public function index_json(Request $request)
    {

        $pengaduan = Pengaduan::whereNull('delete_date')->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return Datatables::of($pengaduan)
            ->editColumn('no_pengaduan', function($data){
                return  '<a class="font-15 font-weight-bold" href="' . route('pengaduan_detail', $data->id) .'">#' 
                        . $data->no_pengaduan . '</a><br>
                        <span class="font-13 font-weight-500">' . \Carbon\Carbon::parse($data->tgl_pengaduan)->format('d-m-Y') . '</span>';
            })
            ->editColumn('nama_peng', function($data){
                return  '<div class="font-14 font-weight-bold text-dark">' .  $data->nama_peng  . '</div>
                        <div class="font-13 font-weight-bold">Hubungan: ' . $data->hubungan_tki . '</div>
                        <div class="mt-2 font-12 font-weight-500">' . $data->alamat_peng . '</div>';
            })
            ->editColumn('nama_tki', function($data){
                return  '<span class="font-14 font-weight-bold text-dark">' .  $data->nama_tki  . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->tmp_lahir . ', ' . $data->tgl_lahir. '</span><br>
                        <span class="font-13 font-weight-500">' . $data->no_paspor . '</span>';
            })
            ->editColumn('nama_majikan', function($data){
                return  '<span class="font-14 font-weight-bold text-dark">' .  $data->nama_majikan  . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->alamat_majikan . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->negara . '</span>';
            })
            ->editColumn('status_kasus', function($data){
                if($data->status_kasus == "B"){
                    return '<span class="bg-warning text-white py-1 px-2 rounded">Belum</span>';
                }
                elseif($data->status_kasus == "P"){
                    return '<span class="bg-primary text-white py-1 px-2 rounded">Proses</span>';
                }
                else{
                    return '<span class="bg-success text-white py-1 px-2 rounded">Selesai</span>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail/Ubah/Hapus">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('pengaduan_detail', $data->id) . '"><i class="far fa-file-alt font-14 mr-2"></i> Detail</a>
                    <a class="dropdown-item text-primary" href="' . route('pengaduan_edit', $data->id) . '"> <i class="fas fa-edit font-13 mr-2"></i>Ubah</a>
                    <a class="dropdown-item text-danger" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter" >
                    <i class="fas fa-times font-15 mr-2"></i> Hapus</a>
                </div>';
            })
            ->rawColumns(['no_pengaduan','nama_peng','nama_tki','nama_majikan','status_kasus','action'])
            ->toJson();
        }
    }

    public function sampah_json(Request $request)
    {

        $pengaduan = Pengaduan::whereNotNull('delete_date')->orderBy('delete_date', 'DESC')->get();

        if ($request->ajax()) {
            return Datatables::of($pengaduan)
            ->editColumn('no_pengaduan', function($data){
                return  '<a class="font-15 font-weight-bold" href="' . route('pengaduan_detail', $data->id) .'">#' 
                        . $data->no_pengaduan . '</a><br>
                        <span class="font-13 font-weight-500">' . \Carbon\Carbon::parse($data->tgl_pengaduan)->format('d-m-Y') . '</span>';
            })
            ->editColumn('nama_peng', function($data){
                return  '<span class="font-14 font-weight-bold text-dark">' .  $data->nama_peng  . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->alamat_peng . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->hubungan_tki . '</span>';
            })
            ->editColumn('nama_tki', function($data){
                return  '<span class="font-14 font-weight-bold text-dark">' .  $data->nama_tki  . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->tmp_lahir . ', ' . $data->tgl_lahir. '</span><br>
                        <span class="font-13 font-weight-500">' . $data->no_paspor . '</span>';
            })
            ->editColumn('nama_majikan', function($data){
                return  '<span class="font-14 font-weight-bold text-dark">' .  $data->nama_majikan  . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->alamat_majikan . '</span><br>
                        <span class="font-13 font-weight-500">' . $data->negara . '</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                <a class="ml-1" href="" id="btnRestore"  onclick="$(' . "'#idRestore'" . ').val(' . "'$data->id'".');" title="Kembalikan Data" 
                data-toggle="modal" data-target="#modalRestore"> <i class="fas fa-reply text-success"></i></a>
                    <a class="ml-1" href="" id="btnDestroy"  onclick="$(' . "'#idDestroy'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#modalDestroy"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['no_pengaduan','nama_peng','nama_tki','nama_majikan','action'])
            ->toJson();
        }
    }

    public function getPengaduanAsal(){
        $pengaduan_asal = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'm_pengaduan_asal')
                ->get();
        return [$pengaduan_asal];
    }

    public function getImigrasi(){
        $imigrasi = DB::table('master_kategori_line')
                    ->select('id', 'name', 'jenis_id')
                    ->where('jenis', 'm_kantor_imigrasi')
                    ->get();
        return [$imigrasi];
    }
    public function getPendidikan(){
        $pendidikan = DB::table('master_kategori_line')
                    ->select('id', 'name', 'jenis_id')->where('jenis', 'm_pendidikan')
                    ->get();
        return [$pendidikan];
    }
    
    public function getNegara(){
        $negara = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'm_negara')
                ->get();
        return [$negara];
    }
    public function getSektor(){
        $sektor = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'm_sektor')
                ->get();
        return [$sektor];
    }
    public function getPekerjaan(Request $request){
        $pekerjaan = DB::table('master_kategori_line')
                    ->select('id', 'name', 'jenis_id')
                    ->where('jenis', 'm_pekerjaan')
                    ->where('join1', 'm_sektor')
                    ->where('join1_id', $request->nmSektor)
                    ->get();
        return json_encode($pekerjaan);
    }
    public function getProvinsi(){
        $provinsi = DB::table('kedatangan_provinsi')->get();
        return [$provinsi];
    }
    public function getKabKota(Request $request){
        $kabkota = DB::table('kedatangan_kabkota')->select('id', 'nama')
                    ->where('provinsi_id', $request->nmProvinsi)->get();
        return json_encode($kabkota);
    }
    public function getKecamatan(Request $request){
        $kecamatan = DB::table('pmi_kecamatan')
                ->where('kabkota_id', $request->nmKabKota)->get();
        return json_encode($kecamatan);
    }
    public function getDesa(Request $request){
        $desa = DB::table('kedatangan_desa')->where('kecamatan_id', $request->nmKecamatan)->get();
        return json_encode($desa);
    }
    public function getPerusahaan(){
        $perusahaan = DB::table('pmi_perusahaan')->select('id','nama')->get();
        return [$perusahaan];
    }
    public function getMasalah(){
        $masalah = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'm_masalah')
                ->get();
        return [$masalah];
    }
    public function getJenisPulang(){
        $jenis_pulang = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'kedatangan_jenis_pulang')
                ->get();
        return [$jenis_pulang];
    }
    public function getPulang(){
        $pulang = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'm_pulang')
                ->get();
        return [$pulang];
    }
    public function getPulangSendiri(){
        $pulang_sendiri = DB::table('master_kategori_line')
                    ->select('id', 'name', 'jenis_id')
                    ->where('jenis', 'm_pulang_sendiri')
                    ->get();
        return [$pulang_sendiri];
    }
    public function getDijemput(){
        $dijemput = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'm_dijemput')
                ->get();
        return [$dijemput];
    }
    public function getSaluran(){
        $saluran = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'm_info_saluran')
                ->get();
        return [$saluran];
    }

    public function getDetailPptkis(Request $request){
        $detail_pptkis = DB::table('master_pengirim')
                    ->select('id', 'alamat', 'telepon')
                    ->where('id', $request->nmPptkis)
                    ->first();
        return json_encode($detail_pptkis);
    }


    public function index()
    {
        $jumlahSampah = Pengaduan::whereNotNull('delete_date')->count();
        return view('sistem.pengaduan.index', ['jumlahSampah' => $jumlahSampah]);
    }
    public function index_sampah()
    {
        return view('sistem.pengaduan.sampah');
    }
    public function create()
    {
        list($pengaduan_asal) = $this->getPengaduanAsal();
        list($imigrasi) = $this->getImigrasi();
        list($pendidikan) = $this->getPendidikan();
        list($provinsi) = $this->getProvinsi();
        list($perusahaan) = $this->getPerusahaan();
        list($negara) = $this->getNegara();
        list($sektor) = $this->getSektor();
        list($masalah) = $this->getMasalah();
        list($jenis_pulang) = $this->getJenisPulang();
        list($pulang) = $this->getPulang();
        list($pulang_sendiri) = $this->getPulangSendiri();
        list($dijemput) = $this->getDijemput();
        list($saluran) = $this->getSaluran();

        $cek_pengaduan = 0;
        $file_krono = [];
        $status = 'baru';

        return view('sistem.pengaduan.create', [
            'pengaduan_asal' => $pengaduan_asal,
            'imigrasi' => $imigrasi,
            'pendidikan' => $pendidikan,
            'jenis_pulang' => $jenis_pulang,
            'pulang' => $pulang,
            'pulang_sendiri' => $pulang_sendiri,
            'sektor' => $sektor,
            'provinsi' => $provinsi,
            'perusahaan' => $perusahaan,
            'negara' => $negara,
            'sektor' => $sektor,
            'masalah' => $masalah,
            'pulang' => $pulang,
            'pulang_sendiri' => $pulang_sendiri,
            'dijemput' => $dijemput,
            'saluran' => $saluran,
            'cek_pengaduan' => $cek_pengaduan,
            'file_krono' => $file_krono,
            'status' => $status,
        ]);
    }

    public function saveData(Request $request)
    {
        $this->validate($request, 
        ['nmTKI' => 'required'],
        ['nmTKI.required' => '* Nama TKI harus diisi']
        );

        $user = Auth::user();

        $status = $request->nmStatus;

        if($status == "baru"){
            $pengaduan = new Pengaduan();

            $format = now()->format('Y') . now()->format('m');
            $cek_previous = DB::table('pengaduan')
                                ->where('no_pengaduan', 'like', '%' . $format . '%')
                                ->orderby('no_pengaduan', 'DESC')
                                ->pluck('no_pengaduan')
                                ->first();
            $cek_previous = Str::substr($cek_previous, -4);
            $format_final = $format.$cek_previous+1;
            $no_pengaduan =  $format_final;
            
            $pengaduan->no_pengaduan = $no_pengaduan;

            $pengaduan->user_ref = $user->id;
            $pengaduan->create_uid = $user->id;
            $pengaduan->create_date = now();
        }
        else{
            $pengaduan = Pengaduan::find($request->nmID);
            $pengaduan->write_uid = $user->id;
            $pengaduan->write_date = now();
        }

        // Pengadu

        
        $pengaduan->pengaduan_asal = $request->nmPengaduanAsal;
        $pengaduan->tgl_pengaduan = $request->nmTglPengaduan;
        $pengaduan->nama_peng = $request->nmNamaPengadu;
        $pengaduan->alamat_peng = $request->nmAlamatPengadu;
        $pengaduan->hubungan_tki = $request->nmHubunganTKI;
        $pengaduan->email = $request->nmEmailPengadu;
        $pengaduan->telepon = $request->nmTeleponPengadu;
        $pengaduan->info_saluran = $request->nmSaluranPengaduan;

        // TKI
        $pengaduan->tgl_berangkat = $request->nmTglBerangkat;
        $pengaduan->tgl_datang = $request->nmTglDatang;
        $pengaduan->no_paspor = $request->nmPaspor;
        $pengaduan->nama_tki = $request->nmTKI;
        $pengaduan->tgl_lahir = $request->nmTglLahir;
        $pengaduan->tmp_lahir = $request->nmTempatLahir;
        $pengaduan->status = $request->nmStatusKawin;
        $pengaduan->jk = $request->nmJK;
        $pengaduan->pendidikan = $request->nmPendidikan;
        $pengaduan->provinsi = $request->nmProvinsi;
        $pengaduan->kabkota = $request->nmKabKota;
        $pengaduan->kecamatan = $request->nmKecamatan;
        $pengaduan->desa = $request->nmDesa;
        $pengaduan->alamat = $request->nmAlamat;
        $pengaduan->pptkis = $request->nmPptkis;
        $pengaduan->alamat_pptkis = $request->nmAlamatPptkis;
        $pengaduan->negara = $request->nmNegara;
        $pengaduan->sektor = $request->nmSektor;
        $pengaduan->pekerjaan = $request->nmPekerjaan;
        $pengaduan->jabatan = $request->nmJabatan;
        $pengaduan->nama_majikan = $request->nmNamaMajikan;
        $pengaduan->alamat_majikan = $request->nmAlamatMajikan;
        $pengaduan->masalah_lainnya = $request->nmMasalahLainnya;
        

        // Detail Masalah
        $detail_masalah = $request->nmDetailMasalah;
        if($detail_masalah){
            $dom = new \DomDocument();
            $dm_filter = str_replace("\0", '', $detail_masalah);
            @$dom->loadHtml($dm_filter, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);   
            $dm_filter = $dom->saveHTML();
            $pengaduan->detail_masalah = $dm_filter;
        }

        // Kronologis Masalah
        $kronologis_masalah = $request->nmKronologis;
        if($kronologis_masalah){
            $dom = new \DomDocument();
            $km_filter = str_replace("\0", '', $kronologis_masalah);
            @$dom->loadHtml($km_filter, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);   
            $km_filter = $dom->saveHTML();
            $pengaduan->uraian_kronologis = $km_filter;
        }

        // Tuntutan Pengadu
        $tuntutan = $request->nmTuntutan;
        if($tuntutan){
            $dom = new \DomDocument();
            $tuntutan_filter = str_replace("\0", '', $tuntutan);
            @$dom->loadHtml($tuntutan_filter, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);   
            $tuntutan_filter = $dom->saveHTML();
            $pengaduan->tuntutan_pengadu = $tuntutan_filter;
        }

        $pengaduan->save();

        // Save Masalah
        if($status == "edit"){
            DB::table('t_masalah_pengaduan')->where('pengaduan_id', $request->nmID)->delete();
        }

        if(isset($request->nmMasalah)){
            foreach($request->nmMasalah as $x => $value){
                DB::table('t_masalah_pengaduan')->insert(
                    [
                        'pengaduan_id' => $pengaduan->id,
                        'masalah_id' => $value,
                    ]
                    );
            }
        }

        $file_krono =   $request->file('nmFileKrono');
        $folder =  public_path().'/uploads/file/pengaduan/kronologis';

        if (! File::exists($folder)) {
            File::makeDirectory($folder, 0777,true);
        }
    
        if($file_krono){
            foreach ($file_krono as $fk  => $value) {
                $originalFile = $value->getClientOriginalName();
                $originalFile = str_replace(" ", '_', $originalFile);
                // $extensionFile = $value->getClientOriginalExtension();
                $filename = uniqid() . strtotime(date('Y-m-H:isa')).$originalFile;
                $value->move($folder, $filename);

                $file_kronologis[] = [
                    'pengaduan_id' => $pengaduan->id,
                    'nmFile' => $filename,
                    ];
                    
                }

            if($file_krono[0] !== null){
                DB::table('pengaduan_file_krono')->insert($file_kronologis);
            } 
        }

        if($status == "edit"){
            $id_file_krono = $request->nmHapusFileKrono;
            if($id_file_krono !== null){   

                foreach ($id_file_krono as $hapus_krono => $value) {
                    $cek_krono = DB::table('pengaduan_file_krono')
                                ->where('id', $value)
                                ->pluck('nmfile');
                                
                    DB::table('pengaduan_file_krono')
                    ->where('id', $value)
                    ->delete();

                    $cek_krono =   arr::flatten($cek_krono);
                    array_walk($cek_krono, function (&$file_value, $key) {
                        $file_value ="uploads/file/pengaduan/$file_value";
                    });

                    File::delete($cek_krono);
                }
                
            }
        }

        return [$pengaduan];
    }

    public function store(Request $request)
    {
        list($pengaduan) = $this->saveData($request);
        return redirect()->route('pengaduan_detail', $pengaduan->id)->with('success', 'Pengaduan Baru Telah Ditambahkan');
    }

    public function edit($id)
    {
        list($pengaduan_asal) = $this->getPengaduanAsal();
        list($imigrasi) = $this->getImigrasi();
        list($pendidikan) = $this->getPendidikan();
        list($provinsi) = $this->getProvinsi();
        list($perusahaan) = $this->getPerusahaan();
        list($negara) = $this->getNegara();
        list($sektor) = $this->getSektor();
        list($masalah) = $this->getMasalah();
        list($jenis_pulang) = $this->getJenisPulang();
        list($pulang) = $this->getPulang();
        list($pulang_sendiri) = $this->getPulangSendiri();
        list($dijemput) = $this->getDijemput();
        list($saluran) = $this->getSaluran();

        $t_masalah = DB::table('t_masalah_pengaduan')->where('pengaduan_id', $id)->pluck('masalah_id');
        $t_masalah = arr::flatten($t_masalah);

        $file_krono = DB::table('pengaduan_file_krono')->where('pengaduan_id', $id)->get();

        $pengaduan = Pengaduan::find($id);
        $cek_pengaduan = 1;
        $status = 'edit';
        return view('sistem.pengaduan.edit', [
            'pengaduan' => $pengaduan,
            'pengaduan_asal' => $pengaduan_asal,
            'imigrasi' => $imigrasi,
            'pendidikan' => $pendidikan,
            'jenis_pulang' => $jenis_pulang,
            'pulang' => $pulang,
            'pulang_sendiri' => $pulang_sendiri,
            'sektor' => $sektor,
            'provinsi' => $provinsi,
            'perusahaan' => $perusahaan,
            'negara' => $negara,
            'sektor' => $sektor,
            'masalah' => $masalah,
            'pulang' => $pulang,
            'pulang_sendiri' => $pulang_sendiri,
            'dijemput' => $dijemput,
            'saluran' => $saluran,
            't_masalah' => $t_masalah,
            'cek_pengaduan' => $cek_pengaduan,
            'file_krono' => $file_krono,
            'status' => $status,
        ]);
    }
    public function detail($id)
    {
        $pengaduan = Pengaduan::find($id);

        $pengaduan_asal = DB::table('master_kategori_line')
                            ->where('jenis', 'm_pengaduan_asal')
                            ->where('jenis_id', $pengaduan->pengaduan_asal)
                            ->pluck('name')->first();
        $pptkis = DB::table('master_pengirim')->where('id', $pengaduan->pptkis)
                    ->pluck('nama')->first();
        $provinsi = DB::table('kedatangan_provinsi')->where('id', $pengaduan->provinsi)
                    ->pluck('nama')->first();
        $kabkota = DB::table('kedatangan_kabkota')->where('id', $pengaduan->kabkota)
                    ->pluck('nama')->first();
        $kecamatan = DB::table('pmi_kecamatan')->where('id', $pengaduan->kecamatan)
                    ->pluck('nama')->first();
        $desa = DB::table('kedatangan_desa')->where('id', $pengaduan->desa)
                    ->pluck('nama')->first();
        $sektor = DB::table('master_kategori_line')
                    ->where('jenis', 'm_sektor')
                    ->where('jenis_id', $pengaduan->sektor)
                    ->pluck('name')->first();
        $pekerjaan = DB::table('master_kategori_line')
                    ->where('jenis', 'm_pekerjaan')
                    ->where('jenis_id', $pengaduan->pekerjaan)
                    ->pluck('name')->first();
        $pendidikan = DB::table('master_kategori_line')
                    ->where('jenis', 'm_pendidikan')
                    ->where('jenis_id', $pengaduan->pendidikan)
                    ->pluck('name')->first();
        $negara = DB::table('master_kategori_line')
                    ->where('jenis', 'm_negara')
                    ->where('jenis_id', $pengaduan->negara)
                    ->pluck('name')->first();
        $info_saluran = DB::table('master_kategori_line')
                    ->where('jenis', 'm_info_saluran')
                    ->where('jenis_id', $pengaduan->info_saluran)
                    ->pluck('name')->first();

        $masalah_id = DB::table('t_masalah_pengaduan')->where('pengaduan_id', $id)->pluck('masalah_id');

        $masalah = DB::table('master_kategori_line')
                ->where('jenis', 'm_masalah')
                ->whereIn('jenis_id', $masalah_id)
                ->pluck('name');


        $file_krono = DB::table('pengaduan_file_krono')->where('pengaduan_id', $id)->get();
        $file_awal = DB::table('pengaduan_file_awal')->where('pengaduan_id', $id)->get();
        $file_proses = DB::table('pengaduan_file_proses')->where('pengaduan_id', $id)->get();
        $file_akhir = DB::table('pengaduan_file_akhir')->where('pengaduan_id', $id)->get();
        $file_foto = DB::table('pengaduan_file_foto')->where('pengaduan_id', $id)->get();

        $respon = DB::table('pengaduan_respon')
                ->select('pengaduan_respon.*', 'users.*', 'pengaduan_respon.id as id_respon')
                ->join('users', 'users.id', '=', 'pengaduan_respon.user_id')
                ->where('pengaduan_id', $id)
                ->orderby('pengaduan_respon.id', 'desc')
                ->get();

        return view('sistem.pengaduan.detail', [
            'pengaduan' => $pengaduan,
            'pengaduan_asal' => $pengaduan_asal,
            'pptkis' => $pptkis,
            'provinsi' => $provinsi,
            'kabkota' => $kabkota,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'sektor' => $sektor,
            'pekerjaan' => $pekerjaan,
            'pendidikan' => $pendidikan,
            'negara' => $negara,
            'info_saluran' => $info_saluran,
            'masalah' => $masalah,
            'file_krono' => $file_krono,
            'file_awal' => $file_awal,
            'file_proses' => $file_proses,
            'file_akhir' => $file_akhir,
            'file_foto' => $file_foto,
            'respon' => $respon,
        ]);
    }
    public function update(Request $request)
    {
        
        list($pengaduan) = $this->saveData($request);
        return redirect()->route('pengaduan_detail', $pengaduan->id)->with('success', 'Data Pengaduan TKI telah diperbarui');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $id = $request->idDelete;
        $pengaduan = Pengaduan::find($id);
        $pengaduan->delete_uid = $user->id;
        $pengaduan->delete_date = now();
        $pengaduan->save();
        return redirect()->route('pengaduan_index')->with('success', 'Data Pengaduan TKI telah dihapus dan dimasukkan ke dalam keranjang sampah');
    }

    public function restore(Request $request)
    {
        $user = Auth::user();
        $id = $request->idRestore;
        $pengaduan = Pengaduan::find($id);
        $pengaduan->delete_uid = null;
        $pengaduan->delete_date = null;
        $pengaduan->save();
        
        if($request->nmStatus == "sampah"){
            $route = 'pengaduan_sampah';
        }
        else{
            $route = 'pengaduan_index';
        }
        return redirect()->route($route)->with('success', 'Data Pengaduan TKI telah dikembalikan');
    }

    public function destroy(Request $request)
    {
        $id = $request->idDestroy;

        Pengaduan::find($id)->delete();

        $file_krono = DB::table('pengaduan_file_krono')->where('pengaduan_id', $id)->pluck('id');
        
        if($file_krono !== null){   

            foreach ($file_krono as $hapus_krono => $value) {
                $cek_krono = DB::table('pengaduan_file_krono')
                            ->where('id', $value)
                            ->pluck('nmfile');
                            
                DB::table('pengaduan_file_krono')
                ->where('id', $value)
                ->delete();

                $cek_krono =   arr::flatten($cek_krono);
                array_walk($cek_krono, function (&$file_value, $key) {
                    $file_value ="uploads/file/pengaduan/$file_value";
                });

                File::delete($cek_krono);
            }
            
        }
        
        if($request->nmStatus == "sampah"){
            $route = 'pengaduan_sampah';
        }
        else{
            $route = 'pengaduan_index';
        }
        
        return redirect()->route($route)->with('success', 'Data Pengaduan TKI telah dihapus');
    }


    public function penanganan($id)
    {
        $pengaduan = Pengaduan::find($id);
        

        $file_awal = DB::table('pengaduan_file_awal')->where('pengaduan_id', $id)->get();
        $file_proses = DB::table('pengaduan_file_proses')->where('pengaduan_id', $id)->get();
        $file_akhir = DB::table('pengaduan_file_akhir')->where('pengaduan_id', $id)->get();
        $file_foto = DB::table('pengaduan_file_foto')->where('pengaduan_id', $id)->get();

        return view('sistem.pengaduan.penanganan', [
            'pengaduan' => $pengaduan,
            'file_awal' => $file_awal,
            'file_proses' => $file_proses,
            'file_akhir' => $file_akhir,
            'file_foto' => $file_foto,
        ]);
    }

    

    public function penanganan_store(Request $request, $id)
    {
        $user = Auth::user();
        $pengaduan = Pengaduan::find($id);
        $pengaduan->tahap_awal = $request->nmTahapAwal;
        $pengaduan->tahap_proses = $request->nmTahapProses;
        $pengaduan->tahap_akhir = $request->nmTahapAkhir;
        $pengaduan->status_kasus = $request->nmStatusKasus;
        $pengaduan->status_uid = $user->id;
        $pengaduan->status_date = now();
        $pengaduan->save();


        // Upload File Awal

        $file_awal =   $request->file('nmFileTahapAwal');
        $folder_awal =  public_path().'/uploads/file/pengaduan/awal';

        if (! File::exists($folder_awal)) {
            File::makeDirectory($folder_awal, 0777,true);
        }
    
        if($file_awal){
            foreach ($file_awal as $fa  => $value_awal) {
                $originalFileAwal = $value_awal->getClientOriginalName();
                $originalFileAwal = str_replace(" ", '_', $originalFileAwal);
                // $extensionFile = $value_awal->getClientOriginalExtension();
                $filename_awal = uniqid() . strtotime(date('Y-m-H:isa')).$originalFileAwal;
                $value_awal->move($folder_awal, $filename_awal);

                $saveFileAwal[] = [
                    'pengaduan_id' => $pengaduan->id,
                    'nmFile' => $filename_awal,
                    ];
                    
                }

            if($file_awal[0] !== null){
                DB::table('pengaduan_file_awal')->insert($saveFileAwal);
            } 
        }

        // Hapus File Awal
        $id_file_awal = $request->nmHapusFileAwal;
        
        if($id_file_awal !== null){   

            foreach ($id_file_awal as $hapus_awal => $value_awal) {
                $cek_awal = DB::table('pengaduan_file_awal')
                            ->where('id', $value_awal)
                            ->pluck('nmfile');
                            
                DB::table('pengaduan_file_awal')
                ->where('id', $value_awal)
                ->delete();

                $cek_awal =   arr::flatten($cek_awal);
                array_walk($cek_awal, function (&$file_value_awal, $key) {
                    $file_value_awal ="uploads/file/pengaduan/awal/$file_value_awal";
                });

                File::delete($cek_awal);
            }
            
        }


        // Upload File Proses

        $file_proses =   $request->file('nmFileTahapProses');
        $folder_proses =  public_path().'/uploads/file/pengaduan/proses';

        if (! File::exists($folder_proses)) {
            File::makeDirectory($folder_proses, 0777,true);
        }
    
        if($file_proses){
            foreach ($file_proses as $fp  => $value_proses) {
                $originalFileProses = $value_proses->getClientOriginalName();
                $originalFileProses = str_replace(" ", '_', $originalFileProses);
                // $extensionFile = $value_proses->getClientOriginalExtension();
                $filename_proses = uniqid() . strtotime(date('Y-m-H:isa')).$originalFileProses;
                $value_proses->move($folder_proses, $filename_proses);

                $saveFileProses[] = [
                    'pengaduan_id' => $pengaduan->id,
                    'nmFile' => $filename_proses,
                    ];
                    
                }

            if($file_proses[0] !== null){
                DB::table('pengaduan_file_proses')->insert($saveFileProses);
            } 
        }

        // Hapus File Proses
        $id_file_proses = $request->nmHapusFileProses;
        
        if($id_file_proses !== null){   

            foreach ($id_file_proses as $hapus_proses => $value_proses) {
                $cek_proses = DB::table('pengaduan_file_proses')
                            ->where('id', $value_proses)
                            ->pluck('nmfile');
                            
                DB::table('pengaduan_file_proses')
                ->where('id', $value_proses)
                ->delete();

                $cek_proses =   arr::flatten($cek_proses);
                array_walk($cek_proses, function (&$file_value_proses, $key) {
                    $file_value_proses ="uploads/file/pengaduan/proses/$file_value_proses";
                });

                File::delete($cek_proses);
            }
            
        }

        // Upload File Akhir

        $file_akhir =   $request->file('nmFileTahapAkhir');
        $folder_akhir =  public_path().'/uploads/file/pengaduan/akhir';

        if (! File::exists($folder_akhir)) {
            File::makeDirectory($folder_akhir, 0777,true);
        }
    
        if($file_akhir){
            foreach ($file_akhir as $fp  => $value_akhir) {
                $originalFileAkhir = $value_akhir->getClientOriginalName();
                $originalFileAkhir = str_replace(" ", '_', $originalFileAkhir);
                // $extensionFile = $value_akhir->getClientOriginalExtension();
                $filename_akhir = uniqid() . strtotime(date('Y-m-H:isa')).$originalFileAkhir;
                $value_akhir->move($folder_akhir, $filename_akhir);

                $saveFileAkhir[] = [
                    'pengaduan_id' => $pengaduan->id,
                    'nmFile' => $filename_akhir,
                    ];
                    
                }

            if($file_akhir[0] !== null){
                DB::table('pengaduan_file_akhir')->insert($saveFileAkhir);
            } 
        }

        // Hapus File Akhir
        $id_file_akhir = $request->nmHapusFileAkhir;
        
        if($id_file_akhir !== null){   

            foreach ($id_file_akhir as $hapus_akhir => $value_akhir) {
                $cek_akhir = DB::table('pengaduan_file_akhir')
                            ->where('id', $value_akhir)
                            ->pluck('nmfile');
                            
                DB::table('pengaduan_file_akhir')
                ->where('id', $value_akhir)
                ->delete();

                $cek_akhir =   arr::flatten($cek_akhir);
                array_walk($cek_akhir, function (&$file_value_akhir, $key) {
                    $file_value_akhir ="uploads/file/pengaduan/akhir/$file_value_akhir";
                });

                File::delete($cek_akhir);
            }
            
        }

        // Upload Foto

        $file_foto =   $request->file('nmFileTahapFoto');
        $folder_foto =  public_path().'/uploads/file/pengaduan/foto';

        if (! File::exists($folder_foto)) {
            File::makeDirectory($folder_foto, 0777,true);
        }
    
        if($file_foto){
            foreach ($file_foto as $fp  => $value_foto) {
                $originalFileFoto = $value_foto->getClientOriginalName();
                $originalFileFoto = str_replace(" ", '_', $originalFileFoto);
                // $extensionFile = $value_foto->getClientOriginalExtension();
                $filename_foto = uniqid() . strtotime(date('Y-m-H:isa')).$originalFileFoto;
                $value_foto->move($folder_foto, $filename_foto);

                $saveFileFoto[] = [
                    'pengaduan_id' => $pengaduan->id,
                    'nmFile' => $filename_foto,
                    ];
                    
                }

            if($file_foto[0] !== null){
                DB::table('pengaduan_file_foto')->insert($saveFileFoto);
            } 
        }

        // Hapus File Foto
        $id_file_foto = $request->nmHapusFileFoto;
        
        if($id_file_foto !== null){   

            foreach ($id_file_foto as $hapus_foto => $value_foto) {
                $cek_foto = DB::table('pengaduan_file_foto')
                            ->where('id', $value_foto)
                            ->pluck('nmfile');
                            
                DB::table('pengaduan_file_foto')
                ->where('id', $value_foto)
                ->delete();

                $cek_foto =   arr::flatten($cek_foto);
                array_walk($cek_foto, function (&$file_value_foto, $key) {
                    $file_value_foto ="uploads/file/pengaduan/foto/$file_value_foto";
                });

                File::delete($cek_foto);
            }
            
        }

        return redirect()->route('pengaduan_detail', $pengaduan->id)->with('success', 'Pengaduan telah ditindaklanjuti');
    }

    public function pengaduan_status(Request $request){
        $id = $request->idStatusPengaduan;
        $pengaduan = Pengaduan::find($id);
        if($pengaduan->status === "open"){
            $status = 'closed';
            $info = 'Pengaduan Ditutup dan Dinyatakan Selesai.';
        }
        else{
            $status = 'open';
            $info = 'Pengaduan Dibuka Kembali.';
        }
        $pengaduan->status = $status;
        $pengaduan->save();

        return redirect()->back()->with('pengaduan', $info);
    }

    public function respon(Request $request)
    {
        $id = $request->nmIdPengaduan;
        $user = Auth::user();
        DB::table('pengaduan_respon')->insert([
            'pengaduan_id' => $id,
            'user_id' => $user->id,
            'respon' => $request->nmRespon,
            'create_date' => now(),
        ]);

        return redirect()->back()->with('respon', 'Tanggapan Ditambahkan');
    }

    public function respon_hapus(Request $request)
    {
        $id = $request->nmIdResponHapus;
        DB::table('pengaduan_respon')->where('id', $id)->update([
            'delete_date' => now(),
        ]);

        return redirect()->back()->with('respon', 'Tanggapan Dihapus');
    }

    public function respon_status(Request $request){
        $id = $request->idRespon;
        $pengaduan = Pengaduan::find($id);
        // dd($pengaduan);
        if($pengaduan->status_respon === "open"){
            $status_respon = 'closed';
            $info = 'Kolom Diskusi Ditutup.';
        }
        else{
            $status_respon = 'open';
            $info = 'Kolom Diskusi Dibuka.';
        }
        $pengaduan->status_respon = $status_respon;
        $pengaduan->save();

        return redirect()->back()->with('respon', $info);
    }

}