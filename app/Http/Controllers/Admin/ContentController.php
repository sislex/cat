<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        if ($type) {
            $content = Content::where('type', '=', $type)->orderBy('id','desc')->get();
        }
        return view('admin/content/index', ['content' => $content, 'type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($type)
    {
        $page = [];
        $page['id']  = '';
        $page['type']  = $type;
//        $page['published']  = '';
        return view('admin/content/page', ['page' => $page]);
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
//            $page = Content::where('id', '=', $id)->get()->first();
            $page = Content::find($id);
        } else {
            $page = [];
            $page['id'] = '';
        }

        return view('admin/content/page', ['page' => $page]);
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

        if (isset($input['pseudo_url'])) {
            $input['pseudo_url'] = $input['name'];
        }
        if (isset($input['title'])) {
            $input['title'] = $input['name'];
        }
        if (isset($input['keywords'])) {
            $input['keywords'] = $input['name'];
        }
        if (isset($input['description'])) {
            $input['description'] = $input['short_text'];
        }

        if ($input['id']) {
            Content::find($input['id'])->update($input);
        }else{
            $input['id'] = Content::create($input);
        }

        return \Redirect::action('Admin\ContentController@show', ['id' => $input['id'], $input['tab']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $page = Content::find($id);
        $type = $page['type'];
        $page->delete();

        return \Redirect::action('Admin\ContentController@index', ['type' => $type]);
    }
}
