<?php


// BLOG Routes FRONTEND
Route::get('/', 'BlogController@index')->name('index');
Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');


Route::get('/blog/show', function () {
    return view('blog.show');
});
