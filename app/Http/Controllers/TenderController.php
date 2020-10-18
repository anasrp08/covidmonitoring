<?php

namespace App\Http\Controllers;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 
use App\Helpers\AppHelper; 
use App\Helpers\QueryHelper; 
use App\Helpers\UpdtSaldoHelper; 
use App\Helpers\AuthHelper; 

 
use Redirect;
use Validator;
use Response;
use DB;
// use File;
use PDF;
 

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {
       
        if (request()->ajax()) { 
            $queryData=DB::table('tr_statusmutasi')
            ->join('md_namalimbah', 'tr_statusmutasi.idlimbah', '=', 'md_namalimbah.id')
            ->join('tr_headermutasi', 'tr_statusmutasi.idmutasi', '=', 'tr_headermutasi.id')
            ->join('md_statusmutasi', 'tr_statusmutasi.idstatus', '=', 'md_statusmutasi.id')
            // ->join('tr_detailmutasi', 'tr_statusmutasi.idmutasi', '=', 'tr_detailmutasi.idmutasi')
            ->join('md_penghasillimbah', 'tr_statusmutasi.idasallimbah', '=', 'md_penghasillimbah.id')
            ->select('tr_statusmutasi.*',
            'md_namalimbah.namalimbah', 
            'tr_headermutasi.id_transaksi',
            'md_namalimbah.jenislimbah', 
            'md_penghasillimbah.seksi',
            'md_statusmutasi.keterangan')
            ->where('tr_statusmutasi.idstatus',1) 
            ->orWhere('tr_statusmutasi.validated_by',null)
           ->orderBy('tr_statusmutasi.created_at', 'desc');
        //    dd();
 
            // if(!empty($request->tglinput)){

            //     $splitDate2=explode(" - ",$request->tglinput);
            //     $queryData->whereBetween('tr_mutasilimbah.tgl',array(  AppHelper::convertDateYmd($splitDate2[0]),  AppHelper::convertDateYmd($splitDate2[1])));

            // } 
			
            $queryData=$queryData->get(); 
            //  dd( $queryData);   
            return datatables()->of($queryData) 
                    // ->filter(function ($instance) use ($request) {
                    //     if (!empty($request->get('jenislimbah'))) {
                    //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //             return Str::contains(Str::lower($row['jenislimbah']),Str::lower($request->get('jenislimbah'))) ? true : false;
                    //         });
                    //     }
                    //     if(!empty($request->get('namalimbah'))){
                    //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //             return Str::contains(Str::lower($row['namalimbah']), Str::lower($request->get('namalimbah'))) ? true : false;
                    //         });
                    //     }
                   
                    //     if(!empty($request->get('mutasi'))){
                    //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //             return Str::contains($row['mutasi'], $request->get('mutasi')) ? true : false;
                    //         });
                    //     } 
                    //     if(!empty($request->get('fisik'))){
                    //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //             return Str::contains($row['fisik'], $request->get('fisik')) ? true : false;
                    //         });
                    //     }
                    //     if(!empty($request->get('asallimbah'))){
                    //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //             return Str::contains($row['asallimbah'], $request->get('asallimbah')) ? true : false;
                    //         });
                    //     }
                    //     if(!empty($request->get('tpslimbah'))){
                    //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //             return Str::contains($row['tps'], $request->get('tpslimbah')) ? true : false;
                    //         });
                    //     } 
                    //     if(!empty($request->get('limbah3r'))){
                    //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //             return Str::contains($row['limbah3r'], $request->get('limbah3r')) ? true : false;
                    //         });
                    //     } 
                    // })
                    ->addIndexColumn()
                    ->addColumn('action', 'action_butt_pemohon')
                    ->rawColumns(['action'])
                    
                    ->make(true);
 
        } 
        return view('pemohon.list', [
           
        ]);
    }
    public function viewEntri()
    {
        //contoh koneksi ke eproc
        // $users = DB::connection('pgsql')->table('prcmts')->select('number')->get();
        // dd($users);
        
        return view('pemohon.create',QueryHelper::getDropDown());
    }
    public function viewProses()
    {
        //
        $jenisLimbah=DB::table('md_jenislimbah')->get();
        $namaLimbah=DB::table('md_namalimbah')->get();
        $tipeLimbah=DB::table('md_tipelimbah')->get();
        $penghasilLimbah=DB::table('md_penghasillimbah')->get();
        $satuanLimbah=DB::table('md_satuan')->get();
        $tpsLimbah=DB::table('md_tps')->get();
        return view('limbah.create',[
            'jenisLimbah' => $jenisLimbah,
            'namaLimbah' => $namaLimbah,
            'tipeLimbah' => $tipeLimbah,
            'satuanLimbah' => $satuanLimbah,
            'tpsLimbah' => $tpsLimbah,
            'penghasilLimbah' => $penghasilLimbah,

        ]);
    }
   

    public function viewIndex()
    {
        $np=DB::table('tbl_np')->get();
        return view('pemohon.list',[
            'np'=>$np

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function noSurat($idAsalLimbah){

        // dd($idAsalLimbah);
        $noSuratUnitKerja=DB::table('md_nosurat')->where('unit_kerja',$idAsalLimbah)->first(); 
        
        $unitKerja=$noSuratUnitKerja->unit_kerja;
        $currMonth=date("m");
        $currYear=date("Y"); 
        $nomor=(int)$noSuratUnitKerja->no;
        function numberToRomanRepresentation($number)
        {
            
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }
        $no=sprintf('%03d', $nomor);
       
        $concatFormat=$no."/".$unitKerja."/".numberToRomanRepresentation($currMonth)."/". $currYear;
        $nomor++;
        DB::table('md_nosurat')->update(['no' => $nomor]); 
        return  $concatFormat; 
    }
    public function store(Request $request)
    {
 
        // AuthHelper::getAuthUser()[0]->email;
        $username=AuthHelper::getAuthUser()[0]->email;
        $getRequest=json_decode($request->getContent(), true);
        // dd($getRequest);
        $dataRequest=$getRequest['Data']; 
        $requestHeader=$getRequest['Header'];
        // dd($dataHeader); 
       
        $countDataReq=count($dataRequest); 
        $error=null;
        $getLastTransaksi=DB::table('tr_headermutasi')->latest('id')->first();

        $lastTransactionNo=null;
        if($getLastTransaksi==null){
            $lastTransactionNo=1 ;
        }else{
            $lastTransactionNo=(int)$getLastTransaksi->id_transaksi;
            $lastTransactionNo++;
        }
         
        $idAsalLimbah=$dataRequest[0]['asal_limbah'];
        $noSurat=$this->noSurat($idAsalLimbah);
       
         foreach($dataRequest as $row){

            $dataHeader = array(
                'id_transaksi'      =>  $lastTransactionNo,
                'no_surat'          =>  $noSurat,
                'idlimbah'		    =>  $row['nama_limbah'], 
                'tgl'			    =>  AppHelper::convertDate($row['tgl']),
                'idasallimbah'	    =>  $row['asal_limbah']	, 
                'idjenislimbah'     =>  $row['jenis_limbah'],
                // 'mutasi'            =>  0	, 
                'jumlah'	        =>  $row['jmlhlimbah'], 
                'limbah3r'	        =>  $row['limbah_3r'],
                'keterangan'	        =>  $row['keterangan'],
                 'np'                   =>$row['np'],
                 'maksud'                   =>$requestHeader,
                'created_by'            =>$username, 
                'created_at'            => date('Y-m-d')
               
            );
            $insertHeader=DB::table('tr_headermutasi')->insertGetId($dataHeader,true);
            // var_dump($insertHeader);

            $dataStatus = array(
                'id_transaksi'      =>  $lastTransactionNo,
                'idmutasi'          =>  $insertHeader,
                'idlimbah'		    =>  $row['nama_limbah'],  
                'idstatus'          =>  1	, 
                'jumlah'	        =>  $row['jmlhlimbah'],  
                'idasallimbah'	    =>  $row['asal_limbah']	, 
                'idjenislimbah'     =>  $row['jenis_limbah'],
                'limbah3r'	        =>  $row['limbah_3r'],
                'tgl'			    =>  AppHelper::convertDate($row['tgl']),
                'created_at'        =>  date('Y-m-d'),
                'created_by'        =>  $username,
               
            );
            $dataDetail=array( 
                'id_transaksi'      =>  $lastTransactionNo,
                'idmutasi'      => $insertHeader,
                'idlimbah'		=>  $row['nama_limbah'],  
                'idstatus'            =>  1	, 
                'jumlah'	        =>  $row['jmlhlimbah'],  
                'created_at'        => date('Y-m-d'),
                'tgl'			    =>  AppHelper::convertDate($row['tgl']),
                'idasallimbah'	    =>  $row['asal_limbah']	, 
                'np'                   =>$row['np'],
                'idjenislimbah'       => $row['jenis_limbah'],
                'limbah3r'	        =>  $row['limbah_3r'],
                'created_by'            =>$username,
        ); 
            //    dd($dataStatus);
            $insertStatus=DB::table('tr_statusmutasi')->insert($dataStatus); 
            $insertDetail=DB::table('tr_detailmutasi')->insert($dataDetail); 
        
    }
    try {
        // UpdtSaldoHelper::updateSaldoNamaLimbah($row['nama_limbah'],$row['jmlhlimbah']);
        return response()->json(['success' => 'Data Berhasil Di Simpan']);
        
    } catch (Exception $e) {
        return response()->json(['error' => 'Data Gagal Disimpan']);
    }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatevalid(Request $request)
    {  

        // dd($request->all());
        $username=AuthHelper::getAuthUser()[0]->email;
        $getRequest=json_decode($request->getContent(), true); 
        $dataRequest=$getRequest['Order']; 
        $countDataReq=count($dataRequest); 
        $error=null; 
        $dataStatus=null;
        $dataDetail=null;
        // dd($dataRequest);
        try {
        
         foreach($dataRequest as $row){
            
                
                if($row['hiddenTransaksi']=='validasi'){
                    $dataStatus=array( 
                        'validated'        => date('Y-m-d'),
                        'validated_by'        => $row['np'],
                        );
                        $updateStatus=DB::table('tr_statusmutasi')->where('idmutasi',$row['idmutasi'])->update($dataStatus,true); 
                        $updateHeaderValidasi=DB::table('tr_headermutasi')->where('id',$row['idmutasi'])->update($dataStatus,true); 
                }else{
                    $dataDetail = array(
                        'id_transaksi'      =>  $row['id_transaksi'],
                        'idmutasi'      => $row['idmutasi'],
                        'idlimbah'		=>  $row['idlimbah'],
                        'tgl'			    =>  $row['tgl'],
                        'idasallimbah'	    =>  $row['idasallimbah']	, 
                        'idjenislimbah'       => $row['idjenislimbah'],
                        'idstatus'            =>  2	, 
                        'jumlah'	        =>  $row['jumlah'], 
                        'limbah3r'	        =>  $row['limbah3r'],
                        'created_at'        => date('Y-m-d'),
                        'np'                   =>$row['np'],
                        'created_by'            =>$username,
                       
                    );
                    $dataStatus=array(
                        'idstatus'          =>  2	,
                        'updated_at'        => date('Y-m-d'),
                        'changed_by'        => $row['np'],
                        );
                        $insertDetail=DB::table('tr_detailmutasi')->insert($dataDetail,true); 
                        $insertStatus=DB::table('tr_statusmutasi')->where('idmutasi',$row['idmutasi'])->update($dataStatus,true); 
                        UpdtSaldoHelper::updateTambahSaldoNamaLimbah($row['idlimbah'],$row['jumlah']);
                }
                 

         }
         return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }
    }
     
    public function update(Request $request)
    {
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getJenis($id)
    {
        $html = '';
        $seri = DB::table('seri_gol')->where('keterangan', $id)->get();
        $html .='<option value="-">-</option>';
        foreach ($seri as $seri_pikai) {
            $html .= '<option value="'.$seri_pikai->seri_gol.'">'.$seri_pikai->seri_gol.'</option>';
        }
   
    return response()->json(['html' => $html]);
        //
    }
    public function getFisik($id)
    {
        //
    }
    public function getNama(Request $request)
    {
        // dd($request->all());
        $html = '';
        $namalimbah = DB::table('md_namalimbah')
        ->where('jenislimbah', $request->jenis)
        ->where('fisik', $request->fisik)
        ->get();
        
        $html .='<option value="-">-</option>';
        foreach ($namalimbah as $nama) {
            $html .= '<option value="'.$nama->namalimbah.'">'.$nama->namalimbah.'</option>';
        }
        return response()->json(['html' => $html]);
        //
    }
    public function getSatuan(Request $request)
    {
        //
        $html = '';
        $namalimbah = DB::table('md_namalimbah')
         
        ->where('namalimbah', $request->namalimbah)
      
        ->get();
        
        $html .='<option value="-">-</option>';
        foreach ($namalimbah as $nama) {
            $html .= '<option value="'.$nama->satuan.'">'.$nama->satuan.'</option>';
        }
        return response()->json(['html' => $html]);
    }

}
