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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [
        'as' => 'admin.home',
        'middleware' => 'admin.auth',
        'uses' => 'Admin\HomeController@index'
    ]);
    
    Route::get('logout', [
        'as' => 'admin.logout',
        'uses' => 'Admin\AuthController@logout'
    ]);
});

Route::match(['get', 'post'], 'admin/login', [
    'as'  => 'admin.login',
    'uses' => 'Admin\AuthController@login'
]);

// Registration routes...
Route::get('admin/register', 'Admin\AuthController@register');

//Facebook login Routes
Route::get('auth/facebook', [
    'as' => 'auth.facebook',
    'uses' => 'Auth\AuthController@redirectToProvider'
]);
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');
Route::auth();

//Homepage Routes
Route::get('/home', 'HomeController@index');

//Password reset Routes
Route::get('password/reset{token}','Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');
