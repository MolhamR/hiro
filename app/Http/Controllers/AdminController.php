<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function Index(){
        return view('admin.admin_login');
    }



    public function dashboard(){
        return view('admin.index');

    }


    public function Login(Request $reqest){
        // dd($reqest->all());
        $check =$reqest->all();
        if(Auth::guard('admin')->attempt(['email'=> $check['email'],'password' =>$check['password']])){
            return redirect()->route('admin.dashboard');
        }
        else{
            return back();
        }

    }
    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form');
    }
    
    
    public function AdminRegister(){
        return view('admin.admin_register');
        
    }
    
    public function AdminRegisterCreate(Request $reqest){
        //   dd($reqest->all());
        Admin::insert([
            'name' =>$reqest->name,
            'email' => $reqest->email,
            'password' => Hash::make($reqest->password),
            'created_at' => Carbon::now(),
        ]);
        
        return redirect()->route('login_form');
        
    }

    
}
