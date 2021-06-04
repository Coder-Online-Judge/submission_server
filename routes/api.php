<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('languages', 'Language\LanguageController@showActiveLanguage');
Route::get('languages/all', 'Language\LanguageController@showAllLanguage');
Route::get('languages/{id}', 'Language\LanguageController@show');
Route::get('verdicts', 'Verdict\VerdictController@index');
Route::get('verdicts/{id}', 'Verdict\VerdictController@show');

Route::get('submissions/', 'Submission\SubmissionController@show');
Route::get('submissions/{token}', 'Submission\SubmissionController@single');
Route::post('submissions/', 'Submission\SubmissionController@store');
Route::get('judge/', 'Submission\SubmissionController@judge');
