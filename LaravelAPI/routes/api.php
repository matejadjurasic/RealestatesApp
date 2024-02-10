<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\SuggestedProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\realEstateController;

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
Auth::routes();
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken('Password')->plainTextToken;
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register.register');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.login');
Route::post('/reset', 'App\Http\Controllers\Auth\ResetPasswordController@resetPassword')->name('resetpassword.reset');



Route::resource('realestates', realEstateController::class);    //??
Route::resource('realestates_details', SearchController::class);  
Route::get('/realestates/{id}','App\Http\Controllers\realEstateController@show')->name('realestates.showestate');




Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::get('/favorites', 'App\Http\Controllers\favoriteController@index')->name('favorites.all');
    Route::get('/favorites/all', 'App\Http\Controllers\favoriteController@getAll')->name('favorites.getAll');
    Route::post('/favorites/add/{realEstateId}', 'App\Http\Controllers\favoriteController@store')->name('favorites.add');
    Route::delete('/favorites/remove/{realEstateId}', 'App\Http\Controllers\favoriteController@destroy')->name('favorites.remove');
    Route::post('/realestates/{name}','App\Http\Controllers\realEstateController@store')->name('realestates.addestate')->middleware('is_admin');
    Route::post('/realestates/{id}/{price}/{location}', 'App\Http\Controllers\realEstateController@update')->name('realestates.updateprice')->middleware('is_admin');
    Route::put('/realestates/{id}/edit/updateapi', 'App\Http\Controllers\realEstateController@updateapi')->name('realestates.updateapi')->middleware('is_admin');
    Route::delete('/realestates/{id}','App\Http\Controllers\realEstateController@destroy')->name('realestates.deleteestate')->middleware('is_admin');
    Route::get('/suggested-profiles', [SuggestedProfileController::class, 'index'])->name('suggested-profiles.index');
    Route::get('/suggested-profiles/{profileId}', [SuggestedProfileController::class, 'show'])->name('suggested-profiles.show');
    Route::post('/suggested-profiles/{profileId}/approve', 'App\Http\Controllers\SuggestedProfileController@approveProfile')->name('suggested-profiles.approve')->middleware('is_admin');
    Route::post('/suggested-profiles/{profileId}/reject', 'App\Http\Controllers\SuggestedProfileController@rejectProfile')->name('suggested-profiles.reject')->middleware('is_admin');
    Route::post('/suggested-profiles/create/{username}/{user_id}', 'App\Http\Controllers\SuggestedProfileController@store')->name('suggested-profiles.create');
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('login.logout');
});

