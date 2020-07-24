<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showAllPosts()
    {
        $posts = Post::all();
        return view('pages/homePage/index', ['posts' => $posts]);
    }
}
