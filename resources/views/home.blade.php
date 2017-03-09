@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div class="panel">
                <div class="panel-body">
                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="profil_avatar_home center">
                    <h1 class="center"><span>@</span>{{ Auth::user()->name }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel-body">
                <ol class="timeline">
                    <li>
                        <i class="pointer"></i>
                        <div class="unit">
                            <ol class="actions">
                                <li class="active"><a href="#" rel="Status"><i class="icon icon-status"></i>Status</a></li>
                                <li><a href="#"><i class="icon icon-photo"></i>Photo</a></li>
                            </ol>

                            <!-- Units -->
                            <div class="actionUnits">
                                <div class="formUnit" id="Status">
                                    <i class="active"></i>
                                    <!-- Ouvre le fomulaire -->
                                {!! Form::open(['url' => 'write']) !!}
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
                    @foreach($posts as $post)
                    <li>
                        <i class="pointer"></i>
                        <div class="unit">

                            <!-- Story -->
                            <div class="storyUnit">
                                <div class="imageUnit">
                                    <a href="#"><img src="/uploads/avatars/{{ $post->user->avatar }}" class="avatar_post"></a>
                                    <div class="imageUnit-content">
                                        <h4><a href="profil/{!! $post->user->id !!}"><span>@</span>{!! $post->user->name !!}</a></h4>
                                        <p>{!! $post->created_at->diffForHumans() !!}</p>
                                    </div>

                                </div>

                                <p>{!! $post->post_content !!}</p>

                            </div>
                            <!-- / Story -->

                            <!-- Units -->
                            <ol class="storyActions">
                                <li><a class="likes" href="#"><i class="fa fa-heart"></i> Like</a></li>
                                @if(Auth::id() == $post->user->id)
                                    <li><a href="#"><i class="fa fa-modx"></i> Modifier</a></li>
                                    <li><a href="#"><i class="fa fa-trash"></i> Supprimer</a></li>
                                @endif
                                    <li><a href="#"><i class="fa fa-comment"></i> Comment</a></li>
                            </ol>
                            <!-- / Units -->

                        </div>
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel">
                <div class="panel-body">
                    All users : <hr>
                @foreach($users as $user)
                    @if(Auth::id() != $user->id)
                        <img src="/uploads/avatars/{{ $user->avatar }}" class="avatar_post">
                        <a href=""><span>@</span> {!! $user->name !!}</a>
                            @if($isFollowed == false)
                                <button type="submit" class="btn btn-primary"><span><i class="fa fa-star"></i></span> Follow {{ $user->name  }}</button>
                            @else
                                <button type="submit" class="btn btn-success"><span><i class="fa fa-check"></i></span> Follow</button>
                            @endif
                            <hr>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
