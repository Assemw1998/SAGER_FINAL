<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginRequest;

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

    
}
