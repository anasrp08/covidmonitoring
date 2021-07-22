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
use stdClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
    public function indexLogin($np)
    {
        // $userData=AuthHelper::getUserData(); 
        // dd($np);
        $decrypt_np=$this->encrypt_decrypt('decrypt',$np );
		$splitDecrypt=explode('|',$decrypt_np);
        // $splitDecrypt[2];
        $user = DB::table('users')->where('username',$np)->first();
        if($user)  {
            // Auth::login($user->id,TRUE);
            Auth::loginUsingId($user->id,TRUE);
            $user = Auth::user();
 
            $roleuser=$user->roles->first()->name;
            // dd($roleuser);
            return view('dashboard.dashboard',[]);
            // return redirect()->intended('/');
            // Auth::logout();
        
        }else{
            return 'User tidak terdaftar, silahkan kembali ke portal';
        }
        // dd($user);
        // return view('dashboard.dashboard',['userData'=>$userData]);
    }
    public static function indexLogout($np){
         Auth::logout();
         return 'User tidak terdaftar, silahkan kembali ke portal';

    }
    public static function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        
        $secret_key = 'fajaSsd1fjDwASjA12SAGSHga3yus';
        $secret_iv = 'ASsadkmjku4jLOIh2jfGda5';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            
        
/*			$pisah 				= explode('|',$output);
            $datetime_request 	= $pisah[3];
            $datetime_expired 	= date('Y-m-d H:i:s',strtotime('+10 seconds',strtotime($datetime_request))); 

            $datetime_now		= date('Y-m-d H:i:s');
            if($datetime_now > $datetime_expired || !$datetime_request)
            {
            $output = false;
            }
*/			
            /* Testing		
            echo "datetime now".$datetime_now."<br>";
            echo "datetime expired".$datetime_expired."<br>";
            var_dump($output);
            */
        }
        
        
        return $output;
    }
    

    public function grafikCaseByDate($dataValues){

        for($i=0;$i<count($dataValues);$i++){
            if($i==0){
                continue;
            }else{
                $dataValues[$i]=$dataValues[$i]+$dataValues[$i-1];
            }
        }

        return $dataValues;

    }
    public function grafikSummary(Request $request){
        $periodIn = [];
        $dataGrafik=DB::table('tbl_detail_kasus')
        // ->select(DB::raw('DATE_FORMAT(tgl, "%d-%m-%Y") as tgl_positif'),DB::raw('MONTH(tgl) as month'),DB::raw('DAY(tgl) as date'),DB::raw('YEAR(tgl) as year'),DB::raw('count(tgl) as total'))
        ->select('tgl as tgl_positif',DB::raw('MONTH(tgl) as month'),DB::raw('DAY(tgl) as date'),DB::raw('YEAR(tgl) as year'),DB::raw('count(tgl) as total'))
        ->where('status','PCR Positive')
        ->orderBy('tgl_positif','asc')
 
        ->groupBy('tgl_positif')
        
        ->get();
        // dd( $dataGrafik);
        foreach ($dataGrafik as $data) {     
            // $resultConvert=$this->convertSatuan($data->jumlah,$dataSatuan); 
            $periodIn[$data->tgl_positif] =  $data->total;
        }
        // dd($dataGrafik);
        $dataKeys=array_keys($periodIn);
        // dd(collect($dataKeys));
        // foreach ($dataKeys as $data) {
        //     // dd();
        //     $date=DateTime::createFromFormat("Y-m-d", $data);
        //     $data=$date->format('d/m/Y');
        //     return $data;
        // }
        // $dates = ["2019-01-01", "2019-03-01", "2019-09-01"];
$formattedDate=collect($dataKeys)->map(function ($item, $key) {
 
    $item=DateTime::createFromFormat("Y-m-d", $item)->format('d/m/Y');
 return $item;

})->all();

        
        $dataValues=array_values($periodIn);
      
        $dataAkumulasi=$this->grafikCaseByDate($dataValues);
      
        $dataCaseByDate=$dataValues;
       
       
        $maxValuesByDate=max($dataValues);
        $maxValuesAkumulasi=max($dataAkumulasi);
        return response()->json([
            'dataAkumulasi' =>  $dataAkumulasi,
            'dataCaseByDate' =>  $dataCaseByDate,
            'dataKeys'=> $formattedDate,
            'maxValuesByDate'=> $maxValuesByDate,
            'maxValuesAkumulasi'=> $maxValuesAkumulasi,
        ]);
            
    }
    public static function dataBanner(Request $request)
    {
        $dataTerkonfirmasiAll=DB::table('tbl_detail_kasus')
        ->where('status','PCR Positive')->count();

        $dataKasusAktif=DB::table('tbl_header_kasus')
        ->where('status','PCR Positive')->count();

        $dataSembuh=DB::table('tbl_detail_kasus')
        ->where('status','PCR Negative')->count();

        $dataMeninggal=DB::table('tbl_header_kasus')
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
        $periodIn = [];
        $period = new DatePeriod(new DateTime($request->startDate), new DateInterval('P1D'), new DateTime($request->endDate));
       
        // foreach ($period as $date) {
        //     //$value->format('Y-m-d')
        //     $periodIn[$date->format("d-m-Y")] = 0;
        //     // $periodOut[$date->format("d")] = 0; 
        //     $columnPeriod[] = $date->format("d");       
        // }  

        $grafik_bar=DB::table('tbl_header_kasus')
        
        ->select('tgl_positif as tgl_positif',DB::raw('count(tgl_positif) as total'))
        ->where('status','PCR Positive')
        ->whereBetween('tgl_positif',[$request->startDate, $request->endDate])
        ->orderBy('tgl_positif','asc')
        ->groupBy('tgl_positif')
        
        ->get();
        
        
       
        foreach ($grafik_bar as $data) {     
            // $resultConvert=$this->convertSatuan($data->jumlah,$dataSatuan); 
            $periodIn[$data->tgl_positif] =  $data->total;
        }


        $dataKeys=array_keys($periodIn); 
        
        $formattedDate=collect($dataKeys)->map(function ($item, $key) { 
            // dd($item);
            $item=DateTime::createFromFormat("Y-m-d", $item)->format('d/m/Y');
         return $item;
        
        })->all();
        $dataValues=array_values($periodIn);
        // dd(count($dataValues));
        for($i=0;$i<count($dataValues);$i++){
            if($i==0){
                continue;
            }else{
                $dataValues[$i]=$dataValues[$i]+$dataValues[$i-1];
            }
        }
        $maxValues=null;
       if(count($dataValues)==0){
        $maxValues=0;
       }else{
        $maxValues=max($dataValues);
       }
        
        
        return response()->json([
            'dataValues' =>  $dataValues,
            'dataKeys'=> $formattedDate,
            'maxValue'=>$maxValues 
    ]);
        
    }
    public static function grafikKesembuhan(Request $request)
    { 
        $periodIn = [];
        $period = new DatePeriod(new DateTime($request->startDate), new DateInterval('P1D'), new DateTime($request->endDate));
        
        $grafik_bar=DB::table('tbl_header_kasus')
        
        ->select('tgl_positif as tgl_positif',DB::raw('count(tgl_positif) as total'))
        ->where('status','PCR Negative')
        ->whereBetween('tgl_positif',[$request->startDate, $request->endDate])
        ->orderBy('tgl_positif','asc')
        ->groupBy('tgl_positif')
        
        ->get();
        
        
       
        foreach ($grafik_bar as $data) {      
            $periodIn[$data->tgl_positif] =  $data->total;
        }


        $dataKeys=array_keys($periodIn);
        $formattedDate=collect($dataKeys)->map(function ($item, $key) {
 
            $item=DateTime::createFromFormat("Y-m-d", $item)->format('d/m/Y');
         return $item;
        
        })->all();
        $dataValues=array_values($periodIn);
        // dd(count($dataValues));
        for($i=0;$i<count($dataValues);$i++){
            if($i==0){
                continue;
            }else{
                $dataValues[$i]=$dataValues[$i]+$dataValues[$i-1];
            }
        }
        $maxValues=null;
       if(count($dataValues)==0){
        $maxValues=0;
       }else{
        $maxValues=max($dataValues);
       }
        
        
        return response()->json([
            'dataValues' =>  $dataValues,
            'dataKeys'=> $formattedDate,
            'maxValue'=>$maxValues 
    ]);
        
    }

    public  function queryPersebaran($request,$mode,$field){
     
        $data=DB::table('tbl_header_kasus')
        // ->join('tbl_data_karyawan','tbl_header_kasus.np','tbl_data_karyawan.np')
        // ->join('tbl_md_sto','tbl_data_karyawan.obj_id_unit','tbl_md_sto.id_unit_kerja')
        ->select($mode,DB::raw('count(tbl_header_kasus.tgl_positif) as total'))
        ->where('tbl_header_kasus.status','PCR Positive')
        ->whereBetween('tbl_header_kasus.tgl_positif',[$request->startDate, $request->endDate])
        
        ->groupBy($mode)
        ->get(); 

        foreach( $data as $row){
            if($row->$field==''){
                $row->$field='Lain-Lain';
            }
        } 
        return $data;

    }
    public function generateColor($data){ 
        $color=RandomColor::many($data, array('luminosity'=>'dark'));
       
        return $color;
        
    }
    public  function dataDivisi(Request $request)
    {
        $dataDivisi=DB::table('tbl_header_kasus') 
        ->select('divisi',DB::raw('count(tbl_header_kasus.tgl_positif) as total'))
        ->where('tbl_header_kasus.status','PCR Positive')
        ->where('tbl_header_kasus.direktorat', $request->direktorat)
        ->whereBetween('tbl_header_kasus.tgl_positif',[$request->startDate, $request->endDate])
        
        ->groupBy('divisi')
        ->get(); 

        foreach( $dataDivisi as $row){
            if($row->divisi==''){
                $row->divisi='Lain-Lain';
            }
        } 
     
        $keyDivisi=$dataDivisi->pluck('divisi');
        $valuesDivisi=$dataDivisi->pluck('total');
        $colorDivisi=$this->generateColor(count($keyDivisi));
        return response()->json([ 
            'keyDivisi' =>  $keyDivisi,
            'valuesDivisi'=> $valuesDivisi,
            'colorDivisi'=>$colorDivisi,
        ]);
     } 
     
     public  function dataDomisili(Request $request)
     {
        $dataDivisi=DB::table('tbl_header_kasus') 
        ->select('tempat_perawatan',DB::raw('count(tbl_header_kasus.tgl_positif) as total'))
        ->where('tbl_header_kasus.status','PCR Positive')
        ->where('tbl_header_kasus.kota', $request->domisili)
        ->whereBetween('tbl_header_kasus.tgl_positif',[$request->startDate, $request->endDate])
        
        ->groupBy('tempat_perawatan')
        ->get(); 

        foreach( $dataDivisi as $row){
            if($row->tempat_perawatan==''){
                $row->tempat_perawatan='Lain-Lain';
            }
        } 
     
        $keyTmptPerawatan=$dataDivisi->pluck('tempat_perawatan');
        $valuesTmptPerawatan=$dataDivisi->pluck('total');
       $colorTmptPerawatan=$this->generateColor(count($keyTmptPerawatan));
        return response()->json([ 
              'keyTmptPerawatan' =>  $keyTmptPerawatan,
            'valuesTmptPerawatan'=> $valuesTmptPerawatan,
             'colorTmptPerawatan'=>$colorTmptPerawatan,
        ]);
     }
    public  function dataPersebaran(Request $request)
    {
        
         
        $dataDirektorat=$this->queryPersebaran($request,'tbl_header_kasus.direktorat','direktorat');
        $keyDirektorat=$dataDirektorat->pluck('direktorat');
        // dd($keyDirektorat);
        $valuesDirektorat=$dataDirektorat->pluck('total');
        $colorDirektorat=$this->generateColor(count($keyDirektorat));

       

        $dataIsolasi=$this->queryPersebaran($request,'tbl_header_kasus.kota','kota');
        $keyIsolasi=$dataIsolasi->pluck('kota');
        $valuesIsolasi=$dataIsolasi->pluck('total');
        $colorIsolasi=$this->generateColor(count($keyIsolasi));

        // $dataTmptPerawatan=$this->queryPersebaran($request,'tbl_header_kasus.tempat_perawatan','tempat_perawatan');
        // $keyTmptPerawatan=$dataTmptPerawatan->pluck('tempat_perawatan');
        // $valuesTmptPerawatan=$dataTmptPerawatan->pluck('total');
        // $colorTmptPerawatan=$this->generateColor(count($keyTmptPerawatan));

        $dataKlaster=$this->queryPersebaran($request,'tbl_header_kasus.kluster_penyebaran','kluster_penyebaran');
        $keyKlaster=$dataKlaster->pluck('kluster_penyebaran');
        $valuesKlaster=$dataKlaster->pluck('total');
        $colorKlaster=$this->generateColor(count($keyKlaster));

        $dataStatusVaksin=$this->queryPersebaran($request,'tbl_header_kasus.status_vaksin','status_vaksin');
        $keyVaksin=$dataStatusVaksin->pluck('status_vaksin');
        $valuesVaksin=$dataStatusVaksin->pluck('total');
        $colorVaksin=$this->generateColor(count($keyVaksin));

        $dataGejala=$this->queryPersebaran($request,'tbl_header_kasus.kondisi','kondisi');
        $keyGejala=$dataGejala->pluck('kondisi');
        $valuesGejala=$dataGejala->pluck('total');
        $colorGejala=$this->generateColor(count($keyGejala));


        return response()->json([
            'keyDirektorat' =>  $keyDirektorat,
            'valuesDirektorat'=> $valuesDirektorat, 
            
            'keyIsolasi' =>  $keyIsolasi,
            'valuesIsolasi'=> $valuesIsolasi,
            'keyGejala' =>  $keyGejala,
            'valuesGejala'=> $valuesGejala,

            'keyKlaster' =>  $keyKlaster,
            'valuesKlaster'=> $valuesKlaster,
            'keyVaksin' =>  $keyVaksin,
            'valuesVaksin'=> $valuesVaksin,
            'colorDirektorat'=>$colorDirektorat,
          
            'colorIsolasi'=>$colorIsolasi,
            'colorGejala'=>$colorGejala,
            'colorKlaster'=>$colorKlaster,
            'colorVaksin'=>$colorVaksin,  
    ]);
        
    }
    public static function areaKerjaAktif(Request $request)
    { 
        $gedungAktif = [];
        $grafik_bar=DB::table('tbl_header_kasus')
        
        ->select('gedung',DB::raw('count(tgl_positif) as total'))
        ->where('status','PCR Positive')
        ->whereBetween('tgl_positif',[$request->startDate, $request->endDate])
        ->groupBy('gedung')
        ->get(); 

        
       
        foreach ($grafik_bar as $data) {     
            // $resultConvert=$this->convertSatuan($data->jumlah,$dataSatuan); 
            $gedungAktif[$data->gedung] =  $data->total;
        }


        $dataKeys=array_keys($gedungAktif);
        $dataValues=array_values($gedungAktif);
        // dd(count($dataValues));
         
        $maxValues=null;
       if(count($dataValues)==0){
        $maxValues=0;
       }else{
        $maxValues=max($dataValues);
       }
        
        
        return response()->json([
            'dataValues' =>  $dataValues,
            'dataKeys'=> $dataKeys,
            'maxValue'=>$maxValues 
    ]);
        
    }
    public static function unitKerjaAktif(Request $request)
    { 
        $unitAktif = [];
        $grafik_bar=DB::table('tbl_header_kasus')
        
        ->select('unit',DB::raw('count(tgl_positif) as total'))
        ->where('status','PCR Positive')
        ->where('gedung',$request->gedung)
        ->whereBetween('tgl_positif',[$request->startDate, $request->endDate])
        ->groupBy('unit')
        ->get(); 

        
       
        foreach ($grafik_bar as $data) {     
            // $resultConvert=$this->convertSatuan($data->jumlah,$dataSatuan); 
            $unitAktif[$data->unit] =  $data->total;
        }


        $dataKeys=array_keys($unitAktif);
        $dataValues=array_values($unitAktif);
        // dd(count($dataValues));
         
        $maxValues=null;
       if(count($dataValues)==0){
        $maxValues=0;
       }else{
        $maxValues=max($dataValues);
       }
        
        
        return response()->json([
            'dataValues' =>  $dataValues,
            'dataKeys'=> $dataKeys,
            'maxValue'=>$maxValues 
    ]);
        
    }
    public static function dataMap(Request $request)
    { 
        $unitAktif = [];
        $dataMap=DB::table('tbl_header_kasus')
        ->leftjoin('tbl_lokasi_kerja','tbl_header_kasus.gedung','tbl_lokasi_kerja.gedung')
        ->select('tbl_header_kasus.gedung','tbl_lokasi_kerja.lokasi',DB::raw('count(tgl_positif) as total'),
        DB::raw("(SELECT COUNT(a.lantai) FROM tbl_header_kasus a
                                WHERE a.lantai = '1'
                                and a.gedung = tbl_header_kasus.gedung
                                GROUP BY a.lantai,a.gedung) as lantai_1"),
                                DB::raw("(SELECT COUNT(a.lantai) FROM tbl_header_kasus a
                                WHERE a.lantai = '2'
                                and a.gedung = tbl_header_kasus.gedung
                                GROUP BY a.lantai,a.gedung) as lantai_2"),
                                DB::raw("(SELECT COUNT(a.lantai) FROM tbl_header_kasus a
                                WHERE a.lantai = '3'
                                and a.gedung = tbl_header_kasus.gedung
                                GROUP BY a.lantai,a.gedung) as lantai_3"),
                                DB::raw("(SELECT COUNT(a.lantai) FROM tbl_header_kasus a
                                WHERE a.lantai = 'Ground'
                                and a.gedung = tbl_header_kasus.gedung
                                GROUP BY a.lantai,a.gedung) as ground"),
                                DB::raw("(SELECT COUNT(a.lantai)  FROM tbl_header_kasus a
                                WHERE a.lantai = 'Pos 1'
                                and a.gedung = tbl_header_kasus.gedung
                                GROUP BY a.lantai,a.gedung) as pos_1"),
                                )
        ->where('status','PCR Positive') 
        // ->whereBetween('tgl_positif',[$request->startDate, $request->endDate])
        ->groupBy('gedung');
        
        $dataMap=$dataMap->get()->toArray(); 
        foreach ($dataMap as $row) {
            // dd($row);
            if($row->lantai_1==null){
                $row->lantai_1=0;

            }
             if($row->lantai_2==null){
                // dd($row->lantai_2);
                $row->lantai_2=0;

            } 
             if($row->lantai_3==null){
                $row->lantai_3=0;

            }
             if($row->ground==null){
                $row->ground=0;

            }  
             if($row->pos_1==null){
                $row->pos_1=0;

            }
            # code...
        }
        $dataGedung=DB::table('tbl_lokasi_kerja')->select('gedung','lokasi')->get();
 
        $arrTemplateData=array();
        

        foreach($dataGedung as $data){
            // dd( $data);
            $templateData=new stdClass();
            $templateData->gedung=$data->gedung;
            $templateData->lokasi=$data->lokasi;
            $templateData->total=0; 
            $templateData->lantai_1=0;
            $templateData->lantai_2=0;
            $templateData->lantai_3=0;
            $templateData->ground=0;
            $templateData->pos_1=0; 
           
            array_push($arrTemplateData, $templateData);

        } 
        // dd($dataMap);
        $collectionArrTemplate=collect($arrTemplateData);
        // $merged = $collectionArrTemplate->merge($dataMap);
        // $available_roles = $collectionArrTemplate->diff($dataMap);
        for($i=1;$i<count($collectionArrTemplate);$i++){
            // dd($collectionArrTemplate[$i]->gedung);
            
            $idx=array_search($collectionArrTemplate[$i]->gedung, array_column($dataMap,'gedung')); 
            // dd($dataMap[$idx]);
            
            if($idx != false){
                // dd($idx);
                $collectionArrTemplate[$i]->total=$dataMap[$idx]->total; 
                $collectionArrTemplate[$i]->lantai_1=$dataMap[$idx]->lantai_1;
                $collectionArrTemplate[$i]->lantai_2=$dataMap[$idx]->lantai_2;
                $collectionArrTemplate[$i]->lantai_3=$dataMap[$idx]->lantai_3;
                $collectionArrTemplate[$i]->ground=$dataMap[$idx]->ground;
                $collectionArrTemplate[$i]->pos_1=$dataMap[$idx]->pos_1;
            }
          
            // dd($getValue);
        }
    //    dd($dataMap);`
// dd($collectionArrTemplate);
        
        

// dd($dataMap);
 
        
        return response()->json([
            'dataMap' =>  $collectionArrTemplate,
            // 'dataGedung' =>$dataGedung
         
    ]);
        
    }

   

    

    
    
}
