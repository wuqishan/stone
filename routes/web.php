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


Route::group(['namespace' => 'Admin', 'prefix' => 'admin/'], function () {

    Route::get('index', 'IndexController@index')->name('admin.index');

    Route::get('main', 'IndexController@main')->name('admin.main');

    Route::post('image', 'ImageController@upload')->name('admin.image.upload');
    Route::get('image/delete/{goods_id}/{image_id}', 'ImageController@delete')->name('admin.image.delete');
    Route::get('image/{goods_id}', 'ImageController@getImagesByGoogsId')->name('admin.image.goods_id');

    Route::get('goods/index', 'GoodsController@index')->name('goods.index');
    Route::get('goods/create', 'GoodsController@create')->name('goods.create');

    Route::post('goods', 'GoodsController@store')->name('goods.store');

//    Route::resource('goods', 'GoodsController');
});

