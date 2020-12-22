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

    Route::get('/profil', 'UserController@show')->name('user.show');
    Route::patch('/profil', 'UserController@updateProfil')->name('update-profil');

    Route::get('/ganti-password', 'UserController@gantiPassword')->name('ganti-password');
    Route::patch('/ganti-password', 'UserController@updatePassword')->name('update-password');

    Route::group(['middleware' => ['can:super_admin']], function () {
        Route::get('/tambah-pengguna', 'UserController@create')->name('user.create');
        Route::resource('user', 'UserController')->except('show','create');
    });

    Route::group(['middleware' => ['can:pengurus_lab']], function () {
        Route::get('/tambah-pasien', 'PasienController@create')->name('pasien.create');
        Route::resource('pasien', 'PasienController')->except('create','show');
    });

    Route::group(['middleware' => ['can:dokter','kuisioner']], function () {
        Route::get('/pasien-saya', 'PasienController@dokter')->name('pasien.dokter');
        Route::resource('diagnosa', 'DiagnosaController')->except('index','create','store','edit');
    });

    Route::group(['middleware' => ['can:dokter','sudah_kuis']], function () {
        Route::get('/kuisioner/create', 'KuisionerController@create')->name('kuisioner.create');
        Route::post('/hasil-kuisioner', 'HasilKuisionerController@store')->name('hasil-kuisioner.store');
    });

    Route::group(['middleware' => ['can:dokter-lab']], function () {
        Route::get('/pasien/{pasien}', 'PasienController@show')->name('pasien.show');
    });

    Route::group(['middleware' => ['can:marketing']], function () {
        Route::get('/tambah-jadwal-kunjungan', 'JadwalKunjunganController@create')->name('jadwal-kunjungan.create');
        Route::resource('jadwal-kunjungan', 'JadwalKunjunganController')->except('update','show','create','index');
    });

    Route::group(['middleware' => ['can:dokter-marketing']], function () {
        Route::patch('/jadwal-kunjungan/{jadwal_kunjungan}', 'JadwalKunjunganController@update')->name('jadwal-kunjungan.update');
    });

    Route::group(['middleware' => ['can:manager_marketing']], function () {
        Route::get('/kuisioner/download/{hasil_kuisioner}', 'KuisionerController@download')->name('kuisioner.download');
        Route::get('/kuisioner', 'KuisionerController@index')->name('kuisioner.index');
        Route::get('/kuisioner/{user}/{bulan}', 'KuisionerController@show')->name('kuisioner.show');
        Route::get('/pengaturan-kuisioner', 'KuisionerController@edit')->name('kuisioner.edit');
        Route::post('/kuisioner', 'KuisionerController@store')->name('kuisioner.store');
    });

    Route::group(['middleware' => ['can:dokter-marketing-manager_marketing']], function () {
        Route::get('/jadwal-kunjungan', 'JadwalKunjunganController@index')->name('jadwal-kunjungan.index');
        Route::get('/jadwal-kunjungan/{jadwal_kunjungan}', 'JadwalKunjunganController@show')->name('jadwal-kunjungan.show');
    });

});
