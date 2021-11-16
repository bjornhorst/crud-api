<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:8956/api/artists";
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());
        return view('artists.index', compact('responseBody'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8956/api/artists";
        try {
            $response = $client->post($url, [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'firstName' => $request->firstName,
                    'middleName' => $request->middleName,
                    'lastName' => $request->lastName,
                    'artistsName' => $request->artistsName,
                    'totalSongs' => 0,
                    'favorite' => $request->favorite,
                    'birthDay' => $request->birthDay,
                ],
            ]);
            return redirect()->route('artists.index')
                ->with('success','Artiest aangemaakt.');
        }catch (ClientException $e){
            $statusCode = $e->getResponse()->getStatusCode();
            if($statusCode == 400){
                echo "Niet alle velden waren ingevuld";
                return redirect()->route('artists.create')
                    ->with('error','Niet alle velden waren ingevuld!!');
            }
            if($statusCode == 201){
                return redirect()->route('artists.index')
                    ->with('succes','Artiest aangemaakt.');
            }
        }


        //echo $response->getBody();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:8956/api/artists/" . $id;
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());

        try{$clientSongs = new Client(); //GuzzleHttp\Client
            $urlSongs = "http://127.0.0.1:8956/api/artists/" . $id . "/songs";
            $responseSongs = $clientSongs->request('GET', $urlSongs, [
                'verify'  => false,
            ]);
            $responseBodySongs = json_decode($responseSongs->getBody());
        }catch (ClientException $e){
            $responseBodySongs = [];
        }

        return view('artists.show',compact('responseBody', 'responseBodySongs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:8956/api/artists/" . $id;
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());
        return view('artists.edit', compact('responseBody'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8956/api/artists/".$id;
        try {
            $response = $client->PUT($url, [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'firstName' => $request->firstName,
                    'middleName' => $request->middleName,
                    'lastName' => $request->lastName,
                    'artistsName' => $request->artistsName,
                    'favorite' => $request->favorite,
                    'birthDay' => $request->birthDay,
                ],
            ]);
            return redirect()->route('artists.index')
                ->with('success','Artiest aangepast.');
        }catch (ClientException $e){
            $statusCode = $e->getResponse()->getStatusCode();
            if($statusCode == 404){
                echo "Niet alle velden waren ingevuld";
                return redirect()->route('artists.create')
                    ->with('error','Niet alle velden waren ingevuld!!');
            }
            if($statusCode == 202){
                return redirect()->route('artists.index')
                    ->with('succes','KAPOT.');
            }
        }

//
//        return redirect()->route('artists.show', $id)
//            ->with('success','Artist updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:8956/api/artists/" . $id;
        $response = $client->request('DELETE', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());

        return redirect()->route('artists.index')
            ->with('success','Artist deleted successfully');
    }
}
