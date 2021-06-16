<?php

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

Route::name('auth.')->prefix('auth')->group(function(){
    Route::get('login', 'AuthController@index')->name('login');
});

Route::get('/', 'FrontController@index')->name('front');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::middleware('auth','can:admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/perusahaan', 'AdminController@perusahaan')->name('perusahaan');
    Route::post('/perusahaan', 'AdminController@perusahaan');
});

Route::middleware('auth','can:perusahaan')->prefix('perusahaan')->name('perusahaan.')->group(function(){
    Route::get('/pekerjaan', 'PerusahaanController@pekerjaan')->name('pekerjaan');
    Route::post('/pekerjaan', 'PerusahaanController@pekerjaan');
    Route::get('/pelamar/{job}', 'PerusahaanController@pelamar')->name('pelamar');
    Route::post('/pelamar/{job}', 'PerusahaanController@pelamar');
    Route::get('/profil', 'PerusahaanController@profil')->name('profil');
    Route::put('/profil', 'PerusahaanController@profil_store')->name('profil_store');
});

Route::middleware('auth','can:member')->prefix('pelamar')->name('pelamar.')->group(function(){
    Route::get('/lamaranku', 'PelamarController@lamaranku')->name('lamaranku');
    Route::post('/lamaranku', 'PelamarController@lamaranku');
});

Route::middleware('auth')->name('dashboard.')->group(function(){
    Route::get('/detail-pekerjaan/{job}', 'HomeController@lamaran')->name('detail_pekerjaan');
});
