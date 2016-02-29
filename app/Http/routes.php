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

// Catalog module //

// Index routes...
Route::get('/', 'Catalog\IndexController@index');


// UI routes (Sliders, Banners, Widgets, etc.)


// Catalog routes...
Route::get('catalog/index', 'Catalog\CatalogController@index');
Route::get('catalog/auto/{id?}', 'Catalog\CatalogController@item');

Route::get('menu/{pseudo_url}','Catalog\CatalogController@menu');
Route::get('news/post/{pseudo_url?}','Catalog\CatalogController@news');
Route::get('blog/post/{pseudo_url?}','Catalog\CatalogController@blog');
Route::get('catalog/top-menu','Catalog\CatalogController@getTopMenu');

Route::get('news/','Catalog\CatalogController@news_index');
Route::get('news/{pseudo_url}','Catalog\CatalogController@news_category');
Route::get('blog/','Catalog\CatalogController@blog_index');
Route::get('blog/{id}','Catalog\CatalogController@blog_category');

Route::post('news/last','Catalog\CatalogController@getLastContent');
Route::post('blog/last','Catalog\CatalogController@getLastContent');

// Admin module //

// Index route...
Route::get('admin/index', 'Admin\IndexController@index');

// Filters routes...
Route::post('filter/ajax', 'Admin\FiltersController@getJSONByName');
Route::get('admin/filters', 'Admin\FiltersController@index');
Route::get('admin/filter/{id}', 'Admin\FiltersController@filter');
//Route::post('admin/filter/{name}', 'Admin\FiltersController@update');
Route::post('admin/filter/{id?}', 'Admin\FiltersController@update');
Route::get('admin/filters/add', 'Admin\FiltersController@add');
Route::get('admin/filters/delete/{id}', 'Admin\FiltersController@delete');

Route::get('admin/filters/names', 'Admin\FiltersController@getJSONNames');

// Items routes...
Route::get('admin/items', 'Admin\ItemsController@index');
Route::get('admin/items/add/{type}', 'Admin\ItemsController@add');
Route::get('admin/items/show/{id?}', 'Admin\ItemsController@show');
Route::get('admin/items/delete/{id?}', 'Admin\ItemsController@delete');
Route::post('admin/items/update', 'Admin\ItemsController@update');
Route::post('admin/get/items/{limit?}', 'Admin\ItemsController@getItemsObj');
Route::post('admin/items/update/images', 'Admin\ItemsController@updateImages');

// Specifications routes...
Route::post('specifications/ajax', 'Admin\SpecificationsController@getJSONByName');
Route::get('admin/specifications', 'Admin\SpecificationsController@index');
Route::get('admin/specification/{id}', 'Admin\SpecificationsController@specification');
Route::get('admin/specifications/add/{id}', 'Admin\SpecificationsController@add');
Route::get('admin/specifications/json', 'Admin\SpecificationsController@getJSONspecifications');
Route::post('admin/specifications/update', 'Admin\SpecificationsController@update');
Route::get('admin/specifications/delete/{id}', 'Admin\SpecificationsController@delete');

// Content routes...
Route::get('admin/content/{type}', 'Admin\ContentController@index');
Route::get('admin/content/add/{type}', 'Admin\ContentController@add');
Route::get('admin/content/show/main', 'Admin\ContentController@showMainPage');
Route::get('admin/content/show/{id?}', 'Admin\ContentController@show');
Route::get('admin/content/delete/{id}', 'Admin\ContentController@delete');
Route::post('admin/content/update', 'Admin\ContentController@update');

//Mail rotes
Route::post('mail/index', 'Catalog\MailController@index');

// Banners and Sliders routes...
Route::get('admin/ui-components/show/{name}', 'Admin\UIComponentsController@show');
Route::post('admin/ui-components/update', 'Admin\UIComponentsController@update');


// Authentication routes...
Route::get('admin/login', 'Auth\AuthController@getLogin');
Route::post('admin/login', 'Auth\AuthController@postLogin');
Route::get('admin/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/login', function(){return \Redirect::action('Auth\AuthController@getLogin');});
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Settings routes..
//    _counters
Route::get('admin/settings/counters', 'Admin\SettingsController@counters');
Route::get('admin/settings/counters/add', 'Admin\SettingsController@addCounter');
Route::post('admin/settings/counters/add', 'Admin\SettingsController@insertCounter');
Route::get('admin/settings/counters/delete/{id}', 'Admin\SettingsController@deleteCounter');
//    _phones
Route::get('admin/settings/phones', 'Admin\SettingsController@phones');
Route::get('admin/settings/phones/add', 'Admin\SettingsController@addPhone');
Route::post('admin/settings/phones/add', 'Admin\SettingsController@insertPhone');
Route::get('admin/settings/phones/delete/{id}', 'Admin\SettingsController@deletePhone');
//    _currencies
Route::get('admin/settings/currencies', 'Admin\SettingsController@currencies');
Route::get('admin/settings/currencies/add', 'Admin\SettingsController@addCurrency');
Route::get('admin/settings/currencies/show/{id?}', 'Admin\SettingsController@showCurrency');
Route::get('admin/settings/currencies/delete/{id}', 'Admin\SettingsController@deleteCurrency');
Route::post('admin/settings/currencies/update', 'Admin\SettingsController@updateCurrency');
Route::post('admin/settings/currencies/default/update', 'Admin\SettingsController@updateDefaultCurrency');
Route::post('admin/settings/currencies/getCurrencies', 'Admin\SettingsController@getCurrencies');
//    _email
Route::get('admin/settings/email', 'Admin\SettingsController@email');
Route::get('admin/settings/email/add', 'Admin\SettingsController@addEmail');
Route::get('admin/settings/email/show/{id?}', 'Admin\SettingsController@showEmail');
Route::get('admin/settings/email/delete/{id}', 'Admin\SettingsController@deleteEmail');
Route::post('admin/settings/email/update', 'Admin\SettingsController@updateEmail');
