<?php

namespace App\Http\Controllers\Catalog;

use App\Content;
use App\UIComponents;
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
        $catalog_banner = UIComponents::where('name','=','catalog-banner')->get()->first();
        $catalog_banner_arr = [];

        if(isset($catalog_banner) && isset($catalog_banner->obj)){
            $obj = json_decode($catalog_banner->obj);
            if(isset($obj->images)){
                $catalog_banner_arr['images'] = $obj->images;
            }
            if(isset($obj->html)){
                $catalog_banner_arr['html'] = $obj->html;
            }
        }

        return view('catalog/catalog/index', ['catalog_banner' => $catalog_banner_arr]);
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

        $catalog_banner = UIComponents::where('name','=','catalog-banner')->get()->first();
        $catalog_banner_arr = [];

        if(isset($catalog_banner) && isset($catalog_banner->obj)){
            $obj = json_decode($catalog_banner->obj);
            if(isset($obj->images)){
                $catalog_banner_arr['images'] = $obj->images;
            }
            if(isset($obj->html)){
                $catalog_banner_arr['html'] = $obj->html;
            }
        }
        $item['name'] = "{$item['obj']['type_auto'][0]['children'][0]['text']} {$item['obj']['type_auto'][0]['children'][0]['children'][0]['text']} {$item['obj']['God_vypuska'][0]['text']}";

        return view('catalog/catalog/item', ['item' => $item, 'catalog_banner' => $catalog_banner_arr]);
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

    public function news_index(){
        $content = Content::where('type','=','news')->where('parent_id','=',0)->get()->first();

        $news_pages = Content::getCategoriesContent('news',$content->id);
        $categories = Content::getCategories('news');

        return view('catalog/content/news/index', ['content' => $content, 'news_pages' => $news_pages, 'categories' => $categories]);
    }

    public function news_category($pseudo_url){
        $content = Content::where('pseudo_url','=',$pseudo_url)->get()->first();

        $news_pages = Content::getContent('news',$content->id);
        $categories = Content::getCategories('news');

        return view('catalog/content/news/index', ['content' => $content, 'news_pages' => $news_pages, 'categories' => $categories, 'active_category_id' => $content->id]);
    }

    public function blog($pseudo_url){
        $content = Content::where('pseudo_url','=',$pseudo_url)->get()->first();
        $categories = Content::getCategories('blog');

        return view('catalog/content/blog/blog', ['content' => $content, 'categories' => $categories]);
    }

    public function blog_index(){
        $content = Content::where('parent_id','=',0)->where('type','=','blog')->get()->first();

        $blog_pages = Content::getCategoriesContent('blog',$content->id);
        $categories = Content::getCategories('blog');

        return view('catalog/content/blog/index', ['content' => $content, 'blog_pages' => $blog_pages, 'categories' => $categories]);
    }

    public function blog_category($pseudo_url){
        $content = Content::where('pseudo_url','=',$pseudo_url)->get()->first();

        $blog_pages = Content::getContent('blog',$content->id);
        $categories = Content::getCategories('blog');

        return view('catalog/content/blog/index', ['content' => $content, 'blog_pages' => $blog_pages, 'categories' => $categories, 'active_category_id' => $content->id]);
    }

    public function getLastContent()
    {
        $input = \Request::all();

        $content_arr = [];
        if(isset($input['type']) && isset($input['limit']))
        {
            $type = $input['type'];
            $limit = $input['limit'];
            $content_arr = Content::getLastContent($type, $limit);
        }

        return $content_arr;
    }
}
