<?php

namespace App\Http\Controllers;

use App\Models\Song;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('artists/songs.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8956/api/artists/addSong";
        try {
            $response = $client->post($url, [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'songName' => $request->songName,
                    'releaseDate' => $request->releaseDate,
                    'songTime' => $request->songTime,
                    'artistId' => $id,
                ],
            ]);
            return redirect()->route('artists.show', $id)
                ->with('success','song aangemaakt.');
        }catch (ClientException $e){
            $statusCode = $e->getResponse()->getStatusCode();
            if($statusCode == 400){
                echo "Niet alle velden waren ingevuld";
                return redirect()->route('song.create', $id)
                    ->with('error','Niet alle velden waren ingevuld!!');
            }
            if($statusCode == 201){
                return redirect()->route('artists.show', $id)
                    ->with('succes','song aangemaakt.');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $songId)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:8956/api/artists/" . $id. '/songs/' .$songId;
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());
        //return view('artists.edit', compact('responseBody'));
        return view('artists/songs.edit', compact('id','responseBody'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $songId)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8956/api/artists/".$id. "/songs/" . $songId;
        try {
            $response = $client->PUT($url, [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'songName' => $request->songName,
                    'songTime' => $request->songTime,
                    'releaseDate' => $request->releaseDate,
                ],
            ]);
            return redirect()->route('artists.show', $id)
                ->with('success','Artiest jgureghu.');
        }catch (ClientException $e){
            $statusCode = $e->getResponse()->getStatusCode();
            if($statusCode == 404){
                echo "Niet alle velden waren ingevuld";
                return redirect()->route('song.edit', ['id' => $id, 'songId' =>$songId])
                    ->with('error','Niet alle velden waren ingevuld!!');
            }
            if($statusCode == 202){
                return redirect()->route('artists.index')
                    ->with('succes','KAPOT.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy($id ,$songId)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:8956/api/songs/" . $songId;
        $response = $client->request('DELETE', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());

        return redirect()->route('artists.show' , $id)
            ->with('success','Song deleted successfully');
    }
}
