<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;

    protected $connection='mongodb';
    protected $collection='users';
    protected $primaryKey='_id';
    protected $fillable = [
       'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    //my posts
    public function posts(){
        return $this->hasMany(\App\Post::class,'user_id','id');
    }

}