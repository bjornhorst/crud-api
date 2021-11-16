<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Validator;
use App\Models\Artist;
class SongsController extends Controller
{
    public function getAllSongs() {
        $songs = Song::get()->toJson(JSON_PRETTY_PRINT);
        return response($songs, 200);
    }

    public function getSong($id, $songId){
//        if(Song::where('ArtistID', $id)->exists()){
            $song = Song::where('id', $songId)->get()->toJson(JSON_PRETTY_PRINT);
            return response($song, 200);
        //}
    }

    public function getAllSongsFromArtists($id) {
        if (Song::where('ArtistId', $id)->exists()) {
            $song = Song::where('ArtistId', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($song, 200);
        } else {
            return response()->json([
                "message" => "This artist has no songs"
            ], 404);
        }
    }
    //Create a artist
    public function createSong(Request $request) {

        try{
            $validaor = Validator::make($request->all(),[
                'songName' => 'required',
                'releaseDate' => 'required',
                'songTime' => 'required',
                'artistId' => 'required',
            ]);
            if ($validaor->fails()){
                return response()->json(['message' =>'Something went wrong'], 400);

                //return response()->json(['errors' => $validaor->errors()], 400);
            }
            $song = new Song();
            $song->songName = $request->songName;
            $song->releaseDate = $request->releaseDate;
            $song->songTime = $request->songTime;
            $song->artistId = $request->artistId;
            $song->save();
            $artist = Artist::find($request->artistId)->increment('totalSongs', 1);
            return response()->json([
                "message" => "artist record created"
            ], 201);
        }catch (Exception $error){
            return response()->json(['message' =>'Er is iets mis gegaan'], 403);
        }

    }
    //update a artists
    public function updateSong(Request $request, $id, $songId) {
        if (Song::where('id', $songId)->exists()) {
            $song = Song::find($songId);
            $song->update($request->all());
            return json_encode([
                'songName' => $song["songName"],
                'releaseDate' => $song["releaseDate"],
                'songTime' => $song["songTime"],
            ]);
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "artist not found"
            ], 404);
        }
    }

    public function deleteSong ($songId) {
        if(Song::where('id', $songId)->exists()) {
            $song = Song::find($songId);
            $artistId = $song->artistId;
            $song->delete();
            $artist = Artist::find($artistId)->increment('totalSongs', -1);
            return response()->json([
                "message" => "song deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "song not found"
            ], 404);
        }
    }
}
