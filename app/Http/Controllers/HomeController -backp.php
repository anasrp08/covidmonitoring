<?php

namespace App\Http\Controllers; 
use DatePeriod;
use DateInterval;
use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
// use App\Helpers\QueryHelper; 
// use App\Helpers\UpdKaryawanHelper; 
use App\Http\Requests;
use App\Helpers\AppHelper;
use App\Helpers\AuthHelper; 
// use App\Http\Controllers\Collection;
use App\Role;
use App\Classes\RandomColor;
// use App\Colors\RandomColor as ColorsRandomColor;
use Validator;
use Response;
use DB;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PDO;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userData=AuthHelper::getUserData(); 
        // dd(DB::table('cemori.tbl_status')->get());
        // dd(Laratrust::hasRole('Pengawas'));
        // if (Laratrust::hasRole('admin') || Laratrust::hasRole('operator')) {

        //     return view('dashboard.dashboard');

        // } else if(Laratrust::hasRole('unit kerja') ) {
        //     // UpdKaryawanHelper::updatePegawai();
        //     // return view('pemohon.create', QueryHelper::getDropDown());
        //     return redirect()->route('pemohon.entri', QueryHelper::getDropDown());
        // }else if(Laratrust::hasRole('pengawas') ) {
        //     // dd('tes');
        //     // UpdKaryawanHelper::updatePegawai();
        //     return redirect()->route('pemohon.listview', QueryHelper::getDropDown());
        //     // return view('pemohon.list', QueryHelper::getDropDown());
        // }
        //    dd($this->dataTender());
        // dd($userData->password_change_at);
        return view('dashboard.dashboard',['userData'=>$userData]);
    }
    public static function grafikAkumulasi(Request $request){
 
    }

    public static function dataBanner(Request $request)
    {
        $dataTerkonfirmasiAll=DB::table('tbl_kasus')
        ->get()->count();
        $dataKasusAktif=DB::table('tbl_kasus')
        ->where('status','On Monitoring')->count();
        $dataSembuh=DB::table('tbl_kasus')
        ->where('status','Selesai')->count();
        $dataMeninggal=DB::table('tbl_kasus')
        ->where('status','Meninggal')->count();

        return response()->json([
            'dataTerkonfirmasi' =>  $dataTerkonfirmasiAll,
            'dataKasusAktif' =>  $dataKasusAktif,
            'dataSembuh' =>  $dataSembuh,
            'dataMeninggal' =>  $dataMeninggal,
    ]);
        
    }
    public static function grafikByDate(Request $request)
    {
       
    //     $mode=null;
    //    if($request->mode == 'true'){ 
    //     $mode='Selesai';
    //    }else{
    //     $mode='On Monitoring';
    //    }
        $periodIn = [];
        $period = new DatePeriod(new DateTime($request->startDate), new DateInterval('P1D'), new DateTime($request->endDate));
       
        foreach ($period as $date) {
            //$value->format('Y-m-d')
            $periodIn[$date->format("d-m-Y")] = 0;
            // $periodOut[$date->format("d")] = 0; 
            $columnPeriod[] = $date->format("d");       
        }  
        $grafik_bar=DB::table('tbl_kasus')
        
        ->select(DB::raw('DATE_FORMAT(tgl_positif, "%d-%m-%Y") as tgl_positif'),DB::raw('count(tgl_positif) as total'))
        ->where('status','On Monitoring')
        ->whereBetween('tgl_positif',[$request->startDate, $request->endDate])
        ->groupBy('tgl_positif')
        ->get();
       
 

        foreach ($grafik_bar as $data) {     
            // $resultConvert=$this->convertSatuan($data->jumlah,$dataSatuan); 
            $periodIn[$data->tgl_positif] =  $data->total;
        }
        $dataKeys=array_keys($periodIn);
        $dataValues=array_values($periodIn);
        // dd(count($dataValues));
        for($i=0;$i<count($dataValues);$i++){
            if($i==0){
                continue;
            }else{
                $dataValues[$i]=$dataValues[$i]+$dataValues[$i-1];
            }
        }

        $maxValues=max($dataValues);
        
        return response()->json([
            'dataValues' =>  $dataValues,
            'dataKeys'=> $dataKeys,
            'maxValue'=>$maxValues
            // 'dataKasusAktif' =>  $dataKasusAktif,
            // 'dataSembuh' =>  $dataSembuh,
            // 'dataMeninggal' =>  $dataMeninggal,
    ]);
        
    }

    public  function queryPersebaran($request,$mode){
    //     $modeFilter=null;
    //     if($request->mode == 'true'){ 
    //     $modeFilter='Selesai';
    //    }else{
    //     $modeFilter='On Monitoring';
    //    }

        $data=DB::table('tbl_kasus')
        ->select($mode,DB::raw('count(tgl_positif) as total'))
        ->where('status','On Monitoring')
        ->whereBetween('tgl_positif',[$request->startDate, $request->endDate])
        
        ->groupBy($mode)
        ->get();

        foreach( $data as $row){
            if($row->$mode==''){
                $row->$mode='Lain-Lain';
            }
        }

        return $data;

    }
    public function generateColor($data){ 
        $color=RandomColor::many($data, array('luminosity'=>'light'));
       
        return $color;
        
    }
    public  function dataPersebaran(Request $request)
    {
        
         
        $dataDirektorat=$this->queryPersebaran($request,'nama_direktorat');
        $keyDirektorat=$dataDirektorat->pluck('nama_direktorat');
        $valuesDirektorat=$dataDirektorat->pluck('total');
        $colorDirektorat=$this->generateColor(count($keyDirektorat));

        $dataDivisi=$this->queryPersebaran($request,'nama_divisi');
        $keyDivisi=$dataDivisi->pluck('nama_divisi');
        $valuesDivisi=$dataDivisi->pluck('total');
        $colorDivisi=$this->generateColor(count($keyDivisi));

        $dataIsolasi=$this->queryPersebaran($request,'tempat_isolasi');
        $keyIsolasi=$dataIsolasi->pluck('tempat_isolasi');
        $valuesIsolasi=$dataIsolasi->pluck('total');
        $colorIsolasi=$this->generateColor(count($keyIsolasi));

        $dataTmptPerawatan=$this->queryPersebaran($request,'tempat_perawatan');
        $keyTmptPerawatan=$dataTmptPerawatan->pluck('tempat_perawatan');
        $valuesTmptPerawatan=$dataTmptPerawatan->pluck('total');
        $colorTmptPerawatan=$this->generateColor(count($keyTmptPerawatan));

        $dataKlaster=$this->queryPersebaran($request,'kluster_penyebaran');
        $keyKlaster=$dataKlaster->pluck('kluster_penyebaran');
        $valuesKlaster=$dataKlaster->pluck('total');
        $colorKlaster=$this->generateColor(count($keyKlaster));

        $dataStatusVaksin=$this->queryPersebaran($request,'status_vaksin');
        $keyVaksin=$dataStatusVaksin->pluck('status_vaksin');
        $valuesVaksin=$dataStatusVaksin->pluck('total');
        $colorVaksin=$this->generateColor(count($keyVaksin));



        return response()->json([
            'keyDirektorat' =>  $keyDirektorat,
            'valuesDirektorat'=> $valuesDirektorat, 
            'keyDivisi' =>  $keyDivisi,
            'valuesDivisi'=> $valuesDivisi,
            'keyIsolasi' =>  $keyIsolasi,
            'valuesIsolasi'=> $valuesIsolasi,
            'keyTmptPerawatan' =>  $keyTmptPerawatan,
            'valuesTmptPerawatan'=> $valuesTmptPerawatan,
            'keyKlaster' =>  $keyKlaster,
            'valuesKlaster'=> $valuesKlaster,
            'keyVaksin' =>  $keyVaksin,
            'valuesVaksin'=> $valuesVaksin,
            'colorDirektorat'=>$colorDirektorat,
            'colorDivisi'=>$colorDivisi,
            'colorIsolasi'=>$colorIsolasi,
            'colorTmptPerawatan'=>$colorTmptPerawatan,
            'colorKlaster'=>$colorKlaster,
            'colorVaksin'=>$colorVaksin, 
            // 'dataKasusAktif' =>  $dataKasusAktif,
            // 'dataSembuh' =>  $dataSembuh,
            // 'dataMeninggal' =>  $dataMeninggal,
    ]);
        
    }
    
}
