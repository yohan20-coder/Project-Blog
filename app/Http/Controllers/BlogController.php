<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index(Post $post)
    {
    	$data = $post->orderBy('created_at','desc')->paginate(4);
    	return view('blog', compact('data'));
    }

    public function isi_blog($slug)
    {
    	$data = Post::where('slug', $slug)->get();
    	return view('blog.isi_post', compact('data'));
    }
}
