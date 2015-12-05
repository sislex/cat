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

// Filter routes
Route::post('filter/ajax', 'Admin\FiltersController@getJSONByName');
Route::get('admin/filters', 'Admin\FiltersController@index');
Route::get('admin/filter/{name}', 'Admin\FiltersController@filter');
Route::post('admin/filter/{name?}', 'Admin\FiltersController@update');
Route::get('admin/filters/add', 'Admin\FiltersController@add');
Route::get('admin/filters/delete/{id}', 'Admin\FiltersController@delete');


// Items routes
Route::get('admin/items', 'Admin\ItemsController@index');
Route::get('admin/items/add/{type}', 'Admin\ItemsController@add');
Route::get('admin/items/show/{id?}', 'Admin\ItemsController@show');
Route::get('admin/items/delete/{id?}', 'Admin\ItemsController@delete');
Route::post('admin/items/update', 'Admin\ItemsController@update');
Route::post('admin/get/items', 'Admin\ItemsController@getItemsObj');
Route::post('admin/items/update/images', 'Admin\ItemsController@updateImages');

// Content routes
Route::get('admin/content/{type}', 'Admin\ContentController@index');
Route::get('admin/content/add/{type}', 'Admin\ContentController@add');
Route::get('admin/content/show/{id?}', 'Admin\ContentController@show');
Route::get('admin/content/delete/{id}', 'Admin\ContentController@delete');
Route::post('admin/content/update', 'Admin\ContentController@update');


// Authentication routes...
Route::get('admin/login', 'Auth\AuthController@getLogin');
Route::post('admin/login', 'Auth\AuthController@postLogin');
Route::get('admin/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');