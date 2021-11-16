@extends('artists.layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Artists</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('artists.create') }}">Add new artist</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>FirstName</th>
            <th>MiddleName</th>
            <th>LastName</th>
            <th>ArtistName</th>
            <th>TotalSongs</th>
            <th>BirthDay</th>
            <th>favorite</th>

            <th width="280px">Action</th>
        </tr>
                    @foreach ($responseBody as $artists)

                        <tr>
                            {{--                <td>{{ $artists->id }}</td>--}}

                            <td>{{ $artists->firstName }}</td>
                            <td>{{ $artists->middleName }}</td>
                            <td>{{ $artists->lastName }}</td>
                            <td>{{ $artists->artistsName }}</td>
                            <td>{{ $artists->totalSongs }}</td>
                            <td>{{ $artists->birthDay }}</td>
                            <td>{{ $artists->favorite}}</td>
                            <td>
                                <form action="{{route('artists.destroy', $artists->id)}}" method="POST">

                                    <a class="btn btn-info" href="{{route('artists.show', $artists->id)}}">Show</a>

                                    <a class="btn btn-primary" href="{{route('artists.edit', $artists->id)}}">Edit</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Als je de artiest <{{$artists->artistsName}}> verwijderd, worden ook alle songs verwijderd van deze artiest')" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

        @endforeach
    </table>


@endsection
