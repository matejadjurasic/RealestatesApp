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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/realestates/{id}/{price}/{location}', 'App\Http\Controllers\realEstateController@update')->name('realestates.updateprice');
Route::put('/realestates/{id}/edit/updateapi', 'App\Http\Controllers\realEstateController@updateapi')->name('realestates.updateapi');
Route::delete('/realestates/{id}','App\Http\Controllers\realEstateController@destroy')->name('realestates.deleteestate');

Route::post('/suggested-profiles/{profileId}/approve', 'App\Http\Controllers\SuggestedProfileController@approveProfile')->name('suggested-profiles.approve');
Route::post('/suggested-profiles/{profileId}/reject', 'App\Http\Controllers\SuggestedProfileController@rejectProfile')->name('suggested-profiles.reject');
Route::post('/suggested-profiles/create/{username}/{user_id}', 'App\Http\Controllers\SuggestedProfileController@store')->name('suggested-profiles.create');

