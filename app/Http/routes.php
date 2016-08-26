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

Route::get('/qqlogin', [
    "uses" => "UserController@redirectToProvider"
]);

Route::get('/qqlogincallback', [
    "uses" => "UserController@handleProviderCallback"
]);

Route::match(['POST', 'GET'], '/resetpasswd', [
    "uses" => "UserController@resetPassword"
]);

Route::match(['POST', 'GET'], '/reset', [
    "uses" => "UserController@resetPasswordAction"
]);

Route::get('/category', [
    "uses" => "CategoryController@showCategoryList"
]);

Route::get('/category/{cat_id}', [
    "uses" => "CategoryController@showCategoryByCatID"
]);

Route::match(['GET', 'POST'], '/run', [
    "uses" => "SubmissionController@runCode"
]);

Route::get('/ajax/submission', [
    "uses" => "SubmissionController@getSubmissionResult"
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard',[
        "uses" => "UserController@showUserDashboard"
    ]);

    Route::match(['GET', 'POST'], '/dashboard/profile', [
        "uses" => "UserController@setUserProfile"
    ]);

    Route::get('/dashboard/repository', [
        "uses" => "RepositoryController@showDashboardRepo"
    ]);

    Route::delete('/dashboard/repository/{repo_name}', [
        "uses" => "RepositoryController@deleteRepo"
    ]);

    Route::match(['GET', 'POST'], '/dashboard/repository/{repo_name}/edit', [
        "uses" => "RepositoryController@editRepo"
    ]);

    Route::get('/logout',[
        "uses" => "UserController@logoutAction"
    ]);

    Route::match(['GET', 'POST'], '/new', [
        "uses" => "RepositoryController@addRepository"
    ]);

    Route::match(['GET', 'POST'], '/{username}/repository/{repo_name}/add', [
        "uses" => "CodeController@addCode"
    ]);

    Route::match(['GET', 'POST'], '/{username}/repository/{repo_name}/edit/{file_name}', [
        "uses" => "CodeController@editCode"
    ]);

    Route::group(['middleware' => 'role:admin'],function(){
        /*Route::get('/dashboard-admin', [

        ]);

        Route::get('/dashboard-admin/users', [

        ]);

        Route::delete('/dashboard-admin/users/{uid}', [

        ]);

        Route::match(['GET', 'POST'], '/dashboard-admin/users/{uid}', [

        ]);*/

        Route::get('/dashboard-admin/category', [
            "uses" => "CategoryController@showAdminCategoryDashboard"
        ]);

        Route::match(['GET', 'POST'], '/dashboard-admin/category/add', [
            "uses" => "CategoryController@addCategory"
        ]);
        
        Route::match(['GET', 'POST'], '/dashboard-admin/category/{cat_id}/edit', [
            "uses" => "CategoryController@editCategory"
        ]);

        Route::delete('/dashboard-admin/category/{cat_id}/delete', [
            "uses" => "CategoryController@deleteCategory"
        ]);
    });

});

Route::get('/api/getcode', [
    "uses" => "ApiController@getCode"
]);

Route::post('/api/putresult', [
    "uses" => "ApiController@putResult"
]);

Route::get('/{username}', [
    "uses" => "UserController@showUserIndex"
]);

Route::get('/{username}/repository/', [
    "uses" => "RepositoryController@showUserRepos"
]);

Route::get('/{username}/repository/{repo_name}', [
    "uses" => "RepositoryController@showRepo"
]);

Route::get('/{username}/repository/{repo_name}/{file_name}', [
    "uses" => "CodeController@showCode"
]);

/*
Route::get('/{username}/category', [

]);

Route::get('/{username}/category/{cat_id}', [

]);*/

