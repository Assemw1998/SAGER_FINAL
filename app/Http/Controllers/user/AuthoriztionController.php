<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthoriztionController extends Controller
{
    public function SignIn(Request $request){
        $request->validate([
            'user_email' => 'required',
            'user_password' => 'required',
        ]);
   
        $credentials = $request->only('user_email', 'user_password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }
  
        return redirect("/")->withError('Login details are not valid');
    }
    public function Register(){
        
    }

   

    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         return view('dashboard');
    //     }
  
    //     return redirect("login")->withSuccess('You are not allowed to access');
    // }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    
}
