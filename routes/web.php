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


Route::get('/', 'HomeController@index')->name('home');
Route::resource('/categories', 'CategoriesController');
Route::get('/posts_without_category', 'PostsController@postsWithoutCategory')->name('posts_without_category');
Route::resource('/posts', 'PostsController');
Route::post('/comment', 'CommentsController@store');