<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Secretary;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class SecretaryController extends Controller
{
    public function SecretaryIndex(){
        return view('secretary.secretary_login');
    }
    public function SecretaryDashboard(){
        return view('secretary.index');

    }
    public function SecretaryLogin(Request $reqest){
        // dd($reqest->all());
        $check =$reqest->all();
        if(Auth::guard('secretary')->attempt(['email'=> $check['email'],'password' =>$check['password']])){
            return redirect()->route('secretary.dashboard');
        }
        else{
            return back();
        }

    }
    public function SecretaryLogout(){
        Auth::guard('secretary')->logout();
        return redirect()->route('secretary_login_form');
    }
    public function SecretaryRegister(){
        return view('secretary.secretary_register');
        
    }
    public function SecretaryRegisterCreate(Request $reqest){
        //   dd($reqest->all());
        Secretary::insert([
            'name' =>$reqest->name,
            'email' => $reqest->email,
            'password' => Hash::make($reqest->password),
            'created_at' => Carbon::now(),
        ]);
        
        return redirect()->route('secretary_login_form');
        
    }
    
}
