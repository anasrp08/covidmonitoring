<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\JseaEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Helpers\AppHelper;
use App\Helpers\QueryHelper;
use App\Helpers\UpdtSaldoHelper;
use App\Helpers\AuthHelper;
use App\Mail\JseaMail;
use Redirect;
use Validator;
use Response;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\TemporaryFile;
use App\User;
// use File;
use PDF;


class SettingsController extends Controller
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
    public function editPassword()
    {
        return view('settings.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'new_password' => 'required|confirmed|min:6|different:password',
            'new_confirm_password' => ['same:new_password']
        ], ['password.old_password' => 'Password lama tidak sesuai']);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Password berhasil dirubah"
        ]);
        return redirect('settings/password');
    }
    public function firstChangePasswd(Request $request)
    {
        $request->validate([
            'new_password' => 'required|confirmed',
            'new_confirm_password' => ['same:new_password']
        ], ['password.old_password' => 'Password lama tidak sesuai']);

        $dataUpdate = array(
            'password' => Hash::make($request->new_password),
            'password_change_at' => Carbon::now()->setTimezone('Asia/jakarta')->toDateTimeString()
        );
        try {
            User::find(auth()->user()->id)->update($dataUpdate);
            return response()->json(['success' => 'Password Berhasil Diupdate']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Gagal Menyimpan Password']);
        }
    }

    public function upload(Request $request)
    {
        // dd($request->hasFile('avatar'));
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
          
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('avatars/tmp' . $folder, $filename);

            // $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
            
            TemporaryFile::create([
                'folder'=>$folder,
                'filename'=>$filename
            ]);
            return $folder;
        }

        return '';
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
