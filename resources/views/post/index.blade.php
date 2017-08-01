@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3>Posts List {{ $title or '' }}</h3></div>

                    <div class="panel-body">
                        @foreach($posts as $post)
                            <div class="list-group">
                                <div class="list-group-item">
                                    <a href="/posts/{{$post->id}}" >
                                        <h4>{{ $post->title}}</h4>
                                    </a>
                                    <p>
                                        {{str_limit( $post->content, 100,'...') }}
                                    </p>
                                    <p>
                                        author: <a href="#">{{$post->user->name}}</a>  | published at: {{ $post->created_at }} @can('update',$post)| <a href="/posts/{{$post->id}}/edit">edit</a>@endcan @can('delete',$post) | <a href="/posts/{{$post->id}}/delete">delete</a> @endcan
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection
