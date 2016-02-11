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
}
