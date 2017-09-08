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
    Route::post('goods/add', 'GoodsController@store')->name('goods.store');
    Route::get('goods/edit/{goods_id}', 'GoodsController@edit')->name('goods.edit');
    Route::post('goods/update', 'GoodsController@update')->name('goods.update');
    Route::get('goods/update_show/{goods_id}/{if_show}', 'GoodsController@updateShow')->name('goods.update_show');
    Route::get('goods/delete/{goods_ids}', 'GoodsController@delete')->name('goods.delete');

    Route::resource('navigation', 'NavigationController');
    Route::get('navigation/get_left_navigation/{parent_id}', 'NavigationController@getLeftNavigation')->name('navigation.get_left_navigation');

    Route::resource('auth', 'AuthController');
    Route::resource('auth_group', 'AuthGroupController');
    Route::resource('admin', 'AdminController');
    //    Route::get('navigation', 'NavigationController@index')->name('navigation.index');
//    Route::get('navigation/create', 'NavigationController@create')->name('navigation.create');
//    Route::resource('goods', 'GoodsController');
});

