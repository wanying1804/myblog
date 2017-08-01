<?php

namespace App\Http\Controllers;

use App\Post;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::orderBy('created_at','desc')->paginate(6);
        return view('post/index',compact('posts'));
    }
}
