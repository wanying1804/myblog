<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if(\Auth::check()) {
            return redirect("/posts");
        }

        return view("login/index");
    }

    public function login(Request $request)
    {
        //validate
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6|max:30',
            'is_remember' => 'integer',
        ]);

        //logic
        $user = request(['email', 'password']);
        $remember = boolval(request('is_remember'));

        //view
        if (true == \Auth::attempt($user, $remember)) {
            return redirect('/posts');
        }

        return \Redirect::back()->withErrors("wrong email or password");
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}

