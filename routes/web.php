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
    return view('main');
});

Route::get('/test', function () {
    return view('create_submission');
});

Route::get('judger', 'Judger\JudgerController@getJudgerList')->name("judger");
Route::post('judger', 'Judger\JudgerController@updateJudger');

Route::get('setting', 'Setting\SettingController@viewSetting')->name("setting");
Route::post('setting', 'Setting\SettingController@updateSetting');


Route::group(['domain' => 'localhost'], function () {
    Route::get('/', function () {
    	return view('main');
	});
});

Route::domain('{sub}.localhost')->group(function () {
    
    //echo Route::current()->parameter('sub');
  
    Route::get('/', function () {
       //echo request()->sub;

       echo request()->getHost();
       // return "This will respond to requests for 'admin.localhost/'";
    });
});
