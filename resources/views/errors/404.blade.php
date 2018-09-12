@extends('layouts.main')

@section('content')
    <div id="login-container" class="container-fluid" style="background-color: lightgray;">
        <div class="row">
            <div class="col-md-12 mt-1 mb-1 text-center">
                <h1>{{ $exception->getMessage() }}</h1>
                <a href="{{ asset('/') }}">back to home</a>
            </div>
        </div>
    </div>
@endsection