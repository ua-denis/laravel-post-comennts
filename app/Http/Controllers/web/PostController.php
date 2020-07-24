<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost(Request $request, $post_slug)
    {
        $post = Post::where('slug', $post_slug)->get();

        return view('pages/postPage/index', ['post' => $post]);
    }
}
