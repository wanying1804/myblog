<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mongodb;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Mongodb::connectionMongodb('article');
        $postsData = $posts->orderBy('publish_at', 'desc')->get()->toArray();
        $authorIdArr = array_column($postsData, 'author_id');
        $authorNameMap = User::whereIn('id', $authorIdArr)->pluck('name', 'id')->toArray();
        $postsData = array_map(function($item) use($authorNameMap){
            $item['author_name'] = $authorNameMap[$item['author_id']];
            return $item;
        }, $postsData);
        return view('home', compact('postsData'));
    }
}
