<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
        'id',
        'name',
        'comment',
        'post_id',
        'parent_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\PostComment', 'parent_id', 'id');
    }
}
