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



Route::match(['get','post'],'/index/login','IndexController@login');
Route::get('/index/code','IndexController@code');

Route::group(['middleware' => ['admin_auth']],function(){
	Route::get('/', 'IndexController@index');
	Route::get('admin/index','AdminController@index');
	Route::get('admin/create','AdminController@create');
	Route::get('admin/update','AdminController@update');
	
	
	Route::get('exception/index','ExceptionController@index');
	Route::get('log/common/index','CommonLogController@index');
	Route::get('log/request/index','RequestLogController@index');
	Route::get('log/crontab/index','CrontabLogController@index');
	Route::get('log/sql/index','SqlLogController@index');
});
