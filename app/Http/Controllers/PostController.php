<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Mongodb;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    public function createSomePosts()
    {
         $posts = Mongodb::connectionMongodb('article');
         //$posts->delete();
         dd($posts->insert(['title' => 'every day is adfasgasfdadasf', 'content' => 'asdfasdf;jgweerwerdfad','publish_at' => date('Y-m-d H:i:s'), 'author_id' => 2]));


     
         $postsData = $posts->where('title', 'huangwei')->get()->toArray();
         dd($postsData);

 
    }

    public function getContent($id)
    {
        $postModel = Mongodb::connectionMongodb('article');
        $post = $postModel->where('_id', $id)->first();
        $post['author_name'] = User::where('id', $post['author_id'])->value('name');
        return view('content', compact('post'));
    }

    public function getPostsByAuthorId($authorId)
    {
        $authorId = intval($authorId);
        $postModel = Mongodb::connectionMongodb('article');
        $postsData = $postModel->where('author_id', $authorId)->orderBy('publish_at', 'desc')->get()->toArray();
        $authorIdArr = array_column($postsData, 'author_id');
        $authorNameMap = User::whereIn('id', $authorIdArr)->pluck('name', 'id')->toArray();
        $postsData = array_map(function($item) use($authorNameMap){
            $item['author_name'] = $authorNameMap[$item['author_id']];
            return $item;
        }, $postsData);
        $title = 'of ' . array_pop($authorNameMap);
        return view('home', compact('postsData', 'title'));
    }

    public function postDelete($id)
    {
        $postModel = Mongodb::connectionMongodb('article');
        $ret = $postModel->where('_id', $id)->delete();
        if($ret){
            return Redirect::route('home');
        }
    }

    public function postEdit(Request $request, $id = '')
    {
        $postModel = Mongodb::connectionMongodb('article');
        if($method = $request->isMethod('get')){
            $post = $postModel->where('_id', $id)->first();
            return view('create', compact('post'));
        }
        $data['title'] = $request['title'];
        $data['content'] = $request['content'];
        $postModel->where('_id', $request['_id'])->update($data);
        return Redirect::route('home');
    }

    public function postCreate(Request $request)
    {
        if($method = $request->isMethod('get')){
            return view('create');
        }
        $posts = Mongodb::connectionMongodb('article');
        $data['title'] = $request['title'];
        $data['content'] = $request['content'];
        $data['publish_at'] = date('Y-m-d H:i:s');
        $data['author_id'] = Auth::user()->id;
        $posts->insert($data);
        return Redirect::route('home');
    }
}