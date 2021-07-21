<?php

namespace App\Http\Controllers;

use App\BonusDivisi;
use App\Imports\BonusDivisiImport;
use App\Imports\DistribusiLevelImport;
use App\Imports\Insentif1Import;
use App\Imports\KadepImport;
use App\Imports\KadivImport;
use App\Imports\PegawaiImport;
use App\Imports\PengkaliImport;
use Illuminate\Http\Request;
use App\Imports\PerformanceImport;
use App\Imports\PotonganImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class UploadMasterController extends Controller
{
    //
    public function viewUploadMaster(Request $request)
    {

        return view('upload_data.upload_page');
    }

    public function uploadPerformance(Request $request)
    {
        // dd($request->hasFile('avatar'));
        if ($request->hasFile('performance_level')) {
            $file = $request->file('performance_level');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/performance_level', $filename);
            $path_file = public_path('master_data/performance_level/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::import(new PerformanceImport, $path_file);
        }


        return 'Berhasil';
    }
    public function uploadBonusDivisi(Request $request)
    {
        // dd($request->hasFile('avatar'));
        if ($request->hasFile('bonus_divisi')) {
            $file = $request->file('bonus_divisi');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/bonus_divisi', $filename);
            $path_file = public_path('master_data/bonus_divisi/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::import(new BonusDivisiImport, $path_file);
        }


        return 'Berhasil';
    }
    

    


    public function uploadPotongan(Request $request)
    {
        // dd($request->hasFile('avatar'));
        if ($request->hasFile('potongan')) {
            $file = $request->file('potongan');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/potongan', $filename);
            $path_file = public_path('master_data/potongan/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::import(new PotonganImport, $path_file);
        }

        return 'Berhasil';
    }

    public function uploadInsentif1(Request $request)
    {
        // dd($request->hasFile('avatar'));
        if ($request->hasFile('insentif_sms_1')) {
            $file = $request->file('insentif_sms_1');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/insentif_sms_1', $filename);
            $path_file = public_path('master_data/insentif_sms_1/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::toArray(new Insentif1Import, $path_file);  
        if (count($data[0]) > 1) {
            try {
                foreach ($data[0] as $row) {
                     
                    $idProcess = $row[1]; 
                    $paramData = array(
                        'um'=> $row[2],
                        'potongan' => $row[3]
                        
                    );
                    $queryNamaLimbah = DB::table('tb_bonus_divisi')
                        ->where('id_process', '=', $idProcess) 
                        ->where('np', '=', $row[0])
                        ->update($paramData);
                } 
                return response()->json(['success' => 'Data Berhasil Di Simpan']);
            } catch (Exception $e) {
                return response()->json(['error' => 'Data Gagal Disimpan']);
            }
        }
        }


        return 'Berhasil';
    }
    public function uploadPegawai(Request $request)
    {
        if ($request->hasFile('pegawai')) {
            $file = $request->file('pegawai');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/pegawai', $filename);
            $path_file = public_path('master_data/pegawai/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::import(new PegawaiImport, $path_file);
        }

        return 'Berhasil';
    }
    public function uploadKadep(Request $request)
    {
        if ($request->hasFile('kadep')) {
            $file = $request->file('kadep');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/kadep', $filename);
            $path_file = public_path('master_data/kadep/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::import(new KadepImport, $path_file);
        }

        return 'Berhasil';
    }
    public function uploadKadiv(Request $request)
    {
        if ($request->hasFile('kadiv')) {
            $file = $request->file('kadiv');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/kadiv', $filename);
            $path_file = public_path('master_data/kadiv/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::import(new KadivImport, $path_file);
        }

        return 'Berhasil';
    }
    public function uploadDisLvl(Request $request)
    {
        if ($request->hasFile('dislvl')) {
            $file = $request->file('kadislvldiv');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/dislvl', $filename);
            $path_file = public_path('master_data/dislvl/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::import(new DistribusiLevelImport, $path_file);
        }

        return 'Berhasil';
    }
    public function uploadPengkali(Request $request)
    {
        if ($request->hasFile('pengkali')) {
            $file = $request->file('pengkali');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;

            $file->move('master_data/pengkali', $filename);
            $path_file = public_path('master_data/pengkali/' . $filename);
            // $file->storeAs('pl/tmp' . $folder, $filename); 
            $data = Excel::import(new PengkaliImport, $path_file);
        }

        return 'Berhasil';
    }
    
    public static function getDownloadTemplatePL()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/1-template_pl.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, '1-template_pl.xlsx', $headers);
    }
    public static function getDownloadBonusDivisi()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/2-template_bonus_divisi.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, '2-template_bonus_divisi.xlsx', $headers);
    }
    public static function getDownloadInsentif1()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/3-template_insentif1.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, '3-template_insentif1.xlsx', $headers);
    }

    
    public static function getDownloadPotongan()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/4-template_potongan.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, '4-template_potongan.xlsx', $headers);
    }
    public static function getDownloadDistribusiLevel()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/5-template_dislvl.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, '5-template_dislvl.xlsx', $headers);
    }
    
    public static function getDownloadPengkali()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/6-template_pengkali.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, '6-template_pengkali.xlsx', $headers);
    }

    public static function getDownloadKadep()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/7-template_bonus_kadep.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, '7-template_bonus_kadep.xlsx', $headers);
    }
    public static function getDownloadKadiv()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/master_data/template/8-template_jp_kadiv.xlsx";

        $headers = array(
            'Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, '8-template_jp_kadiv.xlsx', $headers);
    }
    
    
    // public function uploadPotongan(Request $request)
    // {
    //      // dd($request->hasFile('avatar'));
    //      if ($request->hasFile('potongan')) {
    //         $file = $request->file('potongan');
    //         $filename = $file->getClientOriginalName(); 
    //         $folder = uniqid() . '-' . now()->timestamp;
    //         $file->storeAs('potongan/tmp' . $folder, $filename); 
    //         return $folder;
    //     }

    //     return '';
    // }
    // public function uploadPegawai(Request $request)
    // {
    //      // dd($request->hasFile('avatar'));
    //      if ($request->hasFile('pegawai')) {
    //         $file = $request->file('pegawai');
    //         $filename = $file->getClientOriginalName(); 
    //         $folder = uniqid() . '-' . now()->timestamp;
    //         $file->storeAs('pegawai/tmp' . $folder, $filename); 
    //         return $folder;
    //     }

    //     return '';
    // }
}
