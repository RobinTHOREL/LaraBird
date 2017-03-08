@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="profil_header">
                    <img class="profil_avatar" src="/uploads/avatars/{{ $user->avatar }}">
                    <h2><span>@</span>{{ $user->name }}</h2>
                    <form class="form-group" enctype="multipart/form-data" action="/profil" method="POST">
                        <label>Update Profile Image</label>
                        <input type="file" name="avatar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="pull-right btn btn-sm btn-primary">
                    </form>
                    <div class="col-md-3 profil_stats">
                        <h3>Posts</h3>
                        <p>{{ $user_id }}</p>
                    </div>
                    <div class="col-md-3 profil_stats">
                        <h3>Followers</h3>
                        <p>10</p>
                    </div>
                    <div class="col-md-3 profil_stats">
                        <h3>Followed</h3>
                        <p>10</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
