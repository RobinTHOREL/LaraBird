@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="profil_header">
                    <img class="profil_avatar" src="/uploads/avatars/default.jpg">
                    <h2><span>@</span> {{ $id_user }} </h2>


            </div>
        </div>
    </div>
    </div>

@endsection
