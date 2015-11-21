<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Items;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::get();
        return view('admin/items/index', ['items' => $items]);
    }

    public function getItemsObj()
    {
        $items = Items::get()->toArray();
        $arr = [];

        foreach($items as $value){
            if($value['obj']!=''){
                $obj = json_decode($value['obj'], true);
                unset($value['obj']);
            }
            else{$obj = [];}
            $obj['item'] = $value;
            $arr[] = $obj;
        }

     return $arr;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $item = '';
        return view('admin/items/item', ['item' => $item]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id != '') {
//            $item = Items::where('id', '=', $id)->get()->first();
            $item = Items::find($id);
        } else {
            $item = '';
        }
        $obj = json_decode($item['obj'], true);
        if (!isset($obj['images'])){
            $item->images = json_encode([]);
        } else {
            $item->images = json_encode($obj['images']);
        }

        return view('admin/items/item', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $input = \Request::all();
        if ($input['id']) {
            Items::find($input['id'])->update($input);
        }else{
            $input['id'] = Items::create($input);
        }

        return \Redirect::action('Admin\ItemsController@show', ['id' => $input['id'], $input['tab']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImages()
    {
        $input = \Request::all();
        if ($input['id'] and is_array($input['images']) and count($input['images'])) {
            $item = Items::find($input['id']);
            $arr = json_decode($item->obj, true);
            $arr['images'] = $input['images'];
            $item->obj = json_encode($arr);
            $item->save();

//            return $item['obj'];
        }else{
            $input['id'] = Items::create($input);
        }

//        return $input['images'];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $item = Items::find($id);
        $item->delete();

        return \Redirect::action('Admin\ItemsController@index');
    }
}
