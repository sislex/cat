<?php

namespace App\Http\Controllers\Catalog;

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
        return view('catalog/catalog/index');
    }

    public function item($id = 0)
    {
        $item = Items::find($id);
        if ($item['obj']){
            $obj = json_decode($item['obj'], true);
            $item['obj'] = $obj;
            if (!isset($obj['images'])){
                $item->images = json_encode([]);
            } else {
                $item->images = json_encode($obj['images']);
            }
        }

        return view('catalog/catalog/item', ['item' => $item]);
    }
}
