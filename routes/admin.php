<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 13:46
 */

use Illuminate\Support\Facades\Route;

Route::middleware('admin:admin')->group(function () {
    /** Index route */
    Route::get('/', 'DashboardController@index')->name('admin');

    /** Logout route */
    Route::get('logout', 'AuthController@logout')->name('admin.logout');

    /** Route for Manufacturer */
    Route::get('manufacturers', 'ManufacturerController@index')->name('admin.manufacturers');
    Route::match(['get', 'post'], 'manufacturer/create', 'ManufacturerController@create')->name('admin.manufacturer.create');
    Route::match(['get', 'post'], 'manufacturer/edit/{id}', 'ManufacturerController@edit')->name('admin.manufacturer.edit');

    /** Route for Products */
    Route::get('products', 'ProductController@index')->name('admin.products');
});

Route::middleware('admin_auth:admin')->group(function () {
    /** Login route */
    Route::match(['get', 'post'], 'login', 'AuthController@login')->name('admin.login');

    /** Register route */
    Route::match(['get', 'post'], 'register', 'RegisterController@index')->name('admin.register');
});
