<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\SongController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return redirect('/artists');
});

Route::resource('artists', ArtistController::class);


Route::get('artists/{id}/song', ['as' => 'song.create', 'uses' => 'App\Http\Controllers\SongController@create']);
Route::delete('artists/{id}/song/{songId}', ['as' => 'song.destroy', 'uses' => 'App\Http\Controllers\SongController@destroy']);
Route::post('song/{id}', ['as' => 'song.store', 'uses' => 'App\Http\Controllers\SongController@store']);
//Route::get('song/{id}/edit', ['as' => 'song.edit', 'uses' => 'App\Http\Controllers\SongController@edit']);
Route::get('artists/{id}/song/{songId}/edit', ['as' => 'song.edit', 'uses' => 'App\Http\Controllers\SongController@edit']);
Route::put('artists/{id}/song/{songId}', ['as' => 'song.update', 'uses' => 'App\Http\Controllers\SongController@update']);


