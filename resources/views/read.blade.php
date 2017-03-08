@extends('layout')

@section('title')
    The Wall
@endsection

@section('content')
    <div class="title m-b-md">
        The Wall
    </div>

    <div class="links">
        @if($search === false)
            All post
        @else
            All post containing "{{$search}}"
        @endif
    </div>

    <div class="links">
        <a href="/">Back to homepage</a>
    </div>

@endsection


