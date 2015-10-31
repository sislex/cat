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

Route::get('admin/index', 'Admin\IndexController@index');
Route::get('admin/filters', 'Admin\FiltersController@index');
Route::get('admin/filter/{name}', 'Admin\FiltersController@filter');

Route::get('admin/items', 'Admin\ItemsController@index');
Route::get('admin/item/{id?}', 'Admin\ItemsController@show');
Route::post('admin/item/', 'Admin\ItemsController@update');

// Authentication routes...
Route::get('admin/login', 'Auth\AuthController@getLogin');
Route::post('admin/login', 'Auth\AuthController@postLogin');
Route::get('admin/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');