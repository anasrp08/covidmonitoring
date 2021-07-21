<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
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
use Excel;
use Illuminate\Support\Facades\Crypt;


use Redirect;
use Validator;
use Response;
use DB;
// use File;
use PDF;


class ReportController extends Controller
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
    public function viewReportAll()
    {
        $dataKaryawan = DB::table('tbl_data_karyawan')->get();
        // $dataNp=DB::table('data_karyawan')->get();
        $dataKondisi = DB::table('tbl_kondisi_kasus')->get();
        // $dataNp=DB::table('tbl_kondisi_kasus')->get();
        $dataLokasikerja = DB::table('tbl_lokasi_kerja')->get();
        $dataStatus = DB::table('tbl_status')->get();
        $dataIsolasi = DB::table('tbl_tempat_isolasi')->get();
        $dataVaksin = DB::table('tbl_status_vaksin')->get();
        // $dataKota=DB::table('tbl_kota')->get();
        $dataKlaster = DB::table('tbl_klaster')->get();

        return view(
            'report.report_all.list',
            [
                'dataKaryawan' => $dataKaryawan,
                'dataKondisi' => $dataKondisi,
                'dataLokasikerja' => $dataLokasikerja,
                'dataStatus' => $dataStatus,
                'dataIsolasi' => $dataIsolasi,
                'dataVaksin' => $dataVaksin,
                'dataKlaster' => $dataKlaster
            ]
        );
    }

    public function decrypted($data)
    {
        return Crypt::decrypt($data);
    }
    public function getIdUnit($kolom, $kodeUnit)
    {
        // dd($kolom);
        $dataUnit = DB::table('tbl_md_sto')->where($kolom, $kodeUnit)->pluck('id_unit_kerja')->toArray();

        return $dataUnit;
    }
    public function indexKasus(Request $request)
    {
        ini_set('max_execution_time', 180); //3 minutes
        // $decryptIdProcess = $this->decrypted($request->id_process);
        // $decryptIdSto = $this->decrypted($request->id_sto);
        $user = Auth::user();

        $roleuser = $user->roles->first()->name;
        // dd($roleuser);
        $username = $user->username;
        $dataKaryawan = DB::table('tbl_data_karyawan')->where('np', $username)->first();

        $idUnit = null;
        // dd($dataKaryawan->obj_id_unit);
        switch ($roleuser) {
            case 'kadiv':
                $idUnit = $this->getIdUnit('id_divisi', $dataKaryawan->obj_id_unit);
                break;
            case 'kasek':
                $idUnit = $this->getIdUnit('id_seksi', $dataKaryawan->obj_id_unit);
                break;
            case 'kaun':
                $idUnit = $this->getIdUnit('id_unit', $dataKaryawan->obj_id_unit);
                break;
            case 'kadep':
                $idUnit = $this->getIdUnit('id_departemen', $dataKaryawan->obj_id_unit);
                break;
            case 'admin':
                $idUnit = 'all';
                break;
                case 'direksi':
                    $idUnit = 'all';
                    break;
            default:
                # code...
                break;
        }


        // dd($idUnit);
        if (request()->ajax()) {
            $queryData=DB::table('tbl_header_kasus')
        ->leftjoin('tbl_data_karyawan','tbl_header_kasus.np','tbl_data_karyawan.np')
        ->select(
        'tbl_header_kasus.id',
        'tbl_header_kasus.nama',
        'tbl_header_kasus.np',
        'tbl_header_kasus.direktorat',
        'tbl_header_kasus.divisi',
        'tbl_header_kasus.unit',
       
        'tbl_data_karyawan.lokasi as wilayah_kerja',
        'tbl_header_kasus.gedung',
        'tbl_header_kasus.lantai',
    'tbl_header_kasus.kota',
    'tbl_header_kasus.provinsi',
    'tbl_header_kasus.tempat_perawatan',
    'tbl_header_kasus.kluster_penyebaran',
    'tbl_header_kasus.status_vaksin',
     'tbl_header_kasus.tgl_positif', 
     'tbl_header_kasus.tgl_negatif', 
    // 'tgl_positif',
    // 'tgl_negatif',
    'tbl_header_kasus.status',
    'tbl_header_kasus.kondisi',
    'tbl_header_kasus.created_at',
    'tbl_header_kasus.updated_at',
    // 'created_at','updated_at'
   
    )->orderBy('tbl_header_kasus.id','asc');
    
            if ($idUnit == 'all') {
            } else {
                $queryData->whereIn('tbl_data_karyawan.obj_id_unit', $idUnit);
            }
 
            $queryData = $queryData->get();
            // dd( $queryData);

            return datatables()->of($queryData)

                ->addIndexColumn()
                // ->addColumn('action', 'action_update_pasien')
                // ->rawColumns(['action'])

                ->make(true);
        }
    }

    public function exportReportDataKasus(Request $request)
    {
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 240);
        ini_set('max_execution_time', 360);
        ini_set('max_input_time', 120);

        // dd($request->all());

        // dd($queryData);
        // dd($request->all());
        $date=date('d-m-Y');
        return Excel::download(new ReportExport(
            $request->tahun,
            $request->status,
            $request->jenispikai,
            $request->tipepikai,
            $request->seripikai
        ), 'ReportPeruriCovid-' .  $date . '.xlsx');;
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
}
