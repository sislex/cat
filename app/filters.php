<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filters extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];
}
