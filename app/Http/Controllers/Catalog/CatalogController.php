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
        return view('catalog/catalog/index');
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

    public function menu($pseudo_url){
        $content = Content::where('pseudo_url','=',$pseudo_url)->get()->first();

        return view('catalog/content/menu', ['content' => $content]);
    }

    public function news($pseudo_url){
        $content = Content::where('pseudo_url','=',$pseudo_url)->get()->first();
        $categories = Content::getCategories('news');

        return view('catalog/content/news/news', ['content' => $content, 'categories' => $categories]);
    }

    public function news_index($id){
        $news_pages = Content::getCategoriesContent('news',$id);
        $categories = Content::getCategories('news');

        return view('catalog/content/news/index', ['news_pages' => $news_pages, 'categories' => $categories]);
    }

    public function news_category($id){
        $news_pages = Content::getContent('news',$id);
        $categories = Content::getCategories('news');

        return view('catalog/content/news/index', ['news_pages' => $news_pages, 'categories' => $categories, 'active_category_id' => $id]);
    }

    public function blog($pseudo_url){
        $content = Content::where('pseudo_url','=',$pseudo_url)->get()->first();

        return view('catalog/content/blog/blog', ['content' => $content]);
    }

    public function blog_index($id){
        $blog_pages = Content::getContent('blog',$id);

        return view('catalog/content/blog/index', ['blog_pages' => $blog_pages]);
    }

    public function blog_category($id){

    }
}
