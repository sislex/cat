<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specifications extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'ord'
    ];
}