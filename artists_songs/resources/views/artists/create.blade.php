@extends('artists.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('artists.index') }}"> Back</a>
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

    <form action="{{ route('artists.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>firstName:</strong>
                    <input type="text" name="firstName" class="form-control" placeholder="firstName">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>middleName:</strong>
                    <input type="text" name="middleName" class="form-control" placeholder="middleName">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>lastName:</strong>
                    <input type="text" name="lastName" class="form-control" placeholder="lastName">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>artistName:</strong>
                    <input type="text" name="artistsName" class="form-control" placeholder="artistName">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>birthDay:</strong>
                    <input type="date" name="birthDay" class="form-control" placeholder="birthDay">
                </div>
            </div>
            <strong>Favortite:</strong>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>No</strong>
                    <input type="radio" name="favorite" class="form-control" placeholder="favorite" value="0">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Yes:</strong>
                    <input type="radio" name="favorite" class="form-control" placeholder="favorite" value="1">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
