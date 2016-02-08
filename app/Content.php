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

    private function deleteContentImagesFolder($id){
        $contentFolder = public_path().'/images/content/'.$id;
        $content_to_del_arr = [];
        if(isset($id) && file_exists($contentFolder)){
            if($handle = opendir($contentFolder)){
                while(($entry = readdir($handle)) !== false){
                    if($entry != '.' && $entry != '..'){
                        if(file_exists($contentFolder.'/'.$entry)){
                            unlink($contentFolder.'/'.$entry);
                        }
                    }
                }
                closedir($handle);
                if(file_exists($contentFolder) && is_dir($contentFolder)){
                    rmdir($contentFolder);
                }
            }
        }
        return $content_to_del_arr;
    }

    public function deleteContentAndAllAssosiatedFiles($id){
        $content_childs = $this->where('parent_id','=',$id)->get();
        foreach($content_childs as $child){
            $this->deleteContentAndAllAssosiatedFiles($child->id);
        }
        $this->deleteContentImagesFolder($id);
        $this->destroy($id);
    }

    private function buildCategories($type){
        $content_roots_arr = [];
        $content_roots = $this->where('type','=',$type)->where('parent_id','=',0)->orderBy('order','asc')->get();
        if(isset($content_roots)){
            if($content_roots->count()){
                $content_roots_arr = $content_roots->toArray();
            }
        }

        $content_except_roots_arr = [];
        $content_except_roots = $this->where('type','=',$type)->where('parent_id','!=',0)->orderBy('order','asc')->get();
        if(isset($content_except_roots)){
            if($content_except_roots->count()){
                $content_except_roots_arr = $content_except_roots->toArray();
            }
        }

        $categories_arr = [];
        if(is_array($content_roots_arr) && is_array($content_except_roots_arr)){
            if(count($content_roots_arr) && count($content_except_roots_arr)){
                foreach($content_except_roots_arr as $content){
                    foreach($content_roots_arr as $root){
                        if($content['parent_id'] == $root['id']){
                            $categories_arr[] = $content;
                        }
                    }
                }
            }
        }

        return $categories_arr;
    }

    public static function getCategories($type){
        $content = new Content();
        $categories = $content->buildCategories($type);

        return $categories;
    }

    private function buildCategoriesContent_bad($type){
        $categories_arr = $this->buildCategories($type);

        $content_all_roots_arr = [];
        $content_all_roots = $this->where('type','=',$type)->where('parent_id','=',0)->orderBy('order','asc')->get();
        if(isset($content_all_roots)){
            if($content_all_roots->count()){
                $content_all_roots_arr = $content_all_roots->toArray();
            }
        }

        $content_all = $this->where('type','=',$type)->orderBy('order','asc')->get();
        $content_all_arr = [];
        if(isset($content_all)){
            if($content_all->count()){
                $content_all_arr = $content_all->toArray();
            }
        }

        $content_arr = [];
        if(count($content_all_arr)){
            if(count($content_all_roots_arr) && count($categories_arr)){
                foreach($content_all_arr as $content){
                    $is_root = false;
                    foreach($content_all_roots_arr as $root){
                        if($content['id'] == $root['id']){
                            $is_root = true;
                            break;
                        }
                    }
                    if(!$is_root){
                        $is_category = false;
                        foreach($categories_arr as $category){
                            if($content['id'] == $category['id']){
                                $is_category = true;
                                break;
                            }
                        }
                        if(!$is_category){
                            $content_arr[] = $content;
                        }
                    }
                }
            }
        }

        return $content_arr;
    }

    private function buildCategoriesContent($type,$parent_id){
        $content_arr = [];
        $specific_root_categories_arr = $this->getContentElements($type,$parent_id);

        if(isset($specific_root_categories_arr)){
            if(is_array($specific_root_categories_arr)){
                if(count($specific_root_categories_arr)){
                    $that = $this;
                    foreach($specific_root_categories_arr as $specific_category){
                        if(count($that->getContentElements($type,$specific_category['id']))){
                            $content_arr[] = $that->getContentElements($type,$specific_category['id'])[0];
                        }
                    }
                }
            }
        }

        return $content_arr;
    }

    public static function getCategoriesContent($type,$parent_id){
        $content = new Content();
        $categories_content = $content->buildCategoriesContent($type,$parent_id);

        return $categories_content;
    }
}