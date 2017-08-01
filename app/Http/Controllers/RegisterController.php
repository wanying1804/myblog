<?php

namespace App\Http\Controllers;


class RegisterController extends Controller
{
    //register page
    public function index()
    {
        return view('register.index');
    }

    //register action
    public function register()
    {
        //validate
        $this->validate(\request(),[
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5|max:10|confirmed',
        ]);

        //logic
        $password = bcrypt(request('password'));
        $name = request('name');
        $email = request('email');
        $user = \App\User::create(compact('name', 'email', 'password'));

        //view
        return redirect('/login');
    }
}
