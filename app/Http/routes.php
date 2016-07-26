<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    "uses" => "HomeController@showIndex"
]);

Route::match(["POST", "GET"], '/signup', [
    "uses" => "UserController@registerAction"
]);

Route::match(["POST", "GET"], '/signin', [
    "uses" => "UserController@loginAction"
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard',[
        "uses" => "UserController@showUserDashboard"
    ]);

    Route::match(['GET', 'POST'], '/dashboard/profile', [
        "uses" => "UserController@setUserProfile"
    ]);

    Route::get('/logout',[
        "uses" => "UserController@logoutAction"
    ]);
});
