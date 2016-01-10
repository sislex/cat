<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'name',
        'title',
        'description',
        'keywords',
        'short_text',
        'text',
        'published',
        'price',
        'obj',
        'specifications'
    ];
}