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

Route::prefix('dashboard/boards')->namespace('App\Http\Controllers\Boards')->group(function () {
    Route::get('login','LoginController@get')->name('board.login');
    Route::post('login/post','LoginController@post')->name('board.login.post');
    Route::get('/logout','LoginController@logout')->name('board.logout');

});
Route::group(['prefix'=>'boards','namespace'=>'App\Http\Controllers\Boards','middleware'=>'auth:board'],function() {
    Route::resource('boards','FilesController');
    Route::get('boards/status/{id}','FilesController@status')->name('files.status');

    Route::resource('edit','EditController');
    Route::get('enabled/{id}','FilesController@enabled')->name('enabled');
    Route::get('disabled/{id}','FilesController@disabled')->name('disabled');

});











