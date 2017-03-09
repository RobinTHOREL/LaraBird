@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div class="panel">
                <div class="panel-body">
                    <!-- Ouvre le fomulaire -->
                {!! Form::open(['url' => 'write']) !!}
                {!! Form::text('post_content', null, ['placeholder' => 'Write only with butter']) !!}
                {!! Form::submit('Publish ur own butter') !!}
                <!-- Ferme le formulaire -->
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel">
                <div class="panel-body">
                    All users : <br>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
