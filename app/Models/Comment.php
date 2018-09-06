<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'author',
        'content',
        'modelable_id',
        'modelable_type'
    ];

}
