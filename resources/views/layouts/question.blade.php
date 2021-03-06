@extends('layouts.app')

@section('content')
    <div class="container">

        @include('layouts.form_errors')
        
        {!!Form::open(['id' => 'thread-question-form','files'=> true])!!}

            {!! Form::label('title','Title')!!}
            {!! Form::text('title',null, ['id' => 'title', 'class' => 'form-control','placeholder'=>'Title','required']) !!}
            <br/>
            {!! Form::label('category','Category')!!}
            <select name="category" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <br/>
            {!! Form::label('tag','Multiple tags select (hold ctrl key)')!!}
            {!! Form::select('tag[]', $tags, old('tag'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-tag' ]) !!}
            <br/>
            {!! Form::label('body','Body')!!}
            {!! Form::textarea('body',null, ['id' => 'body', 'class' => 'form-control','placeholder'=>'What is your question?','required']) !!}
            <br/>
            {{Form::label('photo', 'User Photo',['class' => 'control-label'])}}
            <br/>
            {!! Form::file('photo')!!}
            <br/>
            <br/>
            <br/>
            {!! Form::button('Post', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']) !!}

        {!! Form::close() !!}
    </div>

@endsection