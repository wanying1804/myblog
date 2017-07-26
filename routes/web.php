<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/list','PostController@index');

Route::group(['prefix' => 'post'], function () {
	Route::get('createSomePosts','PostController@createSomePosts');
	Route::get('getContent/{id}','PostController@getContent')->name('getContent');
	Route::get('getPostsByAuthorId/{id}','PostController@getPostsByAuthorId')->name('getPostsByAuthorId');
	Route::get('postDelete/{id}','PostController@postDelete')->name('postDelete');
	Route::any('postEdit/{id?}','PostController@postEdit')->name('postEdit');
	Route::any('postCreate','PostController@postCreate')->name('postCreate');
});
