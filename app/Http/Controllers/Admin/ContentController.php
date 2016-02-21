<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Content;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


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
            $page = Content::find($id);
        } else {
            $page = [];
            $page['id'] = '';
        }

        return view('admin/content/page', ['page' => $page, 'type' => $page['type']]);
    }

    public function showMainPage()
    {
        $page = Content::firstOrCreate(['type' => 'mainpage']);

        if(isset($page)){
            if($page->name == ''){
                $page->name = 'Mainpage';
            }
            $page->parent_id = 0;
            $page->pseudo_url = 'mainpage';
            $page->published = 1;
            $page->update();
        }

        return view('admin/content/page', ['page' => $page, 'type' => $page['type']]);
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
        require_once(app_path().'/includes/url-slug/url_slug.php');

        $input = \Request::all();

        if (isset($input['title']) && trim($input['title']) == '') {
            $input['title'] = trim($input['name']);
        }
        if (isset($input['keywords']) && trim($input['keywords']) == '') {
            $input['keywords'] = trim($input['name']);
        }
        if (isset($input['description']) && trim($input['description']) == '') {
            $input['description'] = trim($input['short_text']);
        }

        if ($input['id']) {
            if (isset($input['pseudo_url']) && trim($input['pseudo_url']) == '') {
                $input['pseudo_url'] = Content::checkURL(url_slug(trim($input['name']), array('transliterate' => true)),$input['id']);
            }elseif(isset($input['pseudo_url']) && trim($input['pseudo_url']) != '') {
                $input['pseudo_url'] = Content::checkURL(url_slug(trim($input['pseudo_url']), array('transliterate' => true)),$input['id']);
            }
            Content::find($input['id'])->update($input);
        }else{
            if (isset($input['pseudo_url']) && trim($input['pseudo_url']) == '') {
                $input['pseudo_url'] = Content::checkURL(url_slug(trim($input['name']), array('transliterate' => true)),null);
            }elseif(isset($input['pseudo_url']) && trim($input['pseudo_url']) != '') {
                $input['pseudo_url'] = Content::checkURL(url_slug(trim($input['pseudo_url']), array('transliterate' => true)),null);
            }
            $input = Content::create($input);
        }

        if (\Input::file() && isset($input['id'])) {
            if (\Input::file('image') && \Input::file('image')->isValid()) {
                if (in_array(\Input::file('image')->getClientOriginalExtension(),['jpg','jpeg','png'])) {
                    $destinationPath = 'images/content/'.$input['id'];
                    $extension = \Input::file('image')->getClientOriginalExtension();
                    $fileName = 'preview'.'.'.$extension;
                    \Input::file('image')->move($destinationPath, $fileName);
                }
            }
        }

        return \Redirect::action('Admin\ContentController@show', ['id' => $input['id'], $input['tab'], 'type' => $input['type']]);
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

        $content = new Content();
        $content->deleteContentAndAllAssosiatedFiles($id);

        return \Redirect::action('Admin\ContentController@index', ['type' => $type]);
    }
}
