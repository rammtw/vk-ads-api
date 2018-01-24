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

Route::get('social/vk', 'Auth\RegisterController@socialAuth');
Route::get('social/callback/vk', 'Auth\RegisterController@socialAuthCallback');

Route::get('vkauth', function (\ATehnix\VkClient\Auth $auth) {
    echo "<a href='{$auth->getUrl()}'> Войти через VK.Com </a><hr>";

    if (Request::exists('code')) {
        echo 'Token: '.$auth->getToken(Request::get('code'));
    }
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
