<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name',
        'file',
        'content',
        'category_id'
    ];

}
