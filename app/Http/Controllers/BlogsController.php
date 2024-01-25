<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Corcel\Model\Post;

class BlogsController extends Controller
{
    public function index(){

        $posts = Post::status('publish')->latest()->take(10)->get();
        // dump($posts);

        return view('front.blogs.index', compact('posts'));
    }
}
