<?php

namespace App\Http\Controllers\Catalog;

use App\Content;
use App\UIComponents;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_slider = UIComponents::where('name','=','main-slider')->get()->first();
        $main_slider_arr = [];

        if(isset($main_slider) && isset($main_slider->obj)){
            $obj = json_decode($main_slider->obj);
            if(isset($obj->images)){
                $main_slider_arr['images'] = $obj->images;
            }
            if(isset($obj->html)){
                $main_slider_arr['html'] = $obj->html;
            }
        }

//        dd($main_slider_arr);

        return view('catalog/index/index', ['main_slider' => $main_slider_arr]);
    }
}
