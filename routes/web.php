<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//helper that generates all routes for authentication
Auth::routes();

Route::get('/','PostController@index');
Route::get('/home','PostController@index');

Route::group(['middleware'=>['auth']],function(){
	Route::get('new-post','PostController@create');
	Route::post('new-post','PostController@store');
	Route::get('edit/{slug}','PostController@edit');
	Route::post('update','PostController@update');
	Route::get('delete/{id}','Postcontroller@destroy');
});
Route::get('user/{id}','UserController@profile')->where('id','[0-9]+');
Route::get('/{slug}','PostController@show')->where('slug','[A-Za-z0-9-_]+');




