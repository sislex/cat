<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Counters;
use App\Phones;

class SettingsController extends Controller
{
//    counter settings
    public function counters()
    {
        $counters = Counters::get();
        return view('admin/settings/counters', ['counters' => $counters]);

    }
    public function addCounter()
    {
        return view('admin/settings/addCounter');
    }
    public function insertCounter()
    {
        $input = \Request::all();
        Counters::create($input);
        return \Redirect::action('Admin\SettingsController@counters');

    }
    public function deleteCounter($id)
    {
        Counters::destroy($id);
        return \Redirect::action('Admin\SettingsController@counters');

    }
//    counter settings

//    phones settings
    public function phones()
    {
        $phones = Phones::get();
        return view('admin/settings/phones', ['phones' => $phones]);
    }
    public function addPhone()
    {
        return view('admin/settings/addPhone');
    }
    public function insertPhone()
    {
        $input = \Request::all();
        Phones::create($input);
        return \Redirect::action('Admin\SettingsController@phones');
    }
    public function deletePhone($id)
    {
        Phones::destroy($id);
        return \Redirect::action('Admin\SettingsController@phones');

    }
}