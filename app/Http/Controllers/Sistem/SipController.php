<?php

namespace App\Http\Controllers\Sistem;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sip as Sip;
use Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

use DataTables;

class SipController extends Controller
{

    public function getData()
    {
        $get_sip = DB::table('pmi_sip')->select('pmi_sip.*', 'pmi_perusahaan.nama as perusahaan',
                            'pmi_jabatan.nama as jabatan', 'pmi_negara.negara as negara')
                    ->leftjoin('pmi_perusahaan', 'pmi_perusahaan.id', '=', 'pmi_sip.perusahaan_id')
                    ->leftjoin('pmi_jabatan', 'pmi_jabatan.id', '=', 'pmi_sip.jabatan_id')
                    ->leftjoin('pmi_negara', 'pmi_negara.id', '=', 'pmi_sip.negara_id');

        return [$get_sip];
    }

    public function getJabatan()
    {
        $get_jabatan = DB::table('pmi_jabatan')->select('id','nama')->get();
        return [$get_jabatan];
    }

    public function getPerusahaan()
    {
        $get_perusahaan = DB::table('pmi_perusahaan')->select('id','nama')->get();
        return [$get_perusahaan];
    }
    public function getNegara()
    {
        $get_negara = DB::table('pmi_negara')->select('id','negara')->get();
        return [$get_negara];
    }

    public function index(){

        return view('sistem.sip.index');
    }

