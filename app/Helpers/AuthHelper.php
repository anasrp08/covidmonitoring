<?php
namespace App\Helpers;
use DateTime; 
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\File; 
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Crypt;
use Redirect;
use Validator;
use Response;
use DB;
use PDF;
class AuthHelper
{
     
    public static function getAuthUser(){
      
        $getUserid = auth()->user()->id;
       
        
        if (!Auth::check()) {
           
            return redirect()->route('login');
        }else{
            $getUserid = auth()->user()->id;
           
            return $getRoleUser=DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
       ->where('users.id', $getUserid)
      
       ->get();
        }

    }
    public static function getUserData(){

        $user = Auth::user();
 
        $roleuser=$user->roles->first()->name;
        $user->dir=$user->direktorat;
        $user->unit=Crypt::encrypt($user->unit);
        $user->direktorat=Crypt::encrypt($user->direktorat);  
        
        return $user;
        

    }
     
}