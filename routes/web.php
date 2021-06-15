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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');


Route::middleware('auth','can:admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/perusahaan', 'AdminController@perusahaan')->name('perusahaan');
    Route::post('/perusahaan', 'AdminController@perusahaan');
});

Route::middleware('auth','can:perusahaan')->prefix('perusahaan')->name('perusahaan.')->group(function(){
    Route::get('/pekerjaan', 'PerusahaanController@pekerjaan')->name('pekerjaan');
    Route::post('/pekerjaan', 'PerusahaanController@pekerjaan');
    Route::get('/profil', 'PerusahaanController@profil')->name('profil');
    Route::put('/profil', 'PerusahaanController@profil_store')->name('profil_store');
});
