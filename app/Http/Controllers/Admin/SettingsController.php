<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Counters;
use App\Phones;
use App\Currencies;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


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


    //    currencies settings
    public function currencies()
    {
        $currencies = Currencies::get();
        return view('admin/settings/currencies', ['currencies' => $currencies]);
    }

    public function addCurrency()
    {
        $currency = [];
        $currency['id'] = '';
        return view('admin/settings/showCurrency', ['currency' => $currency]);
    }

    public function showCurrency($id = '')
    {
        if ($id != '') {
            $currency = Currencies::find($id);
        } else {
            $currency = [];
            $currency['id'] = '';
        }
        return view('admin/settings/showCurrency', ['currency' => $currency]);
    }

    public function updateCurrency()
    {
        $input = \Request::all();

        if ($input['id']) {
            Currencies::find($input['id'])->update($input);
            $currency['id'] = $input['id'];
        } else {
            $currency['id'] = Currencies::create($input);
        }

//        return \Redirect::action('Admin\SettingsController@showCurrency', ['id' => $currency['id']]);
        return \Redirect::action('Admin\SettingsController@currencies');
    }

    public function deleteCurrency($id)
    {
        $currency = Currencies::find($id);
        if ($currency['default'] == true) {
            Currencies::where('id', '=', 1)->update(['default' => true]);
        }
        Currencies::destroy($id);

        return \Redirect::action('Admin\SettingsController@currencies');
    }

    public function updateDefaultCurrency()
    {
        $input = \Request::all();
        Currencies::where('name', '=', $input['default-currency'])->first()->update(['default' => true]);
        Currencies::where('name', '!=', $input['default-currency'])->update(['default' => false]);

        return \Redirect::action('Admin\SettingsController@currencies');
    }
}
