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
        $main_page_arr = [];
        if(isset($main_page) && $main_page->count())
        {
            $main_page_arr = $main_page->toArray();
        }
        if(is_array($main_page_arr) && isset($main_page_arr['text']) && trim($main_page_arr['text']) == '' ){
            $main_page_arr['text'] = '<h1>Приносим свои извинения, страница находится в разработке.</h1>';
        }

        if(is_array($main_page_arr) && isset($main_page_arr['title']) && trim($main_page_arr['title']) == '' ){
            $main_page_arr['title'] = 'Сайт компании Golden Motors';
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
            if(isset($obj->html)){
                $main_slider_arr['configuration'] = $obj->configuration;
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
            if(isset($obj->configuration)){
                $partners_slider_arr['configuration'] = $obj->configuration;
            }
        }

        $feedbacks_arr = Content::getContent('feedback',0);

        return view('catalog/index/index', ['mainpage' => $main_page_arr, 'main_slider' => $main_slider_arr,
                'partners_slider' => $partners_slider_arr, 'feedbacks' => $feedbacks_arr]);
    }
}
