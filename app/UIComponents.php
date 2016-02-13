<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UIComponents extends Model
{
    protected $table = 'uicomponents';
    protected $fillable = [
        'name',
        'obj'
    ];

    static function getLogo()
    {
        $logo = UIComponents::where('name','=','logo')->get()->first();
        $logo_img = '';
        if(isset($logo) && isset($logo->obj)){
            $obj = json_decode($logo->obj);
            if(isset($obj->images) && count($obj->images)){
                $logo_img = $obj->images[0];
            }
        }

        return $logo_img;
    }

    static function getFavicon()
    {
        $favicon = UIComponents::where('name','=','favicon')->get()->first();
        $favicon_img = '';
        if(isset($favicon) && isset($favicon->obj)){
            $obj = json_decode($favicon->obj);
            if(isset($obj->images) && count($obj->images)){
                $favicon_img = $obj->images[0];
            }
        }

        return $favicon_img;
    }
}
