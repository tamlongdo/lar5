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

Route::get('admin/', ['as' => 'admin.home', 'uses' => 'Admin\HomeController@index']);
Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\AuthController@login']);
Route::post('admin/login', ['as' => 'admin.authenticate', 'uses' => 'Admin\AuthController@authenticate']);
Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout']);

// Registration routes...
Route::get('admin/register', 'Admin\AuthController@register');