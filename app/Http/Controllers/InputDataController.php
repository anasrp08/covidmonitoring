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
use App\Imports\DataKasusImport;
use App\Imports\DataKasusImportNew;
use Redirect;
use Validator;
use Response;

use Exception;
use DB;
use PDF;


class InputDataController extends Controller
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
    public function viewInputData()
    {
        $user = Auth::user();
        // $dataNp=DB::table('data_karyawan')->get();
        $dataKondisi = DB::table('tbl_kondisi_kasus')->get();
        $dataProv = DB::table('tbl_prov')->get();
        $dataLokasikerja = DB::table('tbl_lokasi_kerja')->groupBy('lokasi')->get();
        $dataGedung = DB::table('tbl_lokasi_kerja')->get();
        $dataStatus = DB::table('tbl_status')->get();
        $dataIsolasi = DB::table('tbl_tempat_isolasi')->get();
        $dataVaksin = DB::table('tbl_status_vaksin')->get();
        $dataKota = DB::table('tbl_kota')->get();
        $dataKlaster = DB::table('tbl_klaster')->get();

        return view('input_data.input_data', [
            'dataKondisi' => $dataKondisi,
            'dataLokasikerja' => $dataLokasikerja,
            'dataGedung' => $dataGedung,
            'dataStatus' => $dataStatus,
            'dataProv' => $dataProv,
            'dataIsolasi' => $dataIsolasi,
            'dataVaksin' => $dataVaksin,
            'dataKota' => $dataKota,
            'dataKlaster' => $dataKlaster

        ]);
    }
    public function viewInputUpload()
    {
        return view('input_data.input_upload', []);
    }



    public function viewUpdate()
    {
        $dataGedung = DB::table('tbl_lokasi_kerja')->get();
        // $dataNp=DB::table('data_karyawan')->get();
        $dataKondisi = DB::table('tbl_kondisi_kasus')->get();
        $dataProv = DB::table('tbl_prov')->get();
        $dataLokasikerja = DB::table('tbl_lokasi_kerja')->get();
        $dataStatus = DB::table('tbl_status')->get();
        $dataIsolasi = DB::table('tbl_tempat_isolasi')->get();
        $dataVaksin = DB::table('tbl_status_vaksin')->get();
        $dataKota = DB::table('tbl_kota')->get();
        $dataKlaster = DB::table('tbl_klaster')->get();


        return view('input_data.input_update', [
            'dataKondisi' => $dataKondisi,
            'dataProv' => $dataProv,
            'dataGedung' => $dataGedung,
            'dataLokasikerja' => $dataLokasikerja,
            'dataStatus' => $dataStatus,
            'dataIsolasi' => $dataIsolasi,
            'dataKota' => $dataKota,
            'dataVaksin' => $dataVaksin,
            'dataKlaster' => $dataKlaster
        ]);
    }

    public static function getDownloadTemplate()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/template_upload.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, 'template_upload.xlsx', $headers);
    }
    public function uploadDataKaryawan(Request $request)
    {
        $toStore = null;
        if ($request->hasFile('upload_data')) {
            $file = $request->file('upload_data');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->move('file_covid', $filename);
            $path_file = public_path('file_covid/' . $filename);
            //kalau publish
            // $path_file = 'file_covid/' . $filename;
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = (new DataKasusImportNew)->toArray($path_file, null, \Maatwebsite\Excel\Excel::XLSX);
            $toStore = $this->storeUpload($data);
            // dd($toStore);
        }
        // return 'Berhasil';
        return $toStore;
    }
    public function transformDateTime($value, $format = 'Y-m-d')
    {
        // dd($value);
        try {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format($format);
        } catch (Exception $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }
    public  function storeUpload($data)
    {

        // dd($data);
        // $data = Excel::toArray(new Insentif1Import, $path_file);  
        if (count($data[0]) > 1) {
            try {

                foreach ($data[0] as $row) {
                    if ($row[2] != null) {
                        // dd($row);
                        $kota = DB::table('tbl_kota')->where('kota', $row[9])->pluck('id_prov');

                        $provinsi = DB::table('tbl_prov')->where('id', $kota[0])->pluck('provinsi');


                        // $tgl1=Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]))->format('d/m/Y');
                        $tgl = null;
                        if (is_numeric($row[13])) {
                            $tgl = $this->transformDateTime($row[13]);
                        } else {

                            $tgl = Carbon::createFromFormat('d/m/Y', $row[13])->format('Y-m-d');;
                        }
 

                        $dataKasus = $this->checkIfNPExist($row);
                        // dd($dataKasus);

                        $getIdHeader = $this->uploadToHeader($dataKasus, $row, $kota[0], $provinsi[0], $tgl);
                        //    dd( $getIdHeader );

                        $storeDetail = $this->uploadToDetail($getIdHeader, $row, $kota[0], $provinsi[0], $tgl);
                    }
                }
                return response()->json(['success' => count($data[0]) . ' Data Berhasil Di Simpan']);
            } catch (Exception $e) {
                return response()->json(['error' => 'Ada Kesalahan Sistem: ' . $e->getMessage()]);
            }
        }
    }
    public function checkIfNPExist($row)
    {
        $dataKaryawan = DB::table('tbl_header_kasus')->where('np', $row[2])->first();
        // dd($dataKaryawan);
        if ($dataKaryawan != null) {

            return $dataKaryawan;
        } else {
            return 'kosong';
        }
    }

    public function uploadToHeader($dataKasus, $row, $kota, $prov,   $tgl)
    {
        setlocale(LC_TIME, 'id');
        date_default_timezone_set('asia/jakarta');
        try {
            $tgl_positif = null;
            $tgl_negatif = null;

            $paramData = array(
                'nama' => $row[1],
                'np' => $row[2],
                'direktorat' => $row[3],
                'divisi' => $row[4],
                'unit' => $row[5],
                'wilayah_kerja' => $row[6],
                'gedung' => $row[7],
                'lantai' => $row[8],
                'provinsi' => $prov,
                'kota' => $row[9],
                'tempat_perawatan' => $row[10],
                'kluster_penyebaran' => $row[11],
                'status_vaksin' => $row[12],
                // 'tgl_positif' => $tgl_positif,
                'status' => $row[14],
                'kondisi' => $row[15]
                // 'created_at'=>date('Y-m-d H:i:s')
            );
            switch ($row[14]) {
                case 'Antigen Positive':
                    $paramData += array(
                        'tgl_negatif' => null,
                        'tgl_positif' => $tgl,
                    );
                    break;
                case 'Antigen Negative':
                    $paramData += array('tgl_negatif' => $tgl);
                    break;

                case 'PCR Positive':
                    $paramData += array(
                        'tgl_positif' => $tgl
                        // 'tgl_negatif' => null

                    );
                    break;

                case 'PCR Negative':
                    $paramData += array(
                        'tgl_negatif' => $tgl

                    );
                    break;
                case 'Sembuh':
                    $paramData += array(
                        'tgl_negatif' => $tgl

                    );
                    break;
                case 'Meninggal':
                    $paramData += array(
                        'tgl_negatif' => $tgl

                    );
                    break;

                default:
                    $tgl_positif = null;
                    $tgl_negatif = null;
                    break;
            }

            if ($dataKasus != 'kosong') {
                $paramData += array('updated_at' => date('Y-m-d H:i:s'));
                // dd( $paramData);
                $updateHeader = DB::table('tbl_header_kasus')->where('id', $dataKasus->id)->update($paramData);

                return $dataKasus->id;
            } else {

                // try {`
                $paramData += array('created_at' => date('Y-m-d H:i:s'));
                $idHeader = DB::table('tbl_header_kasus')->insertGetId($paramData);
// dd( $idHeader);
                return $idHeader;
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Ada Kesalahan Sistem: ' . $e->getMessage()]);
        }
    }
    public function uploadToDetail($idHeader, $row, $kota, $prov, $tgl)
    {
        setlocale(LC_TIME, 'id');
        date_default_timezone_set('asia/jakarta');

        $paramData = array(
            'id_kasus' => $idHeader,
            'nama' => $row[1],
            'np' => $row[2],
            'direktorat' => $row[3],
            'divisi' => $row[4],
            'unit' => $row[5],
            'wilayah_kerja' => $row[6],
            'gedung' => $row[7],
            'lantai' => $row[8],
            'provinsi' => $prov,
            'kota' => $row[9],
            'tempat_perawatan' => $row[10],
            'kluster_penyebaran' => $row[11],
            'tgl' => $tgl,
            'tipe_tes' => $row[13],
            'status' => $row[14],
            'kondisi' => $row[15],


            // 'status_vaksin' => $row[7], 

            'created_at' => date('Y-m-d H:i:s')
        );
        // dd( $paramData);
        $inserDetail = DB::table('tbl_detail_kasus')->insert($paramData);
    }


    public function indexDataKaryawan(Request $request)
    {

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
   
    )->orderBy('tbl_header_kasus.created_at','desc');
     
            
            $queryData = $queryData->get();

            return datatables()->of($queryData)

                ->addIndexColumn()
                ->addColumn('action', 'action_data_pasien')
                ->rawColumns(['action'])

                ->make(true);
        }
    }
    public function updateDataKaryawan(Request $request)
    {
        // dd($request->all());
        setlocale(LC_TIME, 'id');
        date_default_timezone_set('asia/jakarta');
        $error = null;
        $rules = array(
            'np_edit' => 'required',
            'wilayah_kerja_edit' => 'required',
            'gedung_edit' => 'required',
            'lantai_edit' => 'required',
            // 'isolasi_edit' => 'required',
            'perawatan_edit' => 'required',
            'klaster_edit' => 'required',
            'tglpositif_edit' => 'required',
            'tglnegative_edit' => 'required',
            'status_edit' => 'required',
            'kondisi_kasus_edit' => 'required',
            'vaksin_edit' => 'required'

        );
        $messages = array(
            'np_edit.required' => 'Nomor Pegawai  Harus Diisi',
            'wilayah_kerja_edit.required' => 'Wilayah Kerja  Harus Diisi',
            'gedung_edit.required' => 'Lokasi Gedung  Harus Diisi',
            'lantai_edit.required' => 'Lokasi Lantai  Harus Diisi',
            // 'isolasi_edit.required' => 'Lokasi Isolasi  Harus Diisi',
            'perawatan_edit.required' => 'Lokasi Perawatan  Harus Diisi',
            'klaster_edit.required' => 'Klaster  Harus Diisi',
            'tglpositif_edit.required' => 'Tgl Positif  Harus Diisi',
            'tglnegative_edit.required' => 'Tgl Negative  Harus Diisi',
            'status_edit.required' => 'Status  Harus Diisi',
            'kondisi_kasus_edit.required' => 'Kondisi Karyawan  Harus Diisi',
            'vaksin_edit.required' => 'Status Vaksin  Harus Diisi'
        );

        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->fails()) {
            return response()->json(['error' => $error->errors()->all()]);
        }
        $form_update = array(
            'np' => $request->np_edit,
            'wilayah_kerja' => $request->wilayah_kerja_edit,
            'gedung' => $request->gedung_edit,
            'lantai' => $request->lantai_edit,
            // 'tempat_isolasi' => $request->isolasi_edit,
            'tempat_perawatan' => $request->perawatan_edit,
            'kluster_penyebaran' => $request->klaster_edit,
            'tgl_positif'    => AppHelper::convertDate($request->tglpositif_edit),
            'tgl_negatif'    => AppHelper::convertDate($request->tglnegative_edit),
            'status'        => $request->status_edit,
            'kondisi'            => $request->kondisi_kasus_edit,
            'status_vaksin'            => $request->vaksin_edit,
            'updated_at' => date('Y-m-d H:i:s')
        );
        

        try {

            $queryUpdate = DB::table('tbl_header_kasus')
                ->where('id', '=', $request->hidden_id)

                ->update($form_update);

                if($request->status_edit =='PCR Negative'){
                    $form_detail = array(
                        'id_kasus' =>  $request->hidden_id,
                        'np' => $request->np_edit,
                        'wilayah_kerja' => $request->wilayah_kerja_edit,
                        'gedung' => $request->gedung_edit,
                        'lantai' => $request->lantai_edit,
                        // 'tempat_isolasi' => $request->isolasi_edit,
                        'tempat_perawatan' => $request->perawatan_edit,
                        'kluster_penyebaran' => $request->klaster_edit,
                        'tgl'    => AppHelper::convertDate($request->tglnegative_edit), 
                        'status'        => $request->status_edit,
                        'kondisi'            => $request->kondisi_kasus_edit,
                        'created_at' => date('Y-m-d H:i:s')
                    ); 
                    $queryUpdate = DB::table('tbl_detail_kasus') 
                    ->insert($form_detail);
                }

               

            return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Ada Kesalahan Sistem: ' . $e->getMessage()]);
            // return response()->json(['error' => 'Data Gagal Disimpan']);
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
        setlocale(LC_TIME, 'id');
        date_default_timezone_set('asia/jakarta');

        try {
            $username = AuthHelper::getAuthUser()[0]->email;
            $getRequest = json_decode($request->getContent(), true);
            $dataRequest = $getRequest['Data'];

            $countDataReq = count($dataRequest);
            $error = null;

            foreach ($dataRequest as $row) {
                $tgl_positif = null;
                $tgl_negatif = null;
                $tgl = AppHelper::convertDate($row['tgl']);


                $dataHeader = array(
                    'np' => $row['np'],
                    'nama' => $row['nama'],

                    'direktorat' => $row['nama_direktorat'],
                    'divisi' => $row['nama_divisi'],
                    'unit' => $row['nama_unit'],
                    'wilayah_kerja' => $row['wilayah_kerja'],
                    'gedung' => $row['gedung'],
                    'lantai' => $row['lantai'],
                    'provinsi' => $row['provinsi'],
                    'kota' => $row['kota'],
                    'kondisi' => $row['kondisi'],
                    'tempat_perawatan' => $row['tempat_perawatan'],
                    'kluster_penyebaran' => $row['kluster_penyebaran'],
                    'status_vaksin' => $row['status_vaksin'],
                    // 'tgl_positif' => $tgl_positif,
                    // 'tgl_negatif' => $tgl_negatif,

                    'status' => $row['status'],
                   
                );
                switch ($row['status']) {
                    case 'Antigen Positive':
                        $dataHeader += array(
                            'tgl_negatif' => null,
                            'tgl_positif' => $tgl,
                        );
                        break;
                    case 'Antigen Negative':
                        $dataHeader += array('tgl_negatif' => $tgl);
                        break;

                    case 'PCR Positive':
                        $dataHeader += array(
                            'tgl_positif' => $tgl
                            // 'tgl_negatif' => null

                        );
                        break;

                    case 'PCR Negative':
                        $dataHeader += array(
                            'tgl_negatif' => $tgl

                        );
                        break;
                    case 'Sembuh':
                        $dataHeader += array(
                            'tgl_negatif' => $tgl

                        );
                    case 'Meninggal':
                        $dataHeader += array(
                            'tgl_negatif' => $tgl

                        );
                        break;
                        break;

                    default:
                        $tgl_positif = null;
                        $tgl_negatif = null;
                        break;
                }
                $idHeader = null;
                $isExist = DB::table('tbl_header_kasus')->where('np', '=', $row['np']);
                // dd($isExist->first()->tgl_negatif);
                if ($isExist->count() > 0) {
                    $getIdHeader = $isExist->first('id');
                    //jika np sdh ada tapi belum negatif
                    // if ($isExist->first()->tgl_negatif == null && $isExist->first()->status == 'PCR Positive' && $row['status'] == 'PCR Negative') {
                        $dataHeader+=array( 'updated_at' =>  date('Y-m-d H:i:s'));
                        $updateData = DB::table('tbl_header_kasus')->where('np', $row['np'])
                            ->update($dataHeader);
                        $idHeader = $getIdHeader->id;
                    // } else if ($isExist->first()->tgl_negatif == null && $isExist->first()->status == 'Antigen Positive' && $row['status'] == 'Antigen Negative') {
                    //     $updateData = DB::table('tbl_header_kasus')->where('np', $row['np'])
                    //         ->update($dataHeader);
                    //     $idHeader = $getIdHeader->id;
                    // } else {
                    //     $idHeader = DB::table('tbl_header_kasus')
                    //         ->insertGetId($dataHeader);
                    // }
                } else {
                    $dataHeader+=array( 'created_at' =>  date('Y-m-d H:i:s'));
                    $idHeader = DB::table('tbl_header_kasus')
                        ->insertGetId($dataHeader);
                }
                $storeDetail = $this->storeDetail($idHeader, $row, $tgl);
            }

            // UpdtSaldoHelper::updateSaldoNamaLimbah($row['nama_limbah'],$row['jmlhlimbah']);
            return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            // return $e->getMessage();
            return response()->json(['error' => 'Ada Kesalahan Sistem: ' . $e->getMessage()]);
        }
    }
    public function storeDetail($id, $row, $tgl)
    {
        $dataDetail = array(
            'id_kasus' => $id,
            'np' => $row['np'],
            'nama' => $row['nama'],

            'direktorat' => $row['nama_direktorat'],
            'divisi' => $row['nama_divisi'],
            'unit' => $row['nama_unit'],
            'wilayah_kerja' => $row['wilayah_kerja'],
            'tgl' => $tgl,
            'tipe_tes' => $row['status'],
            'kondisi' => $row['kondisi'],
            'gedung' => $row['gedung'],
            'lantai' => $row['lantai'],
            'kota' => $row['kota'],
            'provinsi' => $row['provinsi'],
            'tempat_perawatan' => $row['tempat_perawatan'],
            'kluster_penyebaran' => $row['kluster_penyebaran'],
            // 'status_vaksin'=>$row['status_vaksin'],  
            'status' => $row['status'],
            'created_at' =>  date('Y-m-d H:i:s')

        );
        $insertDetail = DB::table('tbl_detail_kasus')
            ->insert($dataDetail);
    }

    public function getDataKaryawan(Request $request)
    {
        //

        $dataKaryawan = DB::table('tbl_data_karyawan')
            ->join('tbl_md_sto', 'tbl_md_sto.id_unit_kerja', 'tbl_data_karyawan.obj_id_unit')
            ->select('tbl_data_karyawan.nama', 'tbl_md_sto.unit_kerja', 'tbl_md_sto.divisi', 'tbl_md_sto.direktorat', 'tbl_data_karyawan.lokasi')
            ->where('np', $request->np)
            ->first();

        return response()->json(['data' => $dataKaryawan]);
    }
    public function getKota(Request $request)
    {
        //
        $idProv = DB::table('tbl_prov')
            ->where('provinsi', $request->id_prov)
            ->first();
        $html = '';
        $dataKota = DB::table('tbl_kota')
            ->where('id_prov', $idProv->id)
            ->get();
        $html .= '<option value="-">-</option>';
        foreach ($dataKota as $kota) {
            $html .= '<option value="' . $kota->kota . '">' . $kota->kota . '</option>';
        }
        return response()->json(['html' => $html]);
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
        $data = DB::table('tbl_kasus')->where('id', $id);
        $data->delete();
        return response()->json(['success' => 'Berhasil Dihapus']);
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
}
