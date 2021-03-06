<?php

// BLOG Routes FRONTEND
Route::get('/', 'BlogController@index')->name('index');
Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');
Route::get('/categoria/{category}', 'BlogController@category')->name('blog.category');
Route::get('/autor/{author}', 'BlogController@author')->name('blog.author');

Route::get('/tag/{tag}', 'BlogController@tag')->name('blog.tag');

Route::post('/blog/{post}/comments', 'CommentsController@store')->name('blog.comments');


/*Painel*/
Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('/edit-account', 'Backend\HomeController@edit')->name('editAccount');
Route::put('/edit-account', 'Backend\HomeController@update')->name('editAccountUpdate');

Route::resource('/backend/blog','Backend\BlogController');
Route::put('backend/blog/restore/{id}','Backend\BlogController@restore')->name('blog.restore');
Route::delete('backend/blog/force-destroy/{id}','Backend\BlogController@forceDestroy')->name('blog.forceDestroy');
/*CATS*/
Route::resource('/backend/categories','Backend\CategoriesController');

Route::resource('/backend/users','Backend\UsersController');
Route::get('/backend/users/confirm/{user}','Backend\UsersController@confirm')->name('backend.users.confirm');





/* AUTH ROUTES */
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');