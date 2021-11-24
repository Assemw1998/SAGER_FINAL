<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//to clear cache//
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });


Route::group(['middleware' => ['web']], function() {
    Route::get('/', function () {return redirect('/login');});
    //Register Routes
    Route::get('/register', 'user\AuthoriztionController@showRegister');
    Route::post('RegisterAu', 'user\AuthoriztionController@Register'); 

    //Login Routes
    Route::get('/login', 'user\AuthoriztionController@showLogin');
    Route::post('LogInAu', 'user\AuthoriztionController@LogIn');
    
    //logout
    Route::get('/logout','user\AuthoriztionController@LogOut');
    
    //dashboard
    Route::get('dashboard/index','user\DashboardController@Index'); 
});


    




