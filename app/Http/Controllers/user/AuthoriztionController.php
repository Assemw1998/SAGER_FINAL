<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use DB;
use Illuminate\Support\Facades\Hash;


class AuthoriztionController extends Controller
{
    public function showRegister(){
        if(Auth::check()){
            return redirect('dashboard/index');
        }
        return view('user\pages\register');
    }

    public function showLogin(){
        if(Auth::check()){
            return redirect('dashboard/index');
        }
        return view('user\pages\login');
    }


    public function Register(RegisterRequest $request){
        $user = User::create($request->validated());

        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function authenticated(Request $request, $user) 
    {
        return redirect()->intended('dashboard/index');
    }


    public function LogOut(Request $request) 
    {
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }
    
    public function ShowForgetThePassword(){
        if(Auth::check()){
            return redirect('dashboard/index');
        }
        return view('user\pages\forget_the_password');
    }
    public function FogetThePassword(Request $request){
        if(Auth::check()){
            return redirect('dashboard/index');
        }
        $user = DB::table('users')->where('email',$request->email)->count();
        if($user==0){
            return "Email not Registered";
        }else{
            $password=$this->randomPassword();
            $details = [
                'title' => 'New Password',
                'body' => "your new password is $password"
            ];
            $password=Hash::make($password);
            DB::table('users')->where('email', $request->email)->update(['password'=>$password]);
            \Mail::to($request->email)->send(new \App\Mail\SendPassword($details));
            return true;
        }
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    
}
