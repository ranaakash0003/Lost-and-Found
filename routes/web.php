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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trymap', function () {
    return view('trymap');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'] , function(){

Route::get('/post/create', [
    'uses'=>'PostsController@create',
    'as'=>'post.create'

]); 

Route::post('/post/store', [
    'uses'=>'PostsController@store',
    'as'=>'post.store'

]);




});

Route::get('/post', [
    'uses'=>'PostsController@index',
    'as'=>'post'

]);


Route::get('/test', function(){

    return App\User::find(1)->posts;

});