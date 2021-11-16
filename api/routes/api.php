<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\SongsController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('artists', [ArtistController::class, 'getAllArtists']);
Route::get('artists/{id}', [ArtistController::class,'getArtist']);
Route::post('artists', [ArtistController::class,'createArtist']);
Route::put('artists/{id}', [ArtistController::class,'updateArtist']);
Route::delete('artists/{id}',[ArtistController::class,'deleteArtist']);


Route::get('artists/{id}/songs', [SongsController::class, 'getAllSongsFromArtists']);
Route::get('artists/{id}/songs/{songId}', [SongsController::class, 'getSong']);
Route::post('artists/addSong', [SongsController::class,'createSong']);
Route::put('artists/{id}/songs/{songsId}', [SongsController::class,'updateSong']);
Route::delete('songs/{songId}', [SongsController::class, 'deleteSong']);
