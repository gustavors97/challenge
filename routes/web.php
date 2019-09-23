<?php
Auth::routes();

Route::get('/posts/novo', 'PostsController@novo');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/postagem/post_{id}', 'PublicController@postagem');
Route::get('/', 'PublicController@index');

Route::post('/createPostagem', 'PostsController@create');

Route::post('/publishPostagem', 'HomeController@publish');
Route::post('/removePostagem', 'HomeController@remove');