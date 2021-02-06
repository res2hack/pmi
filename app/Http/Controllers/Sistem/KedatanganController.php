<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterKategoriLine as MasterKategoriLine;
use App\Models\Kedatangan as Kedatangan;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class KedatanganController extends Controller
{

    public function index_json(Request $request)
    {
        $kedatangan = (DB::select(
            DB::raw('SELECT jdatang.id, jdatang.tgl_datang, jdatang.jam_datang, jdatang.nama_tki as nama, 
                    jdatang.no_paspor, jdatang.jk, jdatang.alamat, jdatang.tgl_lahir, kab.nama AS kota, 
                    imigrasi.name AS kantor_imigrasi, jp.name AS pulang, jp.tag1 as warna
            FROM kedatangan jdatang
            LEFT JOIN kedatangan_kabkota kab ON kab.id = jdatang.kabkota
            LEFT JOIN master_kategori_line imigrasi ON imigrasi.jenis_id = jdatang.kantor_imigrasi
            LEFT JOIN master_kategori_line jp ON jp.jenis_id = jdatang.jenis_pulang
            WHERE MONTH(jdatang.tgl_datang) = ' . $request->nmBulan . ' AND
                YEAR (jdatang.tgl_datang) = ' . $request->nmTahun . ' AND imigrasi.jenis = "m_kantor_imigrasi" 
                AND jp.jenis = "m_jenis_pulang" ORDER BY jdatang.id DESC')));

        if ($request->ajax()) {
            return Datatables::of($kedatangan)
            ->editColumn('nama', function($data){
                return  '<a class="font-15 font-weight-bold" href="' . route('kedatangan_detail', $data->id) .'">' 
                        . $data->nama . '</a><br>
                        <span class="font-13 font-weight-bold text-dark">'.  $data->jk  . ' / ' .
                        \Carbon\Carbon::parse($data->tgl_lahir)->format('d-m-Y') . '</span><br><span class="font-13 font-weight-500">Alamat: '. $data->alamat . '</span>';
            })
            ->editColumn('no_paspor', function($data){
                return  '<span class="font-14 font-weight-bold text-dark">' .  $data->no_paspor  . '</span><br>
                        <span class="font-14 font-weight-500">Imigrasi: ' .  $data->kantor_imigrasi  . '</span>';
            })
            ->editColumn('tgl_datang', function($data){
                return  '<span class="font-14 font-weight-bold text-dark">' . \Carbon\Carbon::parse($data->tgl_datang)->format('d-m-Y')  
                        . '</span><br><span class="font-14 text-danger font-weight-500">' . $data->jam_datang.'</span>';
            })
            ->editColumn('pulang', function($data){
                return  '<span class="font-13 font-weight-500 text-white 
                            bg-'. $data->warna .' rounded py-1 px-2">'. $data->pulang.'</span>';
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('kedatangan_edit',  $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['nama','no_paspor','tgl_datang','pulang','action'])
            ->toJson();
        }
    }

    public function getPesawat(){
        $pesawat = DB::table('master_kategori_line')
                    ->select('id', 'name', 'kode', 'jenis_id')
                    ->where('jenis', 'm_pesawat')
                    ->get();
        return [$pesawat];
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
        $kecamatan = DB::table('kedatangan_pengirim')
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

    public function index()
    {
        $bulan = DB::table('master_kategori_line')->select('id', 'jenis_id', 'kode', 'name')
                ->where('jenis', 'm_bulan')
                ->get();
        return view('sistem.kedatangan.index', [
            'bulan' => $bulan
        ]);
    }

    public function create()
    {
        list($pesawat) = $this->getPesawat();
        list($imigrasi) = $this->getImigrasi();
        list($pendidikan) = $this->getPendidikan();
        list($pulang) = $this->getPulang();
        list($pulang_sendiri) = $this->getPulangSendiri();
        list($sektor) = $this->getSektor();
        list($provinsi) = $this->getProvinsi();
        list($perusahaan) = $this->getPerusahaan();
        list($negara) = $this->getNegara();
        list($masalah) = $this->getMasalah();
        list($jenis_pulang) = $this->getJenisPulang();
        list($pulang) = $this->getPulang();
        list($pulang_sendiri) = $this->getPulangSendiri();
        list($dijemput) = $this->getDijemput();
        
        $kedatangan = '';
        return view('sistem.kedatangan.create', [
            'pesawat' => $pesawat,
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
            'kedatangan' => $kedatangan,
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
            $kedatangan = new Kedatangan();
        }
        else{
            $kedatangan = Kedatangan::find($request->nmID);
        }
        $kedatangan->tgl_berangkat = $request->nmTglBerangkat;
        $kedatangan->masa_kerja = $request->nmMasaKerja;

        $kedatangan->tgl_datang = $request->nmTglDatang;
        $kedatangan->jam_datang = $request->nmJamDatang;
        $kedatangan->pesawat = $request->nmPesawat;
        $kedatangan->no_paspor = $request->nmPaspor;
        $kedatangan->kantor_imigrasi = $request->nmImigrasi;
        $kedatangan->nama_tki = $request->nmTKI;
        $kedatangan->tgl_lahir = $request->nmTglLahir;
        $kedatangan->jk = $request->nmJK;
        $kedatangan->pendidikan = $request->nmPendidikan;
        $kedatangan->provinsi = $request->nmProvinsi;
        $kedatangan->kabkota = $request->nmKabKota;
        $kedatangan->kecamatan = $request->nmKecamatan;
        $kedatangan->desa = $request->nmDesa;
        $kedatangan->alamat = $request->nmAlamat;
        $kedatangan->pptkis = $request->nmPptkis;
        $kedatangan->agency = $request->nmAgency;
        $kedatangan->negara = $request->nmNegara;
        $kedatangan->sektor = $request->nmSektor;
        $kedatangan->pekerjaan = $request->nmPekerjaan;
        $kedatangan->jenis_pulang = $request->nmJenisPulang;
        $kedatangan->hari = $request->nmPulangHari;
        $kedatangan->keterangan = $request->nmKeterangan;
        $kedatangan->jemput_nama = $request->nmJemputNama;
        $kedatangan->petugas_pptkis = $request->nmPetugas;
        $kedatangan->taksi = $request->nmTaksi;
        $kedatangan->lainnya = $request->nmLainnya;

        $kepulangan = $request->nmKepulangan;
        $kedatangan->kepulangan = $kepulangan;
        if($kepulangan == 1){
            $kedatangan->pulang_sendiri = 0;
            $kedatangan->dijemput = $request->nmDijemput;
            $kedatangan->dijemput_oleh = $request->nmDijemputOleh;
        }
        if($kepulangan == 2){
            $kedatangan->dijemput = 0;
            $kedatangan->pulang_sendiri = $request->nmPulangSendiri;
            $kedatangan->menggunakan = $request->nmMenggunakan;
            $kedatangan->transit_kantor = null;
        }
        if($kepulangan == 3){
            $kedatangan->transit_kantor = $request->nmTransit;
            $kedatangan->pulang_sendiri = 0;
            $kedatangan->menggunakan = null;
        }
        
        $kedatangan->masalah_lainnya = $request->nmMasalahLain;
        $kedatangan->user = $user->id;
        $kedatangan->save();

        // Save Masalah

        if(isset($request->nmMasalah)){
            foreach($request->nmMasalah as $x => $value){
                DB::table('t_masalah')->insert(
                    [
                        'kedatangan_id' => $kedatangan->id,
                        'masalah_id' => $value,
                    ]
                    );
            }
        }

        return [$kedatangan];
    }

    public function store(Request $request)
    {
        list($kedatangan) = $this->saveData($request);
        return redirect()->route('kedatangan_detail', $kedatangan->id)->with('success', 'Jadwal Petugas baru telah ditambahkan');
    }

    public function edit($id)
    {
        list($pesawat) = $this->getPesawat();
        list($imigrasi) = $this->getImigrasi();
        list($pendidikan) = $this->getPendidikan();
        list($pulang) = $this->getPulang();
        list($pulang_sendiri) = $this->getPulangSendiri();
        list($sektor) = $this->getSektor();
        list($provinsi) = $this->getProvinsi();
        list($perusahaan) = $this->getPerusahaan();
        list($negara) = $this->getNegara();
        list($masalah) = $this->getMasalah();
        list($jenis_pulang) = $this->getJenisPulang();
        list($pulang) = $this->getPulang();
        list($pulang_sendiri) = $this->getPulangSendiri();
        list($dijemput) = $this->getDijemput();

        $t_masalah = DB::table('t_masalah')->where('kedatangan_id', $id)->pluck('masalah_id');
        $t_masalah = arr::flatten($t_masalah);
        $kedatangan = Kedatangan::find($id);

        return view('sistem.kedatangan.edit', [
            'pesawat' => $pesawat,
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
            't_masalah' => $t_masalah,
            'kedatangan' => $kedatangan,
        ]);
    }
    public function detail($id)
    {
        $kedatangan = Kedatangan::find($id);

        $pesawat = DB::table('master_kategori_line')->select('name', 'kode')
                    ->where('jenis', 'm_pesawat')
                    ->where('jenis_id', $kedatangan->pesawat)
                    ->first();
        $provinsi = DB::table('kedatangan_provinsi')->where('id', $kedatangan->provinsi)
                    ->pluck('nama')->first();
        $kabkota = DB::table('kedatangan_kabkota')->where('id', $kedatangan->kabkota)
                    ->pluck('nama')->first();
        $kecamatan = DB::table('kedatangan_pengirim')->where('id', $kedatangan->kecamatan)
                    ->pluck('nama')->first();
        $desa = DB::table('kedatangan_desa')->where('id', $kedatangan->desa)
                    ->pluck('nama')->first();
        $sektor = DB::table('master_kategori_line')
                    ->where('jenis', 'm_sektor')
                    ->where('jenis_id', $kedatangan->sektor)
                    ->pluck('name')->first();
        $pekerjaan = DB::table('master_kategori_line')
                    ->where('jenis', 'm_pekerjaan')
                    ->where('jenis_id', $kedatangan->pekerjaan)
                    ->pluck('name')->first();
        $pendidikan = DB::table('master_kategori_line')
                    ->where('jenis', 'm_pendidikan')
                    ->where('jenis_id', $kedatangan->pendidikan)
                    ->pluck('name')->first();
        $negara = DB::table('master_kategori_line')
                    ->where('jenis', 'm_negara')
                    ->where('jenis_id', $kedatangan->negara)
                    ->pluck('name')->first();
        $pptkis = DB::table('m_pengirim')->where('id', $kedatangan->pptkis)
                    ->pluck('nama')->first();
        $imigrasi = DB::table('master_kategori_line')
                    ->where('jenis', 'm_kantor_imigrasi')
                    ->where('jenis_id', $kedatangan->kantor_imigrasi)
                    ->pluck('name')->first();
        $jenis_pulang = DB::table('master_kategori_line')
                    ->where('jenis', 'kedatangan_jenis_pulang')
                    ->where('jenis_id', $kedatangan->jenis_pulang)
                    ->pluck('name')->first();

        $pulang = DB::table('master_kategori_line')
                    ->where('jenis', 'm_pulang')
                    ->where('jenis_id', $kedatangan->kepulangan)
                    ->pluck('name')->first();
        $pulang_sendiri = DB::table('master_kategori_line')
                    ->where('jenis', 'm_pulang_sendiri')
                    ->where('jenis_id', $kedatangan->pulang_sendiri)
                    ->pluck('name')->first();
        $dijemput = DB::table('master_kategori_line')
                    ->where('jenis', 'm_dijemput')
                    ->where('jenis_id', $kedatangan->dijemput)
                    ->pluck('name')->first();

        $masalah_id = DB::table('t_masalah')->where('kedatangan_id', $id)->pluck('masalah_id');

        $masalah = DB::table('master_kategori_line')
                ->where('jenis', 'm_masalah')
                ->whereIn('jenis_id', $masalah_id)
                ->pluck('name');

        return view('sistem.kedatangan.detail', [
            'kedatangan' => $kedatangan,
            'pesawat' => $pesawat,
            'provinsi' => $provinsi,
            'kabkota' => $kabkota,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'sektor' => $sektor,
            'pekerjaan' => $pekerjaan,
            'pendidikan' => $pendidikan,
            'negara' => $negara,
            'imigrasi' => $imigrasi,
            'pptkis' => $pptkis,
            'masalah' => $masalah,
            'jenis_pulang' => $jenis_pulang,
            'pulang' => $pulang,
            'pulang_sendiri' => $pulang_sendiri,
            'dijemput' => $dijemput,
        ]);
    }
    public function update(Request $request)
    {
        DB::table('t_masalah')->where('kedatangan_id', $request->nmID)->delete();
        list($kedatangan) = $this->saveData($request);
        return redirect()->route('kedatangan_detail', $kedatangan->id)->with('success', 'Data Kedatangan TKI telah diperbarui');
    }

    public function delete(Request $request)
    {
        Kedatangan::find($request->idDelete)->delete();
        return redirect()->route('kedatangan_index')->with('success', 'Data Kedatangan TKI telah dihapus');
        
    }

}