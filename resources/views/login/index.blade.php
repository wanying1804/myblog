@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-signin" method="POST" action="/login">
                            {{csrf_field()}}
                            <div class="form-group">
                            <label for="inputEmail" class="sr-only">email</label>
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="sr-only">password</label>
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="is_remember"> remember me
                                </label>
                                </div>
                            </div>
                            @include('layouts.error')
                            <button class="btn btn-lg btn-primary btn-block" type="submit">login</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
