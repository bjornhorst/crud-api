@extends('artists.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit the song</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('artists.show', $id) }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @foreach ($responseBody as $song)
        <form action="{{ route('song.update', ['id' => $responseBody[0]->artistId, 'songId' =>$responseBody[0]->id])}}" method="POST">
            @method('PUT')
            @csrf
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Song name:</strong>
                        <input type="text" name="songName" class="form-control" placeholder="Song name" value="{{ $song->songName}}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>song Time:</strong>
                        <input type="text" name="songTime" class="form-control" placeholder="Song name" value="{{ $song->songTime}}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>release Date:</strong>
                        <input type="text" name="releaseDate" class="form-control" placeholder="Song name" value="{{ $song->releaseDate}}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    @endforeach
@endsection
