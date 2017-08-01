<?php
namespace App\Http\Controllers;

use App\Post;


class PostController extends Controller
{
    //show post list
    public function index()
    {
        $posts= Post::orderBy('created_at','desc')->paginate(6);
        return view('post/index',compact('posts'));
    }

    //show post detail
    public function show(Post $post)
    {
        return view('post/show',compact('post'));
    }

    //add new post
    public function create()
    {
        return view('post/create');
    }

    //save new post
    public function store()
    {
        //validate
        $this->validate(\request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        //logic
        $user_id=\Auth::id();
        $params=array_merge(\request(['title','content']),compact('user_id'));
        $post = Post::create($params);

        //show
        return \redirect('/posts');

        //dd($post);

    }

    //edit single post
    public function edit(Post $post)
    {
        return view('post/edit',compact('post'));
    }

    //update single post
    public function update(Post $post)
    {
        //validate
        $this->validate(\request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        $this->authorize('update',$post);

        //logic
        $post->title = \request('title');
        $post->content = \request('content');
        $post->save();

        //show
        return \redirect("/posts/{$post->id}");
    }

    //delete single post
    public function delete(Post $post)
    {
        $post->delete();

        return \redirect('/posts');
    }



}