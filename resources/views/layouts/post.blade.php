@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card card-body bg-light">
            <div class="card-block">
                <div class="media">
                    <div class="media-body">
                        <h1 class="media-heading">{{$thread->title}}</h1>
                        <p class="text-right">By {{$thread->user->name}}</p>
                        <p >{{$thread->body}}</p>
                        <ul class="list-inline list-unstyled">
                            <li  class="list-inline-item"><span>{{$thread->created_at->diffForHumans()}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        @forelse($thread->posts as $post)
        <br/>
            <div class="card card-body bg-light">
                <div class="media">
                    <div class="media-body">
                        <p class="text-right">By {{$post->user->name}}</p>
                        <p >{{$post->body}}</p>
                        <ul class="list-inline list-unstyled">
                            <li  class="list-inline-item"><span>{{$post->created_at->diffForHumans()}}</span></li>
                            <li  class="list-inline-item">|</li>
                            @auth
                                @if(Auth::user()->id==$post->user_id)
                                    <li  class="list-inline-item"><span><a href="{{route('get_edit_post',['id'=>$post->id])}}">Edit</a></span></li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
                @auth
                @if(Auth::user()->id==$post->user_id)
                    {!!Form::open(['route'=>'delete_post','id' => 'delete-post-form', 'method'=>'DELETE', 'class'=>'text-right'])!!}
                    {!! Form::hidden('post_id',$post->id) !!}
                    
                    {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                    {!! Form::close() !!}
                @endif
                @endauth
            </div>
        @empty
            <p>Be the first to reply!</p>
        @endforelse
        <br/>
        @auth
            {!!Form::open(['route'=>'save_post','id' => 'post-question-form'])!!}

                {!! Form::hidden('slug','$thread->slug')!!}
                {!! Form::hidden('thread_id',$thread->id) !!}
                {!! Form::textarea('body',null, ['id' => 'body', 'class' => 'form-control','placeholder'=>'Type your comment here.','required']) !!}
                <br/>
                {!! Form::button('Comment', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']) !!}

            {!! Form::close() !!}
        @endauth
    </div>
@endsection