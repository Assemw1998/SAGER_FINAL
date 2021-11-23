<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;


class DashboardController extends AuthoriztionController
{
    public function Index(){
        if(!Auth::check()){
            return redirect('/login');
        }
        return view('user\pages\dashboard\index');
    }


    
}
