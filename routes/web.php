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

//register page
Route::get('/register','RegisterController@index');
//register
Route::post('/register','RegisterController@register');
//login page
Route::get('/login','LoginController@index');
//login
Route::post('/login','LoginController@login');
//logout
Route::post('/logout','LoginController@logout');


Route::group(['prefix' => 'posts'], function () {

    Route::get('createSomePosts','PostController@createSomePosts');
    //Post list page
    Route::get('/','PostController@index');

    //create post
    Route::get('/create','PostController@create');
    Route::post('/','PostController@store');

    //post detail page
    Route::get('/{post}','PostController@show');

    //edit post
    Route::get('/{post}/edit','PostController@edit');
    Route::put('/{post}','PostController@update');

    //delete post
    Route::get('/{post}/delete','PostController@delete');


});