    public function index_json(Request $request)
    {
        list($get_sip) = $this->getData();
        
        $sip = $get_sip->orderBy('pmi_sip.tgl_ijin_akhir', 'desc')->limit($request->nmLimit)->get();

        if ($request->ajax()) {
            return Datatables::of($sip)
            ->editColumn('jabatan', function($data){
                if($data->sts_formal == 0){
                    return '<input id="idSIP" type="hidden" value="' . $data->id . '"></input>
                            <a class="font-weight-bold font-15" href="' . route('sip_detail', $data->id) .'">'
                            . $data->jabatan . '</a>
                            <br><span class="text-dark font-weight-500">Negara: 
                            <span class="text-success font-12 font-weight-bold">' . $data->negara . '</span></span>';
                }
                else{
                    return '<a class="font-weight-bold font-14" href="' . route('sip_detail', $data->id) .'">'
                            . $data->jabatan . '</a>
                            <br><span class="text-dark font-weight-500">Negara: 
                            <span class="text-success font-12 font-weight-bold">' . $data->negara . '</span></span>';
                }
            })
            ->editColumn('agency', function ($data){
                return ' <span class="text-dark font-weight-500 font-14">' . $data->agency . '</span>
                        <br><span class="font-weight-bold font-12 text-uppercase">' . $data->perusahaan . '</span>';
            })
            ->editColumn('no_sip', function($data) {
                return  '<span class="font-weight-bold font-13 text-dark">' . $data->no_sip . '</span><br>
                        <small class="font-weight-500 font-11">
                            <span class="text-danger">Ijin Berlaku : </span><span class="text-dark">' 
                            . \Carbon\Carbon::parse($data->tgl_ijin_awal)->format('d-m-Y') . '<span class="mx-1">s/d</span>'
                            . \Carbon\Carbon::parse($data->tgl_ijin_akhir)->format('d-m-Y'). 
                        '</span></small>';
            })
            ->editColumn('tgl_ijin_akhir', function($data){
                if(strtotime($data->tgl_ijin_akhir) > strtotime("-1 day", strtotime(now()))){
                    return  '<span class="bg-success font-weight-500 px-2 py-1 rounded text-white">Active</span>' ;
                }else{
                    return '<span class="bg-light font-weight-500 px-2 py-1 rounded text-dark">Expired</span>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<div class="btn-group dropleft mr-2" title="Detail/Ubah/Hapus">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('sip_detail', $data->id) . '"><i class="far fa-file-alt font-14 mr-2"></i> Detail</a>
                    <a class="dropdown-item text-primary" href="' . route('sip_edit', $data->id) . '"> <i class="fas fa-edit font-13 mr-2"></i>Ubah</a>
                    <a class="dropdown-item text-danger" href="" id="btnDelete"  onclick="$(' . "'#idDelete'" . ').val(' . "'$data->id'".');" title="Hapus Data" 
                    data-toggle="modal" data-target="#exampleModalCenter" >
                    <i class="fas fa-times font-15 mr-2"></i> Hapus</a>
                </div>';
            })
            ->rawColumns(['jabatan', 'agency', 'no_sip',  'tgl_ijin_akhir', 'action'])
            ->toJson();
        }

    }
    public function create()
    {
        $perusahaan = arr::flatten($this->getPerusahaan());
        $jabatan = arr::flatten($this->getJabatan());
        $negara = arr::flatten($this->getNegara());
        return view('sistem.sip.create', [
            'jabatan' => $jabatan,
            'perusahaan' => $perusahaan,
            'negara' => $negara,
        ]);
    }

    public function saveData(Request $request)
    {

        return DB::transaction(function () use ($request) {

        $user = Auth::user();

        $this->validate($request, 
        ['nmNoSip' => 'required'],
        ['nmNoSip.required' => '* No. SIP harus diisi']
        );

        if($request->nmTipe == "create"){
            // Baru
            $sip = new Sip();
            $sip->create_uid = $user->id;
            $sip->create_date = now();
        }
        else{
            // Update
            $sip = Sip::find($request->idSip);
            $sip->write_uid = $user->id;
            $sip->write_date = now();
        }

        $sip->no_sip = $request->nmNoSip;
        $sip->perusahaan_id = $request->nmPerusahaan;
        $sip->sts_formal = $request->nmStatusFormal;
        $sip->agency = $request->nmAgency;
        $sip->jabatan_id = $request->nmJabatan;
        $sip->negara_id = $request->nmNegara;
        $sip->tgl_ijin_awal = $request->nmIjinAwal;
        $sip->tgl_ijin_akhir = $request->nmIjinAkhir;
        $sip->jumlah_l = $request->nmJumlahL;
        $sip->jumlah_p = $request->nmJumlahP;
        $sip->jumlah_lp = $request->nmJumlahLP;
        
        $keterangan = $request->nmKeterangan;
        
        $folder =  public_path().'/uploads/file/sip';

        if (! File::exists($folder)) {
            File::makeDirectory($folder, 0777,true);
        }

        if($keterangan){
            $dom = new \DomDocument();
            $keterangan_filter = str_replace("\0", '', $keterangan);

            @$dom->loadHtml($keterangan_filter, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    

            $images = $dom->getElementsByTagName('img');

            foreach($images as $k => $img){

                $src = $img->getAttribute('src');

                if(preg_match('/data:image/', $src)){                
                    // get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];
                                    
                    // Random filename
                    $filename = uniqid();
                    $filepath = "/uploads/file/sip/$filename.$mimetype";   
                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                      // resize if required
                      /* ->resize(300, 200) */
                    ->encode($mimetype, 100)  // encode file to the specified mimetype
                    ->save(public_path($filepath));                
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                } 
                
            }

            $keterangan_filter = $dom->saveHTML();
            $sip->keterangan = $keterangan_filter;
        }
    
        $sip->status_lamaran = $request->nmStatusLamaran;
        $sip->save();

        return [$sip];

        });

    }

    public function store(Request $request)
    {
        list($sip) = $this->saveData($request);
        return redirect()->route('sip_detail', $sip->id)->with('success', 'Data Baru Telah Ditambahkan');
    }

    public function update(Request $request)
    {
        list($sip) = $this->saveData($request);
        return redirect()->route('sip_detail', $sip->id)->with('success', 'Data Telah Diperbarui');
    }

    public function detail($id)
    {
        list($get_sip) = $this->getData();
        
        $sip = $get_sip->where('pmi_sip.id', $id)->first();

        return view('sistem.sip.detail', [
            'sip' => $sip,
        ]);

    }

    public function edit($id)
    {
        list($get_sip) = $this->getData();
        
        $sip = $get_sip->where('pmi_sip.id', $id)->first();

        $perusahaan = arr::flatten($this->getPerusahaan());
        $jabatan = arr::flatten($this->getJabatan());
        $negara = arr::flatten($this->getNegara());

        return view('sistem.sip.edit', [
            'sip' => $sip,
            'jabatan' => $jabatan,
            'perusahaan' => $perusahaan,
            'negara' => $negara,
        ]);
    }

    public function delete(Request $request)
    {
        $sip = Sip::find($request->idDelete);
        $sip->delete();
        return redirect()->route('sip_index')->with('success', 'Data Telah Dihapus Permanen');
    }

}