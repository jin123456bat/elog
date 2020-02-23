<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//异常上报
Route::post('exception','ExceptionController@trigger');

//日志上报
Route::post('log/common','CommonLogController@trigger');
Route::post('log/request','RequestLogController@trigger');
Route::post('log/crontab','CrontabLogController@trigger');
Route::post('log/sql','SqlLogController@trigger');

//登录接口
Route::post('index/login','IndexController@login');

Route::group(['middleware'=>[]],function(){
	Route::post('admin/index','AdminController@index');
	Route::post('admin/create','AdminController@create');
	Route::post('admin/update','AdminController@update');
	Route::post('admin/delete','AdminController@delete');
	Route::post('config/index','ConfigController@index');
	
	Route::post('exception/index','ExceptionController@index');
	Route::post('log/common/index','CommonLogController@index');
	Route::post('log/request/index','RequestLogController@index');
	Route::post('log/crontab/index','CrontabLogController@index');
	Route::post('log/sql/index','SqlLogController@index');
});
