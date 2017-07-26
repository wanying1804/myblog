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


         #添加一条数据 ture 添加成功
         //dd($users->insert(['title' => 'email', 'article' => 'john@example.com','time' => time()]));
         //dd($users->insert(['title' => 'huangwei', 'article' => 'huangwei@example.com','time' => time()]));

         #添加多条数据 ture 添加成功
         //dd($users->insert([['title' => 'email', 'article' => 'john@example.com','time' => time()],['title' => 'title1', 'article' => 'lichuang@example.com','time' => time()],['title' => 'title2', 'article' => 'lili@example.com','time' => time()]]));

         #修改一条数据 0 修改成功
         //dd($users->where('title', 'new2')->update(['article' => 'lichuang']));

         #删除一条数据 1 为删除成功
         //dd($users->where('title', 'new1')->delete());

         #删除集合所有数据 返回几删除几条
         //dd($users->delete());

         #查询集合所有数据
         //dd($users->get());

         #按条件查询
         //dd($users->where('title', 'title1')->get());
         $postsData = $posts->where('title', 'huangwei')->get()->toArray();
         dd($postsData);

         #模糊查询
         //dd($users->where('title', 'like', 'ti%')->get());
         //dd($users->where('title', 'like', 'ti%')->get());

         #按条件排序
         //dd($users->orderBy('time', 'desc')->get());
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