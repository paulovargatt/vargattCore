<?php


Route::get('/', 'BlogController@index')->name('index');


Route::get('/blog/show', function () {
    return view('blog.show');
});
