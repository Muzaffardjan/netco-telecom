<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '{locale}'], function () {
    /** Home page route */
    Route::get('/', 'IndexController@index')->name('home');

    /** Login route */
    Route::match(['post', 'get'], 'login', 'Auth\LoginController@index')->name('login');

    /** Logout route */
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    /** Register route */
    Route::match(['post', 'get'], 'register', 'Auth\RegisterController@index')->name('register');
});

