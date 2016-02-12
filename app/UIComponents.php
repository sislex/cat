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
}
