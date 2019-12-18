@extends('layouts.app')

@section('content')
    <div class="container">

        @include('layouts.form_errors')

        {!!Form::model($post, ['route'=>'edit_post','id' => 'edit-post-form'])!!}

            {!! Form::hidden('post_id',$post->id)!!}
            <br/>
            {!! Form::label('body','Body')!!}
            {!! Form::textarea('body',null, ['id' => 'body', 'class' => 'form-control','placeholder'=>'What is your reply?','required']) !!}
            <br/>
            {!! Form::button('Post', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']) !!}

        {!! Form::close() !!}
    </div>

@endsection