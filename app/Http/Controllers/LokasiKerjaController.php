<?php

namespace App\Http\Controllers;

use Excel;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Helpers\AppHelper;
use App\Imports\ApresiasiImport;
use App\Helpers\QueryHelper;
use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\Crypt;
use App\Exports\NilaiExport;
use Redirect;
use Validator;
use Response;
use DB;
use PDF;


class LokasiKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function decrypted($data)
    {
        return Crypt::decrypt($data);
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewPage()
    {
        return view('bonus-divisi.list', []);
    }
    public function viewIndexUnitKerja()
    {
        return view('bonus-divisi.list_unit_kerja', []);
    }
    public function viewIndexNilaiUnitKerja()
    {
        return view('bonus-divisi.list_nilai_unit_kerja', []);
    }
    public function viewIndexKaryawanDetail()
    {


        return view('bonus-divisi.list_karyawan_detail', []);
    }
    public function dashboarKaryawanDetail(Request $request)
    {

        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);

        $queryData = DB::table('tb_pooling_jp_divisi')
            ->join('tb_bonus_divisi', function ($join) {
                $join->on('tb_bonus_divisi.id_process', 'tb_pooling_jp_divisi.id_process')
                    ->on('tb_bonus_divisi.id_sto', 'tb_pooling_jp_divisi.id_sto');
            })
            ->select(
                'tb_pooling_jp_divisi.budget',
                'tb_pooling_jp_divisi.super_bonus',
                'tb_pooling_jp_divisi.status',
                DB::raw('SUM(tb_bonus_divisi.bonus + tb_bonus_divisi.super_bonus ) as jum_insentif'),
            )

            ->where('tb_pooling_jp_divisi.id_sto', $decryptIdSto)
            ->where('tb_pooling_jp_divisi.id_process', $decryptIdProcess)->first();

        return response()->json(['dataDashboard' =>  $queryData]);
    }
    public function indexTahunBonus(Request $request)
    {
        $userData = AuthHelper::getUserData();
        // dd($userData);
        if (request()->ajax()) {
            $queryData = DB::table('tb_master_jp');

            $queryData = $queryData->get();
            foreach ($queryData as $data) {
                $data->id_process = Crypt::encrypt($data->id_process);
                // $data->id_sto=Crypt::encrypt($data->id_sto); 
                // $data->id_process=$data->id_process;
                // $data->id_sto=$data->id_sto; 
            }
            return datatables()->of($queryData)
                ->addIndexColumn()
                ->addColumn('action', 'action_button')
                ->addColumn('pangkat', $userData->pangkat)
                ->addColumn('unit_sto', $userData->unit)
                ->addColumn('dir_sto', $userData->direktorat)
                ->rawColumns(['action', 'pangkat', 'unit_sto', 'dir_sto'])
                // ->rawColumns(['pangkat'])
                // ->rawColumns(['unit_sto'])
                // ->rawColumns(['dir_sto'])
                ->make(true);
        }

        return view('bonus-divisi.list', []);
    }
    public function indexUnitKerja(Request $request)
    {
        $decryptIdProcess = $this->decrypted($request->id_process);
        if (request()->ajax()) {
            $queryData = DB::table('tb_pooling_jp_divisi')
                ->join('tb_sto', 'tb_pooling_jp_divisi.id_sto', 'tb_sto.id_sto')
                ->join('tb_master_jp', 'tb_pooling_jp_divisi.id_process', 'tb_master_jp.id_process')
                ->join('tb_bonus_divisi', function ($join) {
                    $join->on('tb_bonus_divisi.id_process', 'tb_pooling_jp_divisi.id_process')
                        ->on('tb_pooling_jp_divisi.id_sto', 'tb_bonus_divisi.id_sto');
                })
                ->select(
                    'tb_sto.*',
                    'tb_master_jp.nama_process',
                    'tb_master_jp.id_process',
                    DB::raw('count(tb_bonus_divisi.np) as jml_kryawan'),
                    DB::raw('SUM(tb_bonus_divisi.bonus + tb_bonus_divisi.super_bonus ) as distribusi_bonus'),
                    'tb_pooling_jp_divisi.budget',
                    'tb_pooling_jp_divisi.status'
                )
                ->where('tb_pooling_jp_divisi.budget', '>', 0)
                ->where('tb_pooling_jp_divisi.id_process', $decryptIdProcess)
                ->whereNotIn('tb_pooling_jp_divisi.id_sto', ['1', '266', '267', '268', '269', '270'])

                ->groupBy('tb_bonus_divisi.id_sto')
                ->get();
            foreach ($queryData as $data) {
                $data->id_process = Crypt::encrypt($data->id_process);
                $data->id_sto = Crypt::encrypt($data->id_sto);
                // $data->id_process=$data->id_process;
                // $data->id_sto=$data->id_sto; 
            }
            return datatables()->of($queryData)

                ->addIndexColumn()
                ->addColumn('action', 'action_button_unitkerja')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('bonus-divisi.list', []);
    }

    public function indexNilaiUnitKerja(Request $request)
    {

        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);

        if (request()->ajax()) {
            $queryData = DB::table('tb_parameter_bonus')
                ->join('tb_pooling_jp_divisi', 'tb_parameter_bonus.kategori', 'tb_pooling_jp_divisi.kategori')
                ->join('tb_bonus_divisi', 'tb_bonus_divisi.pl', 'tb_parameter_bonus.predikat')
                ->join('tb_entry_pengkali', 'tb_bonus_divisi.pl', 'tb_entry_pengkali.pl')
                ->select(
                    'tb_bonus_divisi.pl',
                    'tb_entry_pengkali.pengkali_pl',
                    'tb_parameter_bonus.min',
                    'tb_parameter_bonus.max',
                    DB::raw('count(tb_bonus_divisi.np) as jml_kryawan'),
                    DB::raw('SUM(tb_bonus_divisi.bonus + tb_bonus_divisi.super_bonus ) as distribusi_bonus'),
                )

                ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
                ->where('tb_pooling_jp_divisi.id_process', $decryptIdProcess)
                ->where('tb_entry_pengkali.id_process', $decryptIdProcess)
                ->where('tb_parameter_bonus.id_process', $decryptIdProcess)
                ->where('tb_bonus_divisi.id_sto', $decryptIdSto)
                ->where('tb_pooling_jp_divisi.id_sto', $decryptIdSto)
                ->where('tb_entry_pengkali.id_sto', $decryptIdSto)
                ->where('tb_bonus_divisi.aktif', '0')

                ->groupBy('tb_bonus_divisi.pl')
                ->get();
            // $queryData = $queryData->get(); 
            return datatables()->of($queryData)

                ->addIndexColumn()
                ->addColumn('action', 'action_detail_nilai')
                ->addColumn('id_sto', $request->id_sto)
                ->addColumn('id_process', $request->id_process)
                ->rawColumns(['action'])

                ->make(true);
        }

        // return view('performance-level.list_detail2',[]);
    }
    public function indexNilaiKaryawan(Request $request)
    {
        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);

        if (request()->ajax()) {
            $queryData = DB::table('tb_bonus_divisi')
                ->join('tb_sto', 'tb_bonus_divisi.id_sto', '=', 'tb_sto.id_sto')
                ->join('tb_master_jp', 'tb_bonus_divisi.id_process', '=', 'tb_master_jp.id_process')
                ->select(
                    'tb_bonus_divisi.*',
                    'tb_sto.*',
                    'tb_master_jp.*'

                )
                ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
                ->where('tb_bonus_divisi.id_sto', $decryptIdSto)
                ->where('tb_bonus_divisi.pl', $request->pl)
                ->where('tb_bonus_divisi.aktif', $request->aktif)
                ->orderBy('tb_bonus_divisi.rank', 'asc');
            $queryData = $queryData->get();

            return datatables()->of($queryData)

                ->addIndexColumn()

                ->make(true);
        }

        // return view('performance-level.list_detail2',[]);
    }
    public function indexKaryawanPensiun(Request $request)
    {

        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);

        if (request()->ajax()) {
            $queryData = DB::table('tb_parameter_bonus')
                ->join('tb_pooling_jp_divisi', 'tb_parameter_bonus.kategori', 'tb_pooling_jp_divisi.kategori')
                ->join('tb_bonus_divisi', 'tb_bonus_divisi.pl', 'tb_parameter_bonus.predikat')
                ->join('tb_entry_pengkali', 'tb_bonus_divisi.pl', 'tb_entry_pengkali.pl')
                ->select(
                    'tb_bonus_divisi.pl',
                    'tb_entry_pengkali.pengkali_pl',
                    'tb_parameter_bonus.min',
                    'tb_parameter_bonus.max',
                    DB::raw('count(tb_bonus_divisi.np) as jml_kryawan'),
                    DB::raw('SUM(tb_bonus_divisi.bonus + tb_bonus_divisi.super_bonus ) as distribusi_bonus'),
                )

                ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
                ->where('tb_pooling_jp_divisi.id_process', $decryptIdProcess)
                ->where('tb_entry_pengkali.id_process', $decryptIdProcess)
                ->where('tb_parameter_bonus.id_process', $decryptIdProcess)
                ->where('tb_bonus_divisi.id_sto', $decryptIdSto)
                ->where('tb_pooling_jp_divisi.id_sto', $decryptIdSto)
                ->where('tb_entry_pengkali.id_sto', $decryptIdSto)
                ->where('tb_bonus_divisi.aktif', '1')

                ->groupBy('tb_bonus_divisi.pl')
                ->get();
            // $queryData = $queryData->get(); 
            return datatables()->of($queryData)

                ->addIndexColumn()
                ->addColumn('action', 'action_detail_nilai_1')
                ->addColumn('id_sto', $request->id_sto)
                ->addColumn('id_process', $request->id_process)
                ->rawColumns(['action'])

                ->make(true);
        }
 
    }
    
    public function indexDetailKaryawanPensiun(Request $request)
    {

        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);

        if (request()->ajax()) {
            $queryData = DB::table('tb_bonus_divisi')
                ->join('tb_sto', 'tb_bonus_divisi.id_sto', '=', 'tb_sto.id_sto')
                ->join('tb_master_jp', 'tb_bonus_divisi.id_process', '=', 'tb_master_jp.id_process')
                ->select(
                    'tb_bonus_divisi.*',
                    'tb_sto.*',
                    'tb_master_jp.*'

                )
                ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
                ->where('tb_bonus_divisi.id_sto', $decryptIdSto)
                ->where('tb_bonus_divisi.pl', $request->pl)
                ->where('tb_bonus_divisi.aktif', $request->aktif)
                ->orderBy('tb_bonus_divisi.rank', 'asc');
            $queryData = $queryData->get();

            return datatables()->of($queryData)

                ->addIndexColumn()

                ->make(true);
        }
 
    }

    public function dataMinMax(Request $request)
    {

        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);
        $queryTampil = DB::table('tb_bonus_divisi')
            ->join('tb_sto', 'tb_bonus_divisi.id_sto', '=', 'tb_sto.id_sto')
            ->join('tb_master_jp', 'tb_bonus_divisi.id_process', '=', 'tb_master_jp.id_process')
            ->where('tb_bonus_divisi.np', $request->np)
            ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
            ->first();

        $urutan_atas = (int)$queryTampil->rank - 1;
        $urutan_bawah = (int)$queryTampil->rank + 1;

        $queryRangeParameter = DB::table('tb_parameter_bonus')
            ->join('tb_bonus_divisi', 'tb_parameter_bonus.id_paramater', 'tb_bonus_divisi.id_parameter')
            ->where('tb_bonus_divisi.np', $request->np)
            ->where('tb_parameter_bonus.id_process', $decryptIdProcess)
            ->first();
        $queryJumlahOrang = DB::table('tb_bonus_divisi')
            ->select(DB::raw('count(tb_bonus_divisi.np)as total_orang'))
            ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
            ->where('tb_bonus_divisi.pl', $request->pl)
            ->where('tb_bonus_divisi.id_sto', $decryptIdSto)
            ->where('tb_bonus_divisi.aktif', $request->aktif)
            ->first();

        $min = null;
        if ($queryJumlahOrang->total_orang < $urutan_bawah) {
            $min = $queryRangeParameter->min;
        } else {
            $queryPengkali = DB::table('tb_bonus_divisi')
                ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
                ->where('tb_bonus_divisi.pl', $request->pl)
                ->where('tb_bonus_divisi.rank', $urutan_bawah)
                ->where('tb_bonus_divisi.id_sto', $decryptIdSto)
                ->first();
            $min = $queryPengkali->pengkali;
        }
        $max = null;
        if ($queryTampil->rank == '1') {
            $max = $queryRangeParameter->max;
        } else {
            $queryPengkali = DB::table('tb_bonus_divisi')
                ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
                ->where('tb_bonus_divisi.pl', $request->pl)
                ->where('tb_bonus_divisi.rank', $urutan_atas)
                ->where('tb_bonus_divisi.id_sto', $decryptIdSto)
                ->first();
            $max = $queryPengkali->pengkali;
        }

        return response()->json(['min' =>  $min, 'max' => $max]);
    }

    public function getMinMax(Request $request){

        $decryptIdProcess = $this->decrypted($request->id_process);
        // dd($decryptIdProcess);
        $decryptIdSto = $this->decrypted($request->id_sto);
        $queryMinMax = DB::table('tb_parameter_bonus')
        ->join('tb_pooling_jp_divisi', function ($join) {
            $join->on('tb_pooling_jp_divisi.id_process', 'tb_parameter_bonus.id_process')
                ->on('tb_pooling_jp_divisi.kategori', 'tb_parameter_bonus.kategori');
        })
             
            ->where('tb_parameter_bonus.predikat', $request->pl)
            ->where('tb_parameter_bonus.id_process', $decryptIdProcess)
            ->where('tb_pooling_jp_divisi.id_sto', $decryptIdSto)
            ->first();
            return response()->json(['batas' =>  $queryMinMax]);

    }
    public function setPengkali($decryptIdProcess, $decryptIdSto,$request,$min){
        $dataBonus=DB::table('tb_bonus_divisi')
        ->where('tb_bonus_divisi.id_process',$decryptIdProcess)
        ->where('tb_bonus_divisi.id_sto',$decryptIdSto)
        ->where('tb_bonus_divisi.pl',$request->pl)
        ->where('tb_bonus_divisi.aktif',0)
        ->orderBy('faktor','desc')->get(); 
        foreach ($dataBonus as $data) {
            $pengkali=(int)$request->pengkali;
            $hasilPengkali=$pengkali - ($pengkali*$data->faktor);
            $pengkaliTemp=null;

            if($hasilPengkali < $min){
                $pengkaliTemp=$min;
                $dataUpdate=array(
                    'pengkali'=>  $pengkaliTemp,
                    'final'=> 1
                );
                $updatePengkali=DB::table('tb_bonus_divisi')
                ->where('tb_bonus_divisi.id_process',$decryptIdProcess)
                ->where('tb_bonus_divisi.id_sto',$decryptIdSto)
                ->where('tb_bonus_divisi.np',$data->np)
                ->update($dataUpdate);
            }else{
                $pengkaliTemp=$hasilPengkali;
                $dataUpdate=array(
                    'pengkali'=>  $pengkaliTemp,
                    'final'=> 0
                );
                $updatePengkali=DB::table('tb_bonus_divisi')
                ->where('tb_bonus_divisi.id_process',$decryptIdProcess)
                ->where('tb_bonus_divisi.id_sto',$decryptIdSto)
                ->where('tb_bonus_divisi.np',$data->np)
                ->update($dataUpdate);
            }

            $total_bonus = ((int)$data->mk/12)*( (int)$data->gapok * (int)$pengkaliTemp); 
            $this->perhitunganPotonganBonus($request,$decryptIdProcess,$decryptIdSto,$data, $total_bonus);
            $this->updateBonus($request,$decryptIdProcess,$decryptIdSto,$data,$total_bonus);
        }
    }
    public function perhitunganPotonganBonus($request,$decryptIdProcess,$decryptIdSto,$data,$total_bonus){
        $dataPotongan=DB::table('tb_potongan')->where('np',$data->np)->where('id_process',$decryptIdProcess)->first();
      
       if($dataPotongan ==null){

       }else{
        $pot_cd =0;
        $pot_mangkir =0;
        $pot_hukuman =0;

        if( $dataPotongan->cd >= 13){
            $pot_cd = ($dataPotongan->cd / $dataPotongan->hari_kerja)*($total_bonus/2);
        }

        if($dataPotongan->mangkir >= 1){
            $pot_mangkir = ($dataPotongan->mangkir/$dataPotongan->hari_kerja)*($total_bonus);
        }

        if($dataPotongan->hukuman >= 50){
            $pot_hukuman = ($total_bonus/2);
        }
        $dataUpdatePotongan=array(
            'potongan_bonus'=> (int) $pot_cd+(int)$pot_mangkir+(int)$pot_hukuman
            
        );
        $dataUpdateBonusDivisi=array(
            'potongan'=>  (int) $pot_cd+(int)$pot_mangkir+(int)$pot_hukuman
           
        );
        $updatePotongan=DB::table('tb_potongan')
        ->where('tb_bonus_divisi.id_process',$decryptIdProcess) 
        ->where('tb_bonus_divisi.np',$data->np)
        ->update($dataUpdatePotongan);
         
        $updatePBonusDivisi=DB::table('tb_bonus_divisi')
        ->where('tb_bonus_divisi.id_process',$decryptIdProcess) 
        ->where('tb_bonus_divisi.np',$data->np)
        ->update($dataUpdateBonusDivisi);
       }
       

    }
    //need test
    public function updateBonus($request,$decryptIdProcess,$decryptIdSto,$data,$total_bonus){
        $dataBonus=DB::table('tb_bonus_divisi')
        ->where('tb_bonus_divisi.id_process',$decryptIdProcess)
        ->where('tb_bonus_divisi.id_sto',$decryptIdSto);
        $dataBonus1=$dataBonus->where('tb_bonus_divisi.pl',$request->pl)->get();
        
        $dataBonusJasprod=$dataBonus
        ->where('tb_bonus_divisi.pl',$request->pl)
        ->where('tb_bonus_divisi.aktif',0)->get();
        
        $dataSuperBonus= $dataBonus->get();
       

        foreach($dataBonus1 as $data){
            $dataUpdateBonus=array(
                'bonus'=>  ((int) $data->mk / 12)*((int)($data->gapok * (int)$data->pengkali))
               
            );
            $updatePengkali=DB::table('tb_bonus_divisi') 
            ->update($dataUpdateBonus);
        }
        foreach($dataBonusJasprod as $data){
            $dataUpdateBonus=array(
                'jasprod'=>  ((int) $data->bonus-((int) $data->um+(int) $data->potongan))
               
            );
            $updatePengkali1=DB::table('tb_bonus_divisi') 
            ->update($dataUpdateBonus);
        }
        foreach($dataSuperBonus as $data){
            $dataUpdateBonus=array(
                'super_bonus'=>  0
               
            );
            $updatePengkali1=DB::table('tb_bonus_divisi') 
            ->update($dataUpdateBonus);
        } 

    }
    public function validasiData($request,$decryptIdProcess,$decryptIdSto){
        $dataValidasi=DB::table('tb_parameter_bonus') 
        ->join('tb_pooling_jp_divisi', function ($join) {
            $join->on('tb_pooling_jp_divisi.id_process', 'tb_parameter_bonus.id_process')
                ->on('tb_pooling_jp_divisi.kategori', 'tb_parameter_bonus.kategori');
        })
        ->where('tb_parameter_bonus.predikat', $request->pl)
        ->where('tb_parameter_bonus.id_process', $decryptIdProcess)
        ->where('tb_pooling_jp_divisi.id_sto', $decryptIdSto)
        ->first();

        return $dataValidasi;
    }
    public function updatePengkaliGrup(Request $request){
        
        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);
        $error = null;
        $rules = array(
            'pengkali' => 'required',

        );
        $messages = array(
            'pengkali.required'            =>  'Besaran Pengkali Input Harus Diisi', 
        );

        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data_pengkali = array(
            'pengkali_pl'          =>  $request->pengkali
        );

       
       

        try {

            $queryUpdate = DB::table('tb_entry_pengkali')
                ->where('id_process', '=', $decryptIdProcess)
                ->where('id_sto', '=', $decryptIdSto)
                ->where('pl', '=', $request->pl)
                ->update($form_data_pengkali); 
                $min=$this->validasiData($request,$decryptIdProcess,$decryptIdSto)->min;
                
                $setPengkali=$this->setPengkali($decryptIdProcess, $decryptIdSto,$request,$min);
                 
            return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }

    }
    public function index(Request $request)
    {
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
    public function store(Request $request)
    {

        // dd($request->all());
        $error = null;
        $rules = array(
            'entridate' => 'required',
            'jenislimbah' => 'required',
            'namalimbah' => 'required',
            'fisiklimbah' => 'required',
            'limbahasal' => 'required',
            'jmlhlimbah' => 'required',
            'satuan' => 'required',
            'limbah3r' => 'nullable',
        );
        $messages = array(
            'entridate.required'            =>  'Tanggal Input Harus Diisi',
            'jenislimbah.required'            =>  'Jenis Limbah Harus Diisi',
            'namalimbah.required'            =>  'Nama Limbah Harus Diisi',
            'fisiklimbah.required'            =>  'Tipe Limbah Harus Diisi',
            'limbahasal.required'           =>  'Limbah Asal Harus Diisi',
            'jmlhlimbah.required'           =>  'Jumlah Limbah Harus Diisi',
            'satuan.required'               =>  'Satuan Harus Diisi',

        );

        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'namalimbah'        =>  $request->namalimbah,
            'tgl'                =>  AppHelper::convertDate($request->entridate),
            'asallimbah'        =>  $request->limbahasal,
            'fisik'              =>  $request->fisiklimbah,
            'jenislimbah'       => $request->jenislimbah,
            'mutasi'            =>  'Input',
            'jumlah'            =>  (int)$request->jmlhlimbah,
            'satuan'            =>  $request->satuan,
            'tps'               =>   $request->tps,
            'limbah3r'          =>   $request->limbah3r,

        );
        $queryNamaLimbah = DB::table('md_namalimbah')->where('id', '=', $request->idnamalimbah)->first();
        // dd($queryNamaLimbah);
        $jumlah = $queryNamaLimbah->saldo;
        $jumlah = $jumlah + (int)$request->jmlhlimbah;


        $updateJumlah = array(
            'saldo'            =>  (int)$jumlah,
        );
        try {
            $queryInsert = DB::table('tr_mutasilimbah')->insertTs($form_data, true);
            $queryUpdate = DB::table('md_namalimbah')->where('namalimbah', '=', $request->namalimbah)->updateTs($updateJumlah, true);
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

    public function indexApprove(Request $request)
    {
        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);

        if (request()->ajax()) {
            $queryData = DB::table('tb_bonus_divisi')
                ->join('tb_sto', 'tb_bonus_divisi.id_sto', '=', 'tb_sto.id_sto')
                
                ->select(
                    'tb_bonus_divisi.*',
                    DB::raw('count(tb_bonus_divisi.np) as jml_kryawan'),
                    DB::raw('SUM(tb_bonus_divisi.bonus + tb_bonus_divisi.super_bonus ) as jum_insentif'),

                )
                ->where('tb_bonus_divisi.id_process', $decryptIdProcess)
                ->where('tb_bonus_divisi.id_sto', $decryptIdSto)
                // ->where('tb_bonus_divisi.pl', $request->pl)
                // ->where('tb_bonus_divisi.aktif', 0)
                ->orderBy('tb_bonus_divisi.aktif', 'asc')
                ->orderBy('tb_bonus_divisi.pl', 'asc')
               
                ->groupBy('tb_bonus_divisi.pl','tb_bonus_divisi.aktif');
            $queryData = $queryData->get();

            return datatables()->of($queryData)

                ->addIndexColumn()
                ->addColumn('action', 'action_download') 
                ->rawColumns(['action'])

                ->make(true);
        }
    }
    public function updateApproveKadiv(Request $request)
    {
        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);
        

        $form_data_approve = array(
            'status'        =>  '1',
        );
        

        try {

            $updateInsentif = DB::table('tb_pooling_jp_divisi')
                ->where('id_process', '=', $decryptIdProcess)
                ->where('id_sto', '=', $decryptIdSto) 
                ->update($form_data_approve);
            return response()->json(['success' => 'Approval Berhasil Disimpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }
    public function updateApresiasi(Request $request)
    {
        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);
        $error = null;
        $rules = array(
            'nilai_apresiasi' => 'required',

        );
        $messages = array(
            'nilai_apresiasi.required'            =>  'Nilai Apresiasi Input Harus Diisi',


        );

        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'super_bonus'        =>  $request->nilai_apresiasi,
        );
        $querySuperBonus = DB::table('tb_bonus_divisi')
            ->where('id_process', '=', $decryptIdProcess)
            ->where('np', '=', $request->np)
            ->update($form_data);

        $dataInsentif = DB::table('tb_bonus_divisi')
            ->where('id_process', '=', $decryptIdProcess)
            ->where('np', '=', $request->np)
            ->first();
        $finalJasprod = ((int)$dataInsentif->bonus + (int)$dataInsentif->super_bonus) - ((int)$dataInsentif->potongan + (int)$dataInsentif->um);
        $form_data_jasprod = array(
            'jasprod'        => $finalJasprod,
        );

        try {

            $updateInsentif = DB::table('tb_bonus_divisi')
                ->where('id_process', '=', $decryptIdProcess)
                ->where('np', '=', $request->np)
                ->update($form_data_jasprod);
            return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }
    }
    public function hitungPotonganBonus(Request $request)
    {

        $decryptIdProcess = $this->decrypted($request->id_process);
        $queryPotongan = DB::table('tb_potongan')
            ->where('id_process', '=', $decryptIdProcess)
            ->where('np', '=', $request->np_personal)
            ->first();

        $cd      = $queryPotongan->cd;
        $mangkir = $queryPotongan->mangkir;
        $hukuman = $queryPotongan->hukuman;
        $hari_kerja = $queryPotongan->hari_kerja;

        $pot_cd = 0;
        $pot_mangkir = 0;
        $pot_hukuman = 0;

        if ($cd >= 13) {
            $pot_cd = ($cd / $hari_kerja) * ($request->total_bonus_pengkali / 2);
        }

        if ($mangkir >= 1) {
            $pot_mangkir = ($mangkir / $hari_kerja) * ($request->total_bonus_pengkali);
        }

        if ($hukuman >= 50) {
            $pot_hukuman = ($request->total_bonus_pengkali / 2);
        }
        $queryDataBonusDivisi = DB::table('tb_bonus_divisi')
            ->where('id_process', '=', $decryptIdProcess)
            ->where('np', '=', $request->np_personal)
            ->first();

        $bonus = (int)$queryDataBonusDivisi->bonus;
        $super_bonus = (int)$queryDataBonusDivisi->super_bonus;
        $potongan = (int)$queryDataBonusDivisi->potongan;
        $um = (int)$queryDataBonusDivisi->um;

        $dataPotongan = array(
            'potongan_bonus'          =>  $pot_cd + $pot_mangkir + $pot_hukuman
        );
        $queryPotonganBonus = DB::table('tb_potongan')
            ->where('id_process', '=', $decryptIdProcess)
            ->where('np', '=', $request->np_personal)
            ->update($dataPotongan);

        $dataPotonganBonus = array(
            'potongan'          =>  $pot_cd + $pot_mangkir + $pot_hukuman
        );
        $queryPotonganBonusDivisi = DB::table('tb_bonus_divisi')
            ->where('id_process', '=', $decryptIdProcess)
            ->where('np', '=', $request->np_personal)
            ->update($dataPotonganBonus);


        $dataPotonganJasprod = array(
            'jasprod'          => ($bonus + $super_bonus) - ($potongan + $um)
        );
        $queryPotonganJasprod = DB::table('tb_bonus_divisi')
            ->where('id_process', '=', $decryptIdProcess)
            ->where('np', '=', $request->np_personal)
            ->update($dataPotonganJasprod);
    }
    public function updatePengkali(Request $request)
    {

        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);
        $error = null;
        $rules = array(
            'bonus_pengkali' => 'required',

        );
        $messages = array(
            'bonus_pengkali.required'            =>  'Besaran Bonus Input Harus Diisi',


        );

        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data_pengkali = array(
            'pengkali'          =>  $request->bonus_pengkali,
            'bonus'             =>  $request->total_bonus_pengkali
        );

        try {
            $queryUpdate = DB::table('tb_bonus_divisi')
                ->where('id_process', '=', $decryptIdProcess)
                ->where('np', '=', $request->np_personal)
                ->update($form_data_pengkali);
            $this->hitungPotonganBonus($request);
            return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }
    }
    public function updateTemplate(Request $request)
    {
        $decryptIdProcess = $this->decrypted($request->id_process);
        $error = null;
        $rules = array(
            'apresiasi' => 'required',

        );
        $messages = array(
            'apresiasi.required'            =>  'Nilai Apresiasi Input Harus Diisi',


        );

        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'super_bonus'        =>  $request->apresiasi,
        );
        $queryNamaLimbah = DB::table('tb_bonus_divisi')
            ->where('id_process', '=', $request->namalimbah)
            ->where('np', '=', $request->namalimbah)
            ->update($form_data);
        $jasprod =

            $form_data_jasprod = array(
                'jasprod'        =>  $request->apresiasi,
            );

        $queryNamaLimbah = DB::table('md_namalimbah')->where('namalimbah', '=', $request->namalimbah)->first();
        $queryNamaLimbah = DB::table('md_namalimbah')->where('namalimbah', '=', $request->namalimbah)->first();
        try {
            $queryUpdateData = DB::table('tr_mutasilimbah')->where('id', '=', $request->hidden_id)->updateTs($form_data, true);
            // dd( $queryUpdateData);
            $queryUpdate = DB::table('md_namalimbah')->where('namalimbah', '=', $request->namalimbah)->updateTs($updateJumlah, true);
            return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }
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

    public static function getDownloadTemplate()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/file/template_P2_247.xls";
        $filename = 'tes.xls';
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel'
        );
        return response()->download($file, 'template_P2_247.xls', $headers);
    }
    public function exportTemplate(Request $request)
    {
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 240);
        ini_set('max_execution_time', 360);
        ini_set('max_input_time', 120);
        $decryptIdSto = $this->decrypted($request->id_sto);
        // dd($request->all());

        // dd($queryData);
        // dd($request->all());
        return Excel::download(new NilaiExport(

            $request->id_process,
            $request->pl,
            $request->aktif,
            $request->id_sto
        ), 'template_' . $request->pl . '_' . $decryptIdSto . '.xls');;
    }

    public function checkMaxApresiasi($request)
    {

        $max_apresiasi = null;
        if ($request->pl == 'P1') {
            $max_apresiasi = 5000000;
        } elseif ($request->pl == 'P2') {
            $max_apresiasi = 5000000;
        } elseif ($request->pl == 'P3') {
            $max_apresiasi = 5000000;
        }

        return $max_apresiasi;
    }

    public function importApresiasi(Request $request)
    {
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . "_" . $file->getClientOriginalName();
        // upload ke folder file_siswa di dalam folder public
        $file->move('file_apresiasi', $nama_file);
        $path_file = public_path('/file_apresiasi/' . $nama_file);
        // import data
        $data = Excel::toArray(new ApresiasiImport, $path_file);

        $decryptIdProcess = $this->decrypted($request->id_process);
        $decryptIdSto = $this->decrypted($request->id_sto);

        $maxApresiasi = $this->checkMaxApresiasi($request);

        if (count($data[0]) > 1) {
            try {
                foreach ($data[0] as $row) {

                    $apresiasiTotal = null;
                    if ($row[3] >= $maxApresiasi) {
                        $apresiasiTotal = $maxApresiasi;
                    } else {
                        $apresiasiTotal = $row[3];
                    }
                    $paramData = array(
                        'super_bonus' => $apresiasiTotal,
                    );
                    $queryNamaLimbah = DB::table('tb_bonus_divisi')
                        ->where('id_process', '=', $decryptIdProcess)
                        ->where('id_sto', '=', $decryptIdSto)
                        ->where('np', '=', $row[0])
                        ->update($paramData);
                }


                $queryDataBonusDivisi = DB::table('tb_bonus_divisi')
                    ->where('id_sto', '=', $decryptIdSto)
                    ->where('pl', '=', $request->pl)
                    ->first();

                $bonus = $queryDataBonusDivisi->bonus;
                $super_bonus = $queryDataBonusDivisi->super_bonus;
                $um = $queryDataBonusDivisi->um;
                $potongan = $queryDataBonusDivisi->potongan;

                $paramDataBonus = array(
                    'jasprod' => ($bonus + $super_bonus - ($um + $potongan))
                );
                $queryNamaLimbah = DB::table('tb_bonus_divisi')
                    ->where('id_sto', '=', $decryptIdSto)
                    ->where('pl', '=', $request->pl)
                    ->update($paramDataBonus);
                    
                return response()->json(['success' => 'Data Berhasil Di Simpan']);
            } catch (Exception $e) {
                return response()->json(['error' => 'Data Gagal Disimpan']);
            }
        }
    }
}
