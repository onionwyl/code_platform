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

Route::get('/{username}', [

]);

Route::get('/{username}/repository/', [

]);

Route::get('/{username}/repository/{repo_name}', [

]);

Route::get('/{username}/repository/{repo_name}/{file_name}', [

]);

Route::get('/category', [

]);

Route::get('/category/{cat_id}', [

]);

Route::get('/{username}/category', [

]);

Route::get('/{username}/category/{cat_id}', [

]);



Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard',[
        "uses" => "UserController@showUserDashboard"
    ]);

    Route::match(['GET', 'POST'], '/dashboard/profile', [
        "uses" => "UserController@setUserProfile"
    ]);

    Route::get('/dashboard/repository', [

    ]);

    Route::delete('/dashboard/repository/{repo_name}', [

    ]);

    Route::match(['GET', 'POST'], '/dashboard/repository/{repo_name}/edit', [

    ]);

    Route::get('/logout',[
        "uses" => "UserController@logoutAction"
    ]);

    Route::match(['GET', 'POST'], '/new', [

    ]);

    Route::match(['GET', 'POST'], '/{username}/repository/{repo_name}/add', [

    ]);

    Route::match(['GET', 'POST'], '/{username}/repository/{repo_name}/edit/{file_name}', [

    ]);

    Route::group(['middleware' => 'role:admin'],function(){
        Route::get('/dashboard-admin', [

        ]);

        Route::get('/dashboard-admin/users', [

        ]);

        Route::delete('/dashboard-admin/users/{uid}', [

        ]);

        Route::match(['GET', 'POST'], '/dashboard-admin/users/{uid}', [

        ]);

        Route::get('/dashboard-admin/category', [

        ]);

        Route::match(['GET', 'POST'], '/dashboard-admin/category/add', [

        ]);
    });

});
