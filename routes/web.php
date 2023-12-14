<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuggestedProfileController;

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
    return view('home');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/instagram',[App\Http\Controllers\instagramController::class, 'getInfo'])->name('business.info');

Route::get('/suggested-profiles', [SuggestedProfileController::class, 'index'])->name('suggested-profiles.index');
Route::get('/suggested-profiles/{profileId}', [SuggestedProfileController::class, 'show'])->name('suggested-profiles.show');
Route::post('/suggested-profiles/{profileId}/approve', [SuggestedProfileController::class, 'approveProfile'])->name('suggested-profiles.approve');
Route::post('/suggested-profiles/{profileId}/reject', [SuggestedProfileController::class, 'rejectProfile'])->name('suggested-profiles.reject');
Route::get('/suggested-profiles/create', [SuggestedProfileController::class, 'create'])->name('suggested-profiles.create');
Route::post('/suggested-profiles', [SuggestedProfileController::class, 'store'])->name('suggested-profiles.store');
Route::get('/instagram/{name}',[App\Http\Controllers\instagramController::class, 'add_realestate']);
Route::get('/instagram/{name}/{price}',[App\Http\Controllers\instagramController::class, 'add_realestate_database']);