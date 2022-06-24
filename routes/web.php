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
    return view('welcome');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/admin/playlists',
        App\Http\Controllers\Admin\PlaylistController::class);

    Route::resource('/admin/users',
        App\Http\Controllers\Admin\UserController::class);

    Route::resource('/admin/genres',
        App\Http\Controllers\Admin\GenreController::class);

    Route::resource('/admin/tracks',
        App\Http\Controllers\Admin\TrackController::class);

});

require __DIR__.'/auth.php';
