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

Route::name('member.')->middleware('can:admin')->prefix('member')->group(function() {
    Route::get('/', 'MemberController@index')->name('index');
    Route::post('/', 'MemberController@index');
});
