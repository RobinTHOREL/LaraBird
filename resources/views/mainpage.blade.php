@extends('layout')

@section('title')
    {{$page_name}}
@endsection

@section('content')
    <div class="title m-b-md">
        Page {{$page_name}}
    </div>

    <div class="links">
        <a href="/">Back to homepage</a>
    </div>
@endsection


