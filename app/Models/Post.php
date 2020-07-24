<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'description'
    ];

    public function post_comments()
    {
        return $this->hasMany('App\Models\PostComment');
    }
}
