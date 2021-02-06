<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterKategoriLine as MasterKategoriLine;
use App\Models\JadwalKeberangkatan as JadwalKeberangkatan;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class JadwalKeberangkatanController extends Controller
{

    public function index_json(Request $request)
    {
        $jdkeberangkatan = (DB::select(
            DB::raw("SELECT jberangkat.*, pes.name AS 'pesawat',
                    pes.kode AS 'kode_pesawat',
                    asal.name AS 'asal_bandara', asal.kode AS'kode_asal', asal.tag1 AS 'kota',
                    tujuan.name AS 'tujuan_bandara', tujuan.kode AS'kode_tujuan'
                    FROM jadwal_keberangkatan jberangkat
                    LEFT JOIN MASTER_kategori_line pes ON pes.jenis_id = jberangkat.pesawat_id
                    LEFT JOIN MASTER_kategori_line asal ON asal.jenis_id = jberangkat.bandara_asal
                    LEFT JOIN MASTER_kategori_line tujuan ON tujuan.jenis_id = jberangkat.bandara_tujuan
                    WHERE MONTH(jberangkat.tgl_berangkat) = '$request->nmBulan' AND
                    YEAR (jberangkat.tgl_berangkat) = '$request->nmTahun' 
                    AND  pes.jenis = 'm_pesawat' AND asal.jenis = 'm_bandara' AND tujuan.jenis = 'm_bandara'
                    ORDER BY jberangkat.tgl_berangkat ASC")));


        if ($request->ajax()) {
            return Datatables::of($jdkeberangkatan)
            ->editColumn('nama', function($data){
                return  '<a class="font-15 font-weight-bold" href="' . route('jadwal_keberangkatan_detail', $data->id) .'">' 
                        . $data->name . '</a><br>
                        <span class="font-13 font-weight-bold text-dark">'.  $data->jk  . ' / ' .
                        \Carbon\Carbon::parse($data->tgl_lahir)->format('d-m-Y') . '</span>';
            })
            ->editColumn('no_penerbangan', function($data){
                return  '<span class="font-14 font-weight-bold text-primary">' .  \Carbon\Carbon::parse($data->tgl_berangkat)->format('d-m-Y / H:i')  . '</span><br>
                        <span class="font-14 font-weight-bold text-dark">' .  $data->no_penerbangan  . '</span><br>
                        <span class="font-14 font-weight-500"> [' .  $data->kode_pesawat  . '] - ' .  $data->pesawat  . '</span>';
            })
            ->editColumn('asal_bandara', function($data){
                return  '<span class="font-14 text-dark font-weight-bold">
                <span class="text-success mr-2 font-weight-500">Tujuan:</span>[' . $data->kode_tujuan . '] - '.
                $data->tujuan_bandara  . '</span><br><div class="font-14 mt-1">
                <span class="text-danger mr-2 font-weight-500">Asal:</span> [' . $data->kode_asal . '] - '. 
                $data->asal_bandara  . '</div>';
            })
            ->editColumn('status', function($data){
                if($data->status == 0){
                    return  '<span title="Belum Berangkat" class="bg-warning px-2 py-1 text-white font-weight-500 rounded">Belum</span>';
                }
                else if($data->status == 1){
                    return  '<span title="Sudah Berangkat" class="bg-success px-2 py-1 text-white font-weight-500 rounded">Berangkat</span>';
                }
                else{
                    return  '<span title="Batal Berangkat" class="bg-danger px-2 py-1 text-white font-weight-500 rounded">Batal</span>';
                }
                
            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('jadwal_keberangkatan_edit',  $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['nama','no_penerbangan','asal_bandara','status','action'])
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
    
    public function getNegara(){
        $negara = DB::table('master_kategori_line')
                ->select('id', 'name', 'jenis_id')
                ->where('jenis', 'm_negara')
                ->get();
        return [$negara];
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
    
   
    public function getBandara(){

        $bandara = (DB::select(DB::raw("SELECT ban.id AS 'id',ban.kode AS 'kode', 
                                    ban.jenis_id, ban.tag1 AS 'kota', 
                                    ban.name AS 'bandara', neg.name AS 'negara'
                            FROM master_kategori_line ban, master_kategori_line neg
                            WHERE ban.jenis = 'm_bandara' AND neg.jenis = 'm_negara' 
                            AND neg.jenis_id = ban.join1_id ORDER BY trim(neg.name) ASC")));

        return [$bandara];
    }

    public function index()
    {
        $bulan = DB::table('master_kategori_line')->select('id', 'jenis_id', 'kode', 'name')
                ->where('jenis', 'm_bulan')
                ->get();
        return view('sistem.jadwal.keberangkatan.index', [
            'bulan' => $bulan
        ]);
    }

    public function create()
    {
        list($pesawat) = $this->getPesawat();
        list($bandara) = $this->getBandara();
        list($imigrasi) = $this->getImigrasi();
        list($provinsi) = $this->getProvinsi();
        list($perusahaan) = $this->getPerusahaan();
        list($negara) = $this->getNegara();
    
        
        $jdkeberangkatan = '';
        return view('sistem.jadwal.keberangkatan.create', [
            'pesawat' => $pesawat,
            'bandara' => $bandara,
            'imigrasi' => $imigrasi,
            'provinsi' => $provinsi,
            'perusahaan' => $perusahaan,
            'negara' => $negara,
            'jdkeberangkatan' => $jdkeberangkatan,
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
            $jdkeberangkatan = new JadwalKeberangkatan();
            $jdkeberangkatan->create_uid = $user->id;
            $jdkeberangkatan->create_date = now();
        }
        else{
            $jdkeberangkatan = JadwalKeberangkatan::find($request->nmID);
            $jdkeberangkatan->write_uid = $user->id;
            $jdkeberangkatan->write_date = now();
        }

        $jdkeberangkatan->tgl_berangkat = $request->nmTglBerangkat;
        $jdkeberangkatan->no_penerbangan = $request->nmNoPenerbangan;
        $jdkeberangkatan->pesawat_id = $request->nmPesawat;
        $jdkeberangkatan->bandara_asal = $request->nmBandaraAsal;
        $jdkeberangkatan->bandara_tujuan = $request->nmBandaraTujuan;
        $jdkeberangkatan->paspor = $request->nmPaspor;
        $jdkeberangkatan->kantor_imigrasi = $request->nmImigrasi;
        $jdkeberangkatan->name = $request->nmTKI;
        $jdkeberangkatan->tgl_lahir = $request->nmTglLahir;
        $jdkeberangkatan->jk = $request->nmJK;
        $jdkeberangkatan->provinsi = $request->nmProvinsi;
        $jdkeberangkatan->kabkota = $request->nmKabKota;
        $jdkeberangkatan->kecamatan = $request->nmKecamatan;
        $jdkeberangkatan->desa = $request->nmDesa;
        $jdkeberangkatan->alamat = $request->nmAlamat;
        $jdkeberangkatan->pptkis = $request->nmPptkis;
        $jdkeberangkatan->agency = $request->nmAgency;
        $jdkeberangkatan->negara_id = $request->nmNegara;
        $jdkeberangkatan->nama_majikan = $request->nmNamaMajikan;
        $jdkeberangkatan->alamat_majikan = $request->nmAlamatMajikan;
        $jdkeberangkatan->kontak = $request->nmKontak;
        $jdkeberangkatan->keterangan = $request->nmKeterangan;
        $jdkeberangkatan->status = $request->nmStatusBerangkat;
        $jdkeberangkatan->save();


        return [$jdkeberangkatan];
    }

    public function store(Request $request)
    {
        list($jdkeberangkatan) = $this->saveData($request);
        return redirect()->route('jadwal_keberangkatan_detail', $jdkeberangkatan->id)->with('success', 'Jadwal Petugas baru telah ditambahkan');
    }

    public function edit($id)
    {
        list($pesawat) = $this->getPesawat();
        list($bandara) = $this->getBandara();
        list($imigrasi) = $this->getImigrasi();
        list($provinsi) = $this->getProvinsi();
        list($perusahaan) = $this->getPerusahaan();
        list($negara) = $this->getNegara();

        $jdkeberangkatan = JadwalKeberangkatan::find($id);

        return view('sistem.jadwal.keberangkatan.edit', [
            'pesawat' => $pesawat,
            'bandara' => $bandara,
            'imigrasi' => $imigrasi,
            'provinsi' => $provinsi,
            'perusahaan' => $perusahaan,
            'negara' => $negara,
            'jdkeberangkatan' => $jdkeberangkatan,
        ]);
    }
    public function detail($id)
    {
        $jdkeberangkatan = JadwalKeberangkatan::find($id);
       
        $bandara_asal = DB::table('master_kategori_line')
                ->where('jenis', 'm_bandara')
                ->where('jenis_id', $jdkeberangkatan->bandara_asal)
                ->first();
        $bandara_tujuan = DB::table('master_kategori_line')
                ->where('jenis', 'm_bandara')
                ->where('jenis_id', $jdkeberangkatan->bandara_tujuan)
                ->first();
        $negara_asal = '';
        $negara_tujuan = '';

        if($bandara_asal)
        {
            $negara_asal = DB::table('master_kategori_line')
            ->where('jenis', 'm_negara')
            ->where('jenis_id', $bandara_asal->join1_id)
            ->pluck('name')
            ->first();

            $negara_tujuan = DB::table('master_kategori_line')
            ->where('jenis', 'm_negara')
            ->where('jenis_id', $bandara_tujuan->join1_id)
            ->pluck('name')
            ->first();
        }
        $pesawat = DB::table('master_kategori_line')->select('name', 'kode')
                    ->where('jenis', 'm_pesawat')
                    ->where('jenis_id', $jdkeberangkatan->pesawat_id)
                    ->first();
        $provinsi = DB::table('kedatangan_provinsi')->where('id', $jdkeberangkatan->provinsi)
                    ->pluck('nama')->first();
        $kabkota = DB::table('kedatangan_kabkota')->where('id', $jdkeberangkatan->kabkota)
                    ->pluck('nama')->first();
        $kecamatan = DB::table('kedatangan_pengirim')->where('id', $jdkeberangkatan->kecamatan)
                    ->pluck('nama')->first();
        $desa = DB::table('kedatangan_desa')->where('id', $jdkeberangkatan->desa)
                    ->pluck('nama')->first();
        $negara = DB::table('master_kategori_line')
                    ->where('jenis', 'm_negara')
                    ->where('jenis_id', $jdkeberangkatan->negara_id)
                    ->pluck('name')->first();
        $pptkis = DB::table('m_pengirim')->where('id', $jdkeberangkatan->pptkis)
                    ->pluck('nama')->first();
        $imigrasi = DB::table('master_kategori_line')
                    ->where('jenis', 'm_kantor_imigrasi')
                    ->where('jenis_id', $jdkeberangkatan->kantor_imigrasi)
                    ->pluck('name')->first();
       
        return view('sistem.jadwal.keberangkatan.detail', [
            'jdkeberangkatan' => $jdkeberangkatan,
            'bandara_asal' => $bandara_asal,
            'bandara_tujuan' => $bandara_tujuan,
            'negara_asal' => $negara_asal,
            'negara_tujuan' => $negara_tujuan,
            'pesawat' => $pesawat,
            'provinsi' => $provinsi,
            'kabkota' => $kabkota,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'negara' => $negara,
            'imigrasi' => $imigrasi,
            'pptkis' => $pptkis,
        ]);
    }
    public function update(Request $request)
    {
       
        list($jdkeberangkatan) = $this->saveData($request);
        return redirect()->route('jadwal_keberangkatan_detail', $jdkeberangkatan->id)->with('success', 'Data Keberangkatan TKI telah diperbarui');
    }

    public function delete(Request $request)
    {
        JadwalKeberangkatan::find($request->idDelete)->delete();
        return redirect()->route('jadwal_keberangkatan_index')->with('success', 'Data Keberangkatan TKI telah dihapus');
        
    }

}