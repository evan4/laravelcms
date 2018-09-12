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

Route::get('/', 'PostController@index')->name('blog.index');

Route::get('/blog/{post}', 'PostController@show')->name('blog.show');

Route::get('/category/{category}', 'PostController@category')->name('category');

Route::get('/author/{author}', 'PostController@author')->name('author');

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('/edit-account', 'Backend\HomeController@edit')->name('edit-account');
Route::put('/update-account', 'Backend\HomeController@update')->name('update-account');


Route::resource('/backend/blog', 'Backend\BlogController', ['as' => 'backend']);

Route::put('/backend/blog/restore/{blog}', 'Backend\BlogController@restore')->name('backend.blog.restore');
Route::delete('/backend/blog/force-destroy/{blog}', 'Backend\BlogController@forceDestroy')->name('backend.blog.force-destroy');

Route::resource('/backend/categories', 'Backend\CategoriesController', ['as' => 'backend']);

Route::resource('/backend/users', 'Backend\UsersController', ['as' => 'backend']);
Route::get('/backend/users/confirm/{user}', 'Backend\UsersController@confirm')->name('backend.users.confirm');