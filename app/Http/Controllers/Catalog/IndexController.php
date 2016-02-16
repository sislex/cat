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
        $main_page = Content::where('type','=','mainpage')->get()->first();
        if(isset($main_page) && isset($main_page->text)){
            $main_page_text = $main_page->text;
        }else{
            $main_page_text = '<h1>Приносим свои извинения, страница находится в разработке.</h1>';
        }

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

        $partners_slider = UIComponents::where('name','=','partners-slider')->get()->first();
        $partners_slider_arr = [];

        if(isset($partners_slider) && isset($partners_slider->obj)){
            $obj = json_decode($partners_slider->obj);
            if(isset($obj->images)){
                $partners_slider_arr['images'] = $obj->images;
            }
            if(isset($obj->html)){
                $partners_slider_arr['html'] = $obj->html;
            }
        }

        return view('catalog/index/index', ['main_page_text' => $main_page_text, 'main_slider' => $main_slider_arr, 'partners_slider' => $partners_slider_arr]);
    }
}
