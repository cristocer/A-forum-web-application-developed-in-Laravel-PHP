@extends('layouts.app')

@section('content')
    <div class="container">

        @include('layouts.form_errors')

        {!!Form::model($thread, ['route'=>'edit_thread','id' => 'edit-thread-form'])!!}

            {!! Form::hidden('thread_id',$thread->id)!!}
            {!! Form::label('title','Title')!!}
            {!! Form::text('title',null, ['id' => 'title', 'class' => 'form-control','placeholder'=>'Title','required']) !!}
            <br/>
            {!! Form::label('category','Category')!!}
            <select name="category" class="form-control">
                @foreach($categories as $category)
                    @if($category->id==$thread->category_id)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif

                @endforeach
            </select>
            <br/>
            {!! Form::label('body','Body')!!}
            {!! Form::textarea('body',null, ['id' => 'body', 'class' => 'form-control','placeholder'=>'What is your question?','required']) !!}
            <br/>
            {!! Form::button('Post', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']) !!}

        {!! Form::close() !!}
    </div>

@endsection