<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::group(['middleware' => 'guest'], function () {

    Route::get('/sign-in', 'Auth\LoginController@index')->name('sign-in');

    Route::get('/sign-in/github', 'Auth\LoginController@github')->name('sign-in-github');

    Route::get('/sign-in/github/redirect', 'Auth\LoginController@githubRedirect')->name('sign-in-github-redirect');

    Route::get('/sign-in/facebook', 'Auth\LoginController@facebook')->name('sign-in-facebook');

    Route::get('/sign-in/facebook/redirect', 'Auth\LoginController@facebookRedirect')->name('sign-in-facebook-redirect');

    Route::post('/sign-in', 'Auth\LoginController@post');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/chat', 'MessageController@getMessages')->name('chat');

    Route::post('/chat-redirect', 'MessageController@store')->name('message.store');

    Route::get('/sign-out', 'Auth\LoginController@logout')->name('logout');

});




