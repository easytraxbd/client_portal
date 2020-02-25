<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
    public function overview()
    {
        $data = [
            'title'=>"profile",
            'header'=>"profile",
            'subHeader'=>"overview",
        ];
        return view('profile.overview',$data);
    }
    public function personalInfo()
    {
        $data = [
            'title'=>"profile",
            'header'=>"profile",
            'subHeader'=>"Personal Information",
        ];
        return view('profile.personal_info',$data);
    }
    public function PasswordChangeForm()
    {
        $data = [
            'title'=>"profile",
            'header'=>"profile",
            'subHeader'=>"Change Password",
        ];
        return view('profile.change_password',$data);
    }
    public function changePassword(Request $request)
    {
        $errorArray=[];
        $request->validate([
            'new_password' => 'required|string|min:6',
            'confirm_new_password' => 'required|string|min:6',
            'password' => 'required|string|min:6',
        ]);
        $new_password = Hash::make($request->new_password);
//        return $new_password;
        $password = Auth::user()->password;
        //validation
        //check if the new password fields have equal value
        if ($request->new_password != $request->confirm_new_password){
            $errorArray["confirm_new_password"] = "Password didn't match";
        }

        //check if password is valid
        $new_password = Hash::make($request->new_password);
        if (Hash::check($request->password,$password)){
            DB::table('clients')->where('id',Auth::user()->id)->update(['password' => $new_password]);
            return back()->with('success','Password Changed Successfully!');
        }
        $errorArray["password"] = "Password didn't match";
        return back()->withErrors($errorArray);
    }
}
