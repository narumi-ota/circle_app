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
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::post('/home', 'HomeController@store');
  Route::post('/home/message', 'HomeController@messageStore');
  Route::get('/posts','PostsController@index');
  Route::get('/posts/{post}','PostsController@show')->where('post','[0-9]+');
  Route::get('/posts/create','PostsController@create');
  Route::post('/posts','PostsController@store');
  Route::get('/posts/{post}/edit','PostsController@edit');
  Route::patch('/posts/{post}','PostsController@update');
  Route::get('posts', 'PostsController@getSearch');
  Route::delete('/posts/{post}','PostsController@destroy')->name('post.destroy');
  Route::post('/posts/{post}/todos','TodosController@store')->name('todo.store');
  Route::post('/posts/{post}/comments','CommentsController@store')->name('comment.store');
  Route::get('todo/{todo}', 'TodosController@change')->name('todo.change');
  Route::delete('todos/{todo}','TodosController@destroy')->name('todo.destroy');
  Route::get('join/{join}', 'JoinsController@change')->name('join.change');
  Route::get('/users/{user}','UsersController@show');
  Route::get('/users','UsersController@index');  
});