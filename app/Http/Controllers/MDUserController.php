<?php

namespace App\Http\Controllers;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 
use App\Helpers\AppHelper; 
 
use Redirect;
use Validator;
use Response;
use DB;
use PDF;
 

class MDUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *php
     * @return \Illuminate\Http\Response
     */
    public function viewEntri()
    {
        //
         
        return view('manageuser.list',[
             

        ]);
    } 
    public function index(Request $request)
    {
        //
      
        // $status= DB::table('tr_mutasilimbah')->get();
        if (request()->ajax()) { 
            $queryData=DB::table('md_email') ;
 
            if(!empty($request->tglinput)){

                $splitDate2=explode(" - ",$request->tglinput);
                $queryData->whereBetween('tr_mutasilimbah.tgl',array(  AppHelper::convertDateYmd($splitDate2[0]),  AppHelper::convertDateYmd($splitDate2[1])));

            }  
            $queryData=$queryData->get();  
            return datatables()->of($queryData) 
                     
                    ->addIndexColumn()
                    ->addColumn('action', 'action_daftar_tender')
                    ->rawColumns(['action'])
                    
                    ->make(true);
 
        } 
        return view('manageuser.list', [
           
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
    public function store(Request $request)
    {
  
        $error=null;
        $rules=array(
            'nama_pegawai' => 'required',
            'np_pegawai' => 'required',
            'email' => 'required',
            'unit_kerja' => 'required',
             
        );
        $messages = array(
            'nama_pegawai.required'			=>  'Nama Harus Diisi'	,
            'np_pegawai.required'			=>  'Nomor Pegawai Harus Diisi'	,
            'email.required'			        =>  'Email Harus Diisi'	, 
            'unit_kerja.required'	        =>  'Unit Kerja Harus Diisi'	, 
        );

        $error = Validator::make($request->all(), $rules, $messages); 
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nama'		        =>  $request->nama_pegawai	,
            'np'			    =>  $request->np_pegawai,
            'email'	            =>  $request->email	,
            'keterangan'	            =>  $request->unit_kerja	,
            'created_at'		=>  date('Y-m-d')	, 
        );
         
        try {
            $queryInsert=DB::table('md_email')->insert($form_data);
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
    public function update(Request $request)
    {
        $error=null;
        $rules=array(
            'nama_edit' => 'required',
            'np_edit' => 'required',
            'email_edit' => 'required',
            'unit_edit' => 'required',
             
        );
        $messages = array(
            'nama_edit.required'			=>  'Nama Harus Diisi'	,
            'np_edit.required'              =>  'Nomor Pegawai Harus Diisi'	,
            'email_edit.required'			=>  'Email Harus Diisi'	,
            'unit_edit.required'			=>  'Unit Kerja Harus Diisi'	,  
        );

        $error = Validator::make($request->all(), $rules, $messages); 
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nama'		        =>  $request->nama_edit	,
            'np'			    =>  $request->np_edit,
            'email'	            =>  $request->email_edit	,
            'keterangan'	            =>  $request->unit_edit	,
            'updated_at'		=>  date('Y-m-d')	, 
        );
       
        try {
            $queryInsert=DB::table('md_email')->where('id',$request->id_user)->update($form_data); 
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
        $getData=DB::table('md_email')->where('id',$id);  
        $getData->delete(); 
        return response()->json(['success' => 'Data Berhasil Di Hapus']);
    }
 

}
