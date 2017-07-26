@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3>Posts List {{ $title or '' }}</h3></div>

                <div class="panel-body">
                    @foreach($postsData as $post)
                    <div class="list-group">
                        <div class="list-group-item">
                          <a href="{{ route('getContent', $post['_id']) }}" >
                            <h4>{{ $post['title'] }}</h4>
                          </a>
                            <p>
                                {{ $post['content'] }}
                            </p>
                            <p>
                                author: <a href="{{ route('getPostsByAuthorId', $post['author_id']) }}"> {{ $post['author_name'] }} </a> | publish at: {{ $post['publish_at'] }} @if(Auth::user()->id == $post['author_id']) | <a href="{{ route('postEdit', $post['_id']) }}"> edit </a> |<a href="{{ route('postDelete', $post['_id']) }}"> delete </a> @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
