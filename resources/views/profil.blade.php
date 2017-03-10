@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                    <div class="profil_header">
                    <img class="profil_avatar" src="/uploads/avatars/{{ $user->avatar }}">
                    <h2><span>@</span>{{ $user->name }}
                    @if(Auth::id() == $user_id)

                    @else
                            @if($isFollowed == false)
                                <form action="/add_follower" method="POST">
                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-star"></i></span> Follow {{ $user->name }}</button>
                                </form>
                            @else
                                <form action="/del_follower" method="POST">
                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-success"><span><i class="fa fa-check"></i></span> Follow</button>
                                </form>
                            @endif


                    @endif
                    </h2>
                    @if(Auth::id() == $user_id)
                        <form class="form-group" enctype="multipart/form-data" action="/profil" method="POST">
                            <label>Update Profile Image</label>
                            <input type="file" name="avatar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="pull-right btn btn-sm btn-primary">
                        </form>

                    @endif
                        <div class="col-md-12">
                            <div class="col-md-4 profil_stats">
                                <h3>Posts</h3>
                                <p>{{ count($user->posts) }}</p>
                            </div>
                            <div class="col-md-4 profil_stats">
                                <h3>Followers</h3>
                                <p><a href="followers/{{ $user_id }}">{{ $nbfollowers }}</a></p>
                            </div>
                            <div class="col-md-4 profil_stats">
                                <h3>Followed</h3>
                                <p>{{ $nbfolloweds }}</p>
                            </div>
                        </div>
                </div>
                <div class="col-md-2">
                    <div class="panel-body">

                    </div>
                </div>

                <div class="col-md-8">

                    <ol class="timeline">
                        @if(Auth::id() == $user_id)
                        <li>
                            <i class="pointer"></i>
                            <div class="unit">
                                <!-- Units -->
                                <div class="actionUnits">
                                    <div class="formUnit" id="Status">
                                        <i class="active"></i>
                                        <!-- Ouvre le fomulaire -->
                                        {!! Form::open(['url' => 'post_from_profil']) !!}
                                        {!! Form::textarea('post_content', null, ['placeholder' => 'Write only with butter', 'class' => 'sizetop']) !!}

                                        <ol class="controls clearfix">
                                            <li class="post">
                                                {!! Form::submit('Publish ur own butter') !!}
                                            </li>
                                        </ol>
                                        <!-- Ferme le formulaire -->
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!-- / Units -->

                            </div>
                        </li>
                        @endif
                        @foreach($posts as $post)
                            <li>
                                <i class="pointer"></i>
                                <div class="unit">

                                    <!-- Story -->
                                    <div class="storyUnit">
                                        <div class="imageUnit">
                                            <a href="#"><img src="/uploads/avatars/{{ $post->user->avatar }}" class="avatar_post"></a>
                                            <div class="imageUnit-content">
                                                <h4><span>@</span>{!! $post->user->name !!}</h4>
                                                <p>{!! $post->created_at->diffForHumans() !!}</p>
                                            </div>

                                        </div>

                                        <p>{!! $post->post_content !!}</p>

                                    </div>
                                    <!-- / Story -->

                                    <!-- Units -->
                                    <ol class="storyActions">
                                        <li><a href="#"><i class="fa fa-heart"></i> Like</a></li>
                                        @if(Auth::id() == $post->user->id)
                                            <li><a href="/delete/{{ $post->id }}"><i class="fa fa-trash"></i> Delete</a></li>
                                        @endif
                                        <li><a href="#"><i class="fa fa-comment"></i> Comment</a></li>
                                    </ol>
                                    <!-- / Units -->

                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
                <div class="col-md-2">
                    <div class="panel-body">

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
