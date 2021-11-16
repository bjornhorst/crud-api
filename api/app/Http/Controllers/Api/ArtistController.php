<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
    public function getAllArtists() {
        $artists = Artist::get()->toJson(JSON_PRETTY_PRINT);
        return response($artists, 200);
    }

    public function getArtist($id) {
        if (Artist::where('id', $id)->exists()) {
            $artist = Artist::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($artist, 200);
        } else {
            return response()->json([
                "message" => "artist not found"
            ], 404);
        }
    }
    //Create a artist
    public function createArtist(Request $request) {

        try{
            $validaor = Validator::make($request->all(),[
                'firstName' => 'required',
                'middleName' => 'nullable',
                'lastName' => 'required',
                'artistsName' => 'required',
                'favorite' => 'required',
                'birthDay' => 'required'
            ]);
            if ($validaor->fails()){
                return response()->json(['message' =>'Something went wrong'], 400);

                //return response()->json(['errors' => $validaor->errors()], 400);
            }
            $artist = new Artist;
            $artist->firstName = $request->firstName;
            $artist->middleName = $request->middleName;
            $artist->lastName = $request->lastName;
            $artist->artistsName = $request->artistsName;
            $artist->totalSongs = 0;
            $artist->favorite = $request->favorite;
            $artist->birthDay = $request->birthDay;
            $artist->save();
            return response()->json([
                "message" => "artist record created"
            ], 201);
        }catch (Exception $error){
            return response()->json(['message' =>'Er is iets mis gegaan'], 403);
        }

    }
    //update a artists
    public function updateArtist(Request $request, $id) {
        if (Artist::where('id', $id)->exists()) {
            $artist = Artist::find($id);
            $artist->update($request->all());
            return json_encode([
               'firstName' => $artist["firstName"],
                'middleName' => $artist["middleName"],
                'LastName' => $artist["lastName"],
                'artistsName' => $artist["artistsName"],
                'totalSongs' => $artist->totalSongs,
                'birthDay' => $artist["birthDay"],
                'favorite' => $artist['favorite'],
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

    public function deleteArtist ($id) {
        if(Artist::where('id', $id)->exists()) {
            $artist = Artist::find($id);
            $artist->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "artist not found"
            ], 404);
        }
    }
}
