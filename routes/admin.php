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

Route::prefix('dashboard/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('login','LoginController@get')->name('login');
    Route::post('login/post','LoginController@post')->name('login.post');
    Route::get('/logout','LoginController@logout')->name('logout');

}) ;
Route::group(['prefix'=>'admin','namespace'=>'App\Http\Controllers\Admin','middleware'=>'auth:admin'],function(){


    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index')->name('dashboard');
        Route::get('create', 'ProductController@create')->name('admin.product');
        Route::get('index', 'ProductController@index')->name('show.products');
        Route::post('store', 'ProductController@store')->name('product.store');
        Route::get('edit/{id}', 'ProductController@edit')->name('edit.product');
        Route::post('update/{id}', 'ProductController@update')->name('update.product');
        Route::get('delete/{id}', 'ProductController@destroy')->name('delete.product');
    });

    #################Begin category routes#######################################
    Route::group(['prefix' => 'categories'], function () {
        Route::get('index', 'CategoryController@index')->name('show.categories');
        Route::get('create', 'CategoryController@create')->name('admin.category');
        Route::post('store', 'CategoryController@store')->name('category.store');
        Route::get('edit/{id}', 'CategoryController@edit')->name('edit.category');
        Route::post('update/{id}', 'CategoryController@update')->name('update.category');
        Route::get('delete/{id}', 'CategoryController@destroy')->name('delete.category');
    });
    #################end category routes#######################################
    #################begin subcategory routes#######################################

    Route::group(['prefix' => 'subcategories'], function () {
        Route::get('create', 'SubCategories@create')->name('create.subcategory');
        Route::post('store', 'SubCategories@store')->name('store.subcategory');
        Route::get('index', 'SubCategories@index')->name('index.subcategory');
        Route::get('all', 'SubCategories@all')->name('all.subcategory');
        Route::post('delete', 'SubCategories@delete')->name('delete.subcategory');
        Route::get('edit/{id}', 'SubCategories@edit')->name('edit.subcategory');
        Route::post('update', 'SubCategories@update')->name('update.subcategory');
    });

    Route::resource('document_type','DocumentTypeController');
    Route::resource('parties','PartiesController');
    Route::resource('administrations','AdministrationsController');
    Route::resource('BoardOfDirectors','BoardOfDirectorsController');
    Route::get('/files/archive','FilesController@archive');

    Route::resource('files','FilesController');
    Route::resource('jobs','JobsController');
    Route::get('/get_job/{id}','AdministrationsController@get_job');
    Route::get('admin/status/{id}','FilesController@status')->name('admin.files.status');
    Route::resource('importance','ImportanceController');
    Route::resource('follows','FollowsController');
    Route::resource('response','ResponseController');



});











