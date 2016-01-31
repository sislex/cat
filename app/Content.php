<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $fillable = [
        'parent_id',
        'type',
        'menu',
        'name',
        'order',
        'pseudo_url',
        'title',
        'description',
        'keywords',
        'short_text',
        'text',
        'published'
    ];

    public function getMenuElements(){
        $menuElements = $this->orderBy('order', 'asc')->get()->toArray();
        $menu = [];
        if(isset($menuElements) && is_array($menuElements) && count($menuElements)){
            $menu = $this->buildMenuArr($menuElements, 0);
        }

        return $menu;
    }

    private function buildMenuArr($menu_arr, $parent_id){
        $menuArr = [];
        if(isset($menu_arr) && is_array($menu_arr) && count($menu_arr)) {
            foreach($menu_arr as $value){
                if($value['parent_id'] == $parent_id){
                    $value['children'] = $this->buildMenuArr($menu_arr, $value['id']);
                    if(!isset($value['children']) || !is_array($value['children']) || !count($value['children'])) {
                        unset($value['children']);
                    }
                    $menuArr[] = $value;
                }
            }
        }

        return $menuArr;
    }

    public static function getTopMenu(){
        $Menu = new Content();
        $menu = $Menu->getMenuElements();

        return $menu;
    }

    public function getContentElements($type,$parent_id){
        $content_pages = $this->where('type','=',$type)->where('parent_id','=',$parent_id)->orderBy('order','asc')->get();
        if(isset($content_pages)){
            if($content_pages->count()){
                $contentPagesArr = $content_pages->toArray();
                $contentArrWithImages = $this->addPreviewImages($contentPagesArr);
            } else {
                $contentArrWithImages = $content_pages->toArray();
            }
        }

        return $contentArrWithImages;
    }

    private function addPreviewImages($contentArr){
        foreach($contentArr as $key => $page){
            if(isset($contentArr[$key]['id'])){
                foreach(['.jpg','jpeg','.png'] as $file_ext){
                    if(file_exists(public_path().'/images/content/'.$contentArr[$key]['id'].'/'.'preview'.$file_ext)){
                        $contentArr[$key]['previewImageURL'] = '/images/content/'.$contentArr[$key]['id'].'/'.'preview'.$file_ext;
                    }
                    break;
                }
            }
        }
        return $contentArr;
    }

    public static function getContent($type,$parent_id){
        $contentPages = new Content();
        $content_pages = $contentPages->getContentElements($type,$parent_id);

        return $content_pages;
    }
}