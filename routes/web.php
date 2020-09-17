<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::group(['middleware' => ['web','auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/tambah-pengguna', 'UserController@create')->name('user.create');
    Route::resource('user', 'UserController')->except('show','create');

    Route::get('/profil', 'UserController@show')->name('user.show');
    Route::patch('/profil', 'UserController@updateProfil')->name('update-profil');

    Route::get('/ganti-password', 'UserController@gantiPassword')->name('ganti-password');
    Route::patch('/ganti-password', 'UserController@updatePassword')->name('update-password');
});
