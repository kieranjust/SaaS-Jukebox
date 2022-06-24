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

 Route::middleware(['auth'])->group(function () {
    Route::resource('v1/users', App\Http\Controllers\API\UserController::class);

    Route::resource('v1/genres', \App\Http\Controllers\API\GenreController::class);

    Route::resource('v1/tracks', \App\Http\Controllers\API\TrackController::class);

    Route::resource('v1/playlists', \App\Http\Controllers\API\PlaylistController::class);
});
