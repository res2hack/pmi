<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalKedatangan as JadwalKedatangan;
use Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class JadwalKedatanganController extends Controller
{

    public function index_json(Request $request)
    {
        $jdkedatangan = (DB::select(DB::raw("SELECT jdatang.*, pes.name AS 'pesawat',
                        pes.kode AS 'kode_pesawat',
                        asal.name AS 'asal_bandara', asal.kode AS'kode_asal', asal.tag1 AS 'kota',
                        tujuan.name AS 'tujuan_bandara', tujuan.kode AS'kode_tujuan'
                        FROM jadwal_kedatangan jdatang
                        LEFT JOIN MASTER_kategori_line pes ON pes.jenis_id = jdatang.pesawat_id
                        LEFT JOIN MASTER_kategori_line asal ON asal.jenis_id = jdatang.bandara_asal
                        LEFT JOIN MASTER_kategori_line tujuan ON tujuan.jenis_id = jdatang.bandara_tujuan
                        WHERE  pes.jenis = 'm_pesawat' AND asal.jenis = 'm_bandara' AND tujuan.jenis = 'm_bandara'
                        ORDER BY jdatang.jadwal desc")));

        if ($request->ajax()) {
            return Datatables::of($jdkedatangan)
            ->editColumn('no_penerbangan', function($data){
                return  '<a class="" href="' . route('jadwal_kedatangan_detail', $data->id) .'">
                        <span class="font-weight-bold font-15">' 
                        . $data->no_penerbangan . '</span><br>
                        <span class="font-14 font-weight-500 text-dark">[' . $data->kode_pesawat . '] - '. $data->pesawat. '</span></a>';
            })
            ->editColumn('jadwal', function($data){
                return  '<span class="font-14 text-dark font-weight-bold">' .  
                        \Carbon\Carbon::parse($data->jadwal)->format('d-m-Y') . '<br><span class="text-success">' .
                        \Carbon\Carbon::parse($data->jadwal)->format('H:i:s')  . '</span></span>';
            })
            ->editColumn('asal_bandara', function($data){
                return  '<span class="font-14 text-dark font-weight-bold">
                <span class="text-success mr-2 font-weight-500">Tujuan:</span>[' . $data->kode_tujuan . '] - '.
                $data->tujuan_bandara  . '</span><br><div class="font-14 mt-2">
                <span class="text-danger mr-2 font-weight-500">Asal:</span> [' . $data->kode_asal . '] - '. 
                $data->asal_bandara  . '</div>';
            })
            ->editColumn('keterangan', function($data){
                if($data->keterangan){
                    return  '<span class="font-14 text-dark font-weight-500">' .  $data->keterangan  . '</span>';
                }else{
                    return  '<span class="font-14 text-dark font-weight-500">-</span>';
                }
                

            })
            ->addColumn('action', function ($data) {
                return '<span>
                    <a href="' . route('jadwal_kedatangan_edit',  $data->id) . '"> <i class="fas fa-edit text-primary"></i></a>
                    <a class="ml-1" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-times text-danger"></i></a></span>';
            })
            ->rawColumns(['no_penerbangan','jadwal','asal_bandara','keterangan','action'])
            ->toJson();
        }
    }

    
    public function index()
    {
        return view('sistem.jadwal.kedatangan.index');
    }

    public function getPesawat(){
        $pesawat = DB::table('master_kategori_line')
                    ->select('id', 'name', 'kode', 'jenis_id')
                    ->where('jenis', 'm_pesawat')
                    ->get();
        return [$pesawat];
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

    
    public function create()
    {
        list($pesawat) = $this->getPesawat();
        list($bandara) = $this->getBandara();
        return view('sistem.jadwal.kedatangan.create',[
            'pesawat' => $pesawat,
            'bandara' => $bandara,
        ]);
    }

    public function saveData(Request $request)
    {
        // $this->validate($request, 
        // ['nmNoPenerbangan' => 'required'],
        // ['nmNoPenerbangan.required' => '* No Penerbangan harus diisi']
        // );

        $user = Auth::user();

        $status = $request->nmStatus;

        if($status == "baru"){
            $jdkedatangan = new JadwalKedatangan();
        }
        else{
            $jdkedatangan = JadwalKedatangan::find($request->nmID);
        }
        
        
        $jdkedatangan->pesawat_id = $request->nmPesawat;
        $jdkedatangan->jadwal = $request->nmJadwal;
        $jdkedatangan->no_penerbangan = $request->nmNoPenerbangan;
        $jdkedatangan->bandara_asal = $request->nmBandaraAsal;
        $jdkedatangan->bandara_tujuan = $request->nmBandaraTujuan;
        $jdkedatangan->keterangan = $request->nmKeterangan;
        $jdkedatangan->write_uid = $user->id;
        $jdkedatangan->write_date = now();
        $jdkedatangan->save();

        return [$jdkedatangan];
    }

    public function store(Request $request)
    {
        list($jdkedatangan) = $this->saveData($request);
        return redirect()->route('jadwal_kedatangan_detail', $jdkedatangan)->with('success', 'Jadwal Kedatangan baru telah ditambahkan');
    }

    // Get Single Data (edit / detail)
    public function firstData($id){

        $jdkedatangan = JadwalKedatangan::find($id);
        $detail_pesawat = DB::table('master_kategori_line')
                    ->where('jenis', 'm_pesawat')
                    ->where('jenis_id', $jdkedatangan->pesawat_id)
                    ->first();
        
        $bandara_asal = DB::table('master_kategori_line')
                    ->where('jenis', 'm_bandara')
                    ->where('jenis_id', $jdkedatangan->bandara_asal)
                    ->first();

        
        $bandara_tujuan = DB::table('master_kategori_line')
                    ->where('jenis', 'm_bandara')
                    ->where('jenis_id', $jdkedatangan->bandara_tujuan)
                    ->first();
        return [$jdkedatangan, $detail_pesawat, $bandara_asal, $bandara_tujuan];
    }

    public function edit($id)
    {
        list($jdkedatangan, $detail_pesawat, $bandara_asal, $bandara_tujuan) = $this->firstData($id);
        list($pesawat) = $this->getPesawat();
        list($bandara) = $this->getBandara();
        return view('sistem.jadwal.kedatangan.edit', [
            'jdkedatangan' => $jdkedatangan,
            'detail_pesawat' => $detail_pesawat,
            'pesawat' => $pesawat,
            'bandara' => $bandara,
            'bandara_asal' => $bandara_asal,
            'bandara_tujuan' => $bandara_tujuan,
        ]);
    }
    public function detail($id)
    {
        list($jdkedatangan, $detail_pesawat, $bandara_asal, $bandara_tujuan) = $this->firstData($id);
        
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
       

        return view('sistem.jadwal.kedatangan.detail', [
            'jdkedatangan' => $jdkedatangan,
            'detail_pesawat' => $detail_pesawat,
            'bandara_asal' => $bandara_asal,
            'bandara_tujuan' => $bandara_tujuan,
            'negara_asal' => $negara_asal,
            'negara_tujuan' => $negara_tujuan,
        ]);
    }
    public function update(Request $request)
    {
        list($jdkedatangan) = $this->saveData($request);
        return redirect()->route('jadwal_kedatangan_detail', $jdkedatangan)->with('success', 'Jadwal Kedatangan telah diperbarui');
    }

    public function delete(Request $request)
    {
        JadwalKedatangan::find($request->idDelete)->delete();
        return redirect()->route('jadwal_kedatangan_index')->with('success', 'Jadwal Kedatangan telah dihapus');
        
    }

}