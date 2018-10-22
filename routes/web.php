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
Route::get('/Admin/user/add','Admin\UserController@add')->name('Admin.user.add');

Route::get('/Admin/user/index','Admin\UserController@index')->name('Admin.user.index');
Route::post('/Admin/user/save','Admin\UserController@save')->name('Admin.user.save');
Route::get('/Admin/user/edit/{user}','Admin\UserController@edit')->name('Admin.user.edit');
Route::post('/Admin/user/update/{user}','Admin\UserController@update')->name('Admin.user.update');
Route::get('/Admin/user/delete/{user}','Admin\UserController@delete')->name('Admin.user.delete');
//新的路由方法
Route::resource('Admin/articles','Admin\ArticleController');