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
    /*index*/
    Route::get('dashboard/index','user\DashboardController@Index'); 

    /*users*/
    Route::get('dashboard/users','user\DashboardController@Users'); 
    Route::post('dashboard/users/get','user\DashboardController@GetUsers'); 
    Route::post('dashboard/users/update','user\DashboardController@UpdateUser'); 
    Route::post('dashboard/users/add','user\DashboardController@AddUser'); 
    Route::post('dashboard/users/delete','user\DashboardController@DeleteUser'); 


    /*proudcts*/
    Route::get('dashboard/proudcts','user\DashboardController@Proudcts'); 
    Route::post('dashboard/product/get','user\DashboardController@GetProduct'); 
    Route::post('dashboard/product/update','user\DashboardController@UpdateProduct'); 
    Route::post('dashboard/product/add','user\DashboardController@AddProduct'); 
    Route::post('dashboard/product/delete','user\DashboardController@DeleteProduct'); 


    /*categories*/
    Route::get('dashboard/categories','user\DashboardController@Categories'); 
    Route::post('dashboard/category/get','user\DashboardController@GetCategory'); 
    Route::post('dashboard/category/update','user\DashboardController@UpdateCategory'); 
    Route::post('dashboard/category/add','user\DashboardController@AddCategory'); 
    Route::post('dashboard/category/delete','user\DashboardController@DeleteCategory'); 

    
    

    
    
});





    




