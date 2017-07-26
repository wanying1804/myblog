<?php
namespace App;
use Mongo;
use DB;
class Mongodb extends Mongo
{
    public static function connectionMongodb($tables)
    {
        return $users = DB::connection('mongodb')->collection($tables);
    }
}
