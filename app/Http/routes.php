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

//catalog module

Route::get('/', 'Catalog\IndexController@index');
Route::get('catalog/index', 'Catalog\CatalogController@index');
Route::get('catalog/item/{id?}', 'Catalog\CatalogController@item');


//admin module

Route::get('admin/index', 'Admin\IndexController@index');

// Filter routes
Route::post('filter/ajax', 'Admin\FiltersController@getJSONByName');
Route::get('admin/filters', 'Admin\FiltersController@index');
Route::get('admin/filter/{name}', 'Admin\FiltersController@filter');
Route::post('admin/filter/{name}', 'Admin\FiltersController@update');
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

// Settings routes..
//    counters
Route::get('admin/settings/counters', 'Admin\SettingsController@counters');
Route::get('admin/settings/counters/add', 'Admin\SettingsController@addCounter');
Route::post('admin/settings/counters/add', 'Admin\SettingsController@insertCounter');
Route::get('admin/settings/counters/delete/{id}', 'Admin\SettingsController@deleteCounter');
//    phones
Route::get('admin/settings/phones', 'Admin\SettingsController@phones');
Route::get('admin/settings/phones/add', 'Admin\SettingsController@addPhone');
Route::post('admin/settings/phones/add', 'Admin\SettingsController@insertPhone');
Route::get('admin/settings/phones/delete/{id}', 'Admin\SettingsController@deletePhone');
//    currencies
Route::get('admin/settings/currencies', 'Admin\SettingsController@currencies');
Route::get('admin/settings/currencies/add', 'Admin\SettingsController@addCurrency');
Route::get('admin/settings/currencies/show/{id?}', 'Admin\SettingsController@showCurrency');
Route::get('admin/settings/currencies/delete/{id}', 'Admin\SettingsController@deleteCurrency');
Route::post('admin/settings/currencies/update', 'Admin\SettingsController@updateCurrency');
Route::post('admin/settings/currencies/default/update', 'Admin\SettingsController@updateDefaultCurrency');

//email
Route::get('admin/settings/email', 'Admin\SettingsController@email');
Route::get('admin/settings/email/add', 'Admin\SettingsController@addEmail');
Route::get('admin/settings/currencies/show/{id?}', 'Admin\SettingsController@showEmail');
Route::get('admin/settings/currencies/delete/{id}', 'Admin\SettingsController@deleteEmail');
Route::post('admin/settings/currencies/update', 'Admin\SettingsController@updateEmail');
Route::post('admin/settings/currencies/default/update', 'Admin\SettingsController@updateDefaultEmail');