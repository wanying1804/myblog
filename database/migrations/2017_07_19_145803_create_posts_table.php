<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{

    /**
     * The name of the database connection to use.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('posts', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->string('title',100)->default("");
            $collection->text('content');
            $collection->integer('user_id')->default(0);
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('mongodb')->drop(['posts']);
    }
}
