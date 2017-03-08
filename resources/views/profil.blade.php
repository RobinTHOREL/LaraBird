@extends('layout')

@section('title')
    {{$profil_id}}
@endsection

@section('content')
    <div class="title m-b-md">
        Page {{$profil_id}}
    </div>

    <div class="links">
        <a href="/">Back to homepage</a>
    </div>
@endsection


