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
        $menuElements = $this->where('type','=','menu')->get()->toArray();
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
}