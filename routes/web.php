<?php


// BLOG Routes FRONTEND
Route::get('/', 'BlogController@index')->name('index');
Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');
Route::get('/categoria/{category}', 'BlogController@category')->name('blog.category');
Route::get('/autor/{author}', 'BlogController@author')->name('blog.author');


Route::get('/blog/show', function () {
    return view('blog.show');
});
