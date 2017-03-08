@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome Butter</div>

                <div class="panel-body">
                    <!-- Ouvre le fomulaire -->
                    {!! Form::open(['url' => 'write']) !!}
                    {!! Form::text('post_content', null, ['placeholder' => 'Write only with butter']) !!}
                    {!! Form::submit('Publish ur own butter') !!}
                    <!-- Ferme le formulaire -->
                    {!! Form::close() !!}
                </div>

                <div class="panel-body">
                   All posts : <br>
                    @foreach($posts as $post)
                        <div class="post">
                            <b>{!! $post->user->name !!}</b> wrotes {!! $post->created_at->diffForHumans() !!} : <br>
                            {!! $post->post_content !!} <hr>
                        </div>
                    @endforeach
                </div>

                <div class="panel-body">
                   {!! count(Auth::user()->posts) !!} posts written
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
