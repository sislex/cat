<?php

namespace App\Http\Controllers\Catalog;

use App\Content;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Menu = new Content();
        $menu = $Menu->getMenuElements();

        return view('catalog/index/index', ['menu' => $menu]);
    }
}
