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
Route::group(['middleware' => ['web']], function () {

	Route::get('blog/{slug}', array('as'=> 'blog.single','uses'=>'blogController@getSingle'));
	Route::get('blog', ['uses'=>'blogController@getArchive', 'as'=>'blog.index']);
	Route::get('/','pagesController@getIndex');

    Route::get('about','pagesController@getAbout');

    Route::get('contact','pagesController@getContact');
    Route::post('contact','pagesController@postContact');

    Route::resource('posts','postController');

    Route::resource('categories', 'categoryController',['except'=> ['create']]);
    Route::resource('tags', 'tagController',['except'=> ['create']]);
    //comments
    Route::post('comments/{post_id}',['uses'=>'commentController@store','as' => 'comments.store']);
    Route::get('comments/{id}/edit',['uses'=>'commentController@edit', 'as'=> 'comments.edit']);
    Route::put('comments/{id}',['uses'=>'commentController@update', 'as' => 'comments.update']);
    Route::delete('comments/{id}',['uses'=>'commentController@destroy', 'as' => 'comments.destroy']);

    
});


