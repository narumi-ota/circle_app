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

Route::get('/posts','PostsController@index');
Route::get('/posts/{post}','PostsController@show')->where('post','[0-9]+');
Route::get('/posts/create','PostsController@create');
Route::post('/posts','PostsController@store');
Route::get('/posts/{post}/edit','PostsController@edit');
Route::patch('/posts/{post}','PostsController@update');
Route::delete('/posts/{post}','PostsController@destroy');
Route::post('/posts/{post}/todos','TodosController@store');
Route::post('/posts/{post}/comments','CommentsController@store');
Route::get('todo/{todo}', 'TodosController@change')->name('todo.change');
Route::delete('todos/{todo}','TodosController@destroy')->name('todo.destroy');
Route::get('/users/{user}','UsersController@show');
Route::get('/users','UsersController@index');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();