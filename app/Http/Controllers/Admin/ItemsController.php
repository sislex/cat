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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = '')
    {
        if ($id != '') {
//            $item = Items::where('id', '=', $id)->get()->first();
            $item = Items::find($id);
        } else {
            $item = '';
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
