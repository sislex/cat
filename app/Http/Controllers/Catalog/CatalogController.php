<?php

namespace App\Http\Controllers\Catalog;

use App\Content;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Items;

class CatalogController extends Controller
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

        return view('catalog/catalog/index', ['menu' => $menu]);
    }

    public function item($id = 0)
    {
        $item = Items::find($id);
        if ($item['obj']){
            $obj = json_decode($item['obj'], true);
            $item['obj'] = $obj;

            if (!isset($obj['images'])){
                $item->images = [];
            } else {
                $item->images = $obj['images'];
            }
        }

        return view('catalog/catalog/item', ['item' => $item]);
    }

    public function content($pseudo_url){
        $content = Content::where('pseudo_url','=',$pseudo_url);

        $Menu = new Content();
        $menu = $Menu->getMenuElements();

        return view('catalog/content/content', ['content' => $content, 'menu' => $menu]);
    }
}
