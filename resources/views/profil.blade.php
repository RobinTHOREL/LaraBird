@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                    <div class="profil_header">
                    <img class="profil_avatar" src="/uploads/avatars/{{ $user->avatar }}">
                    <h2><span>@</span>{{ $user->name }}</h2>
                    @if(Auth::id() == $user_id)

                    @else
                        <!--<button type="button" class="btn btn-primary"><span><i class="fa fa-star"></i></span> Follow</button>-->
                            <button type="button" class="btn btn-success"><span><i class="fa fa-check"></i></span> Follow</button>
                    @endif
                        <br>
                    @if(Auth::id() == $user_id)
                        <form class="form-group" enctype="multipart/form-data" action="/profil" method="POST">
                            <label>Update Profile Image</label>
                            <input type="file" name="avatar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="pull-right btn btn-sm btn-primary">
                        </form>

                    @endif
                    <div class="col-md-3 profil_stats">
                        <h3>Posts</h3>
                        <p>{{ $user_id }}</p>
                    </div>
                    <div class="col-md-3 profil_stats">
                        <h3>Followers</h3>
                        <p>{{ Auth::id() }}</p>
                    </div>
                    <div class="col-md-3 profil_stats">
                        <h3>Followed</h3>
                        <p>10</p>
                    </div>
                </div>
                @if(Auth::id() == $user_id)
                    <div class="panel-body">
                        {!! Form::open(['url' => 'write']) !!}
                        {!! Form::text('post_content') !!}
                        {!! Form::submit('Write on the wall') !!}
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
