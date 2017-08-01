@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3>Create Post</h3></div>

                    <div class="panel-body">
                        <form role="form" method="POST" action="/posts/{{$post->id}}">
                            {{method_field("PUT")}}
                            {{ csrf_field() }}

                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $post->title}}">
                            <div class="form-group">
                                <label for="content">content</label>
                                <textarea name="content" class="form-control" rows="5">{{ $post->content}}
                            </textarea>
                            </div>
                            @include('layouts.error')
                            <button type="submit" class="btn btn-default btn-sm">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
