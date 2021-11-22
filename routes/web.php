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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('posts')->group(function () {

    Route::get('','PostController@index')->name('post.index');
    Route::get('create', 'PostController@create')->name('post.create');
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('edit/{post}', 'PostController@edit')->name('post.edit');
    Route::post('update/{post}', 'PostController@update')->name('post.update');
    Route::post('delete/{post}', 'PostController@destroy' )->name('post.destroy');
    Route::post('deleteAjax/{post}', 'PostController@destroyAjax' )->name('post.destroyAjax');
    Route::get('show/{post}', 'PostController@show')->name('post.show');

});

Route::prefix('categories')->group(function () {

    Route::get('','CategoryController@index')->name('category.index');
    Route::get('create', 'CategoryController@create')->name('category.create');
    Route::post('store', 'CategoryController@store')->name('category.store');
    Route::get('edit/{category}', 'CategoryController@edit')->name('category.edit');
    Route::post('update/{category}', 'CategoryController@update')->name('category.update');
    Route::post('delete/{category}', 'CategoryController@destroy' )->name('category.destroy');
    Route::post('deleteAjax/{category}', 'CategoryController@destroyAjax' )->name('category.destroyAjax');
    Route::get('show/{category}', 'CategoryController@show')->name('category.show');

});
