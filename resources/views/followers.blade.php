@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="profil_header">
                    <img class="profil_avatar" src="/uploads/avatars/{{ $user->avatar  }}">
                    <h2><span>@</span> {{ $user->name }} </h2>
                    <h3>Followed by <strong>{{ $nbfollowers }}</strong> peoples</h3>
                </div>
                <div class="col-md-10 col-md-offset-1">


                        @foreach($follow as $followed)
                            <img src="/uploads/avatars/{{ $followed->avatar }}" class="avatar_post">
                            <span>

                            <a href="/profil/{{ $followed->id }}"><span>@</span> {!! $followed->name !!}</a>


                        </span><br>


                        @endforeach


                </div>
        </div>
    </div>
    </div>

@endsection
