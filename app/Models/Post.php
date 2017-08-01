<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
{
    //
    protected $connection='mongodb';
    protected $collection='posts';
    protected $primaryKey='_id';
    protected $fillable=['title','content','user_id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
