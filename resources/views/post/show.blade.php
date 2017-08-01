@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3>{{ $post->title }}</h3> <br > author: {{ $post->user->name}} | publish at: {{ $post->created_at}}</div>

                    <div class="panel-body">
                        <p>{{ $post->content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
