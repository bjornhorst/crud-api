@extends('artists.layout')

@section('content')
    <style>
        strong{
            display: inline-block;
            width: 10%;
            text-align: right;

        }
    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Artists</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('artists.index') }}"> Back</a>
                <a class="btn btn-success" href="{{ route('song.create', $responseBody[0]->id) }}"> Add song</a>
            </div>
        </div>
    </div>
    <div class="card text-center">
        <div class="card-header">
            Artists details
        </div>
        <div class="card-body">
            <h5 class="card-title">full name: {{$responseBody[0]->firstName ." ". $responseBody[0]->middleName . " ".$responseBody[0]->lastName}}</h5>
            <h5 class="card-title">Artists name: {{$responseBody[0]->artistsName}}</h5>
            <h5 class="card-title">birthday: {{$responseBody[0]->birthDay}}</h5>

        </div>
        <div class="card-footer text-muted">
            Total songs: {{$responseBody[0]->totalSongs}}
        </div>
    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>songName</th>
                            <th>releaseDate</th>
                            <th>songTime</th>
                            <th>ArtistName</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($responseBodySongs as $songs)
                            <tr>
                                <td>{{ $songs->songName }}</td>
                                <td>{{ $songs->releaseDate }}</td>
                                <td>{{ $songs->songTime }}</td>
                                <td>{{ $responseBody[0]->artistsName }}</td>
                                <td>
                                    <form action="{{route('song.destroy', ['id' => $responseBody[0]->id, 'songId' =>$songs->id])}}" method="POST">

{{--                                        <a class="btn btn-info" href="{{route('song.show', $songs->id)}}">Show</a>--}}

{{--                                        <a class="btn btn-primary" href="{{route('song.edit', $songs->id)}}">Edit</a>--}}
                                        <a class="btn btn-primary" href="{{route('song.edit', ['id' => $responseBody[0]->id, 'songId' =>$songs->id])}}">Edit</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Als je de artiest <{{$songs->songName}}> verwijderd, worden ook alle songs verwijderd van deze artiest')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>


    </div>

@endsection
