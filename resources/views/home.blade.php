@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div class="panel">
                <div class="panel-body">
                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="profil_avatar_home center">
                    <h2 class="center"><span>@</span>{{ Auth::user()->name }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel-body">
                <ol class="timeline">
                    <li>
                        <i class="pointer"></i>
                        <div class="unit">
                            <!-- Units -->
                            <div class="actionUnits">
                                <div class="formUnit" id="Status">
                                    <i class="active"></i>
                                    <!-- Ouvre le fomulaire -->
                                {!! Form::open(['url' => 'write']) !!}
                                {!! Form::textarea('post_content', null, ['placeholder' => 'Write only with butter', 'class' => 'sizetop mention','id' => 'comment' ]) !!}

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

                                <p>
                                    {!! $post->post_content !!}
                                </p>

                            </div>
                            <!-- / Story -->

                            <!-- Units -->
                            <ol class="storyActions">
                                <li><a href="#" class="like" name="{{ $post->id }}"><i class="fa fa-heart"></i> {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a></li>
                                @if(Auth::id() == $post->user->id)
                                    <li><a href="#"><i class="fa fa-modx"></i> Modifier</a></li>
                                    <li><a href="/delete/{{ $post->id }}"><i class="fa fa-trash"></i> Delete</a></li>
                                @endif
                                    <li><a class="comment" href="#"><i class="fa fa-comment"></i> Comment</a></li>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                    Other users : <hr>
                @foreach($users as $user)
                    @if(Auth::id() != $user->id)
                        <img src="/uploads/avatars/{{ $user->avatar }}" class="avatar_post">
                        <span>
                            <a href="/profil/{{ $user->id }}"><span>@</span> {!! $user->name !!}</a>
                            @if(!in_array($user->id, $followeds))
                                <form action="/add_follower_from_home" method="POST">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-star"></i></span></button>
                                </form>
                            @else
                                <p><i>You already follow {{ $user->name }}</i></p>
                            @endif
                            <hr>
                        </span>

                    @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var token = '{{ Session::token() }}';
    var urlLike = '{{ route('like') }}';
</script>

@endsection
