@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-signin" method="POST" action="/register">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name" class="sr-only">name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="sr-only">email</label>
                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="email" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="sr-only">password</label>
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="password" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">confirm password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="confirm password" required>
                            </div>

                            @include('layouts.error')
                            <button class="btn btn-lg btn-primary btn-block" type="submit">register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
