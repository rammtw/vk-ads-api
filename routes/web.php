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

Route::get('/', function () {
    return view('welcome');
});

Route::get('social/vk', 'Auth\RegisterController@socialAuth')->name('social.vk');
Route::get('social/callback/vk', 'Auth\RegisterController@socialAuthCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cab', 'Ads\CabController@index')->name('cab.index');
Route::get('/cab/{id}', 'Ads\CabController@show')->name('cab.show');
Route::get('/ad/{id}', 'Ads\CabController@adShow')->name('ad.show');
