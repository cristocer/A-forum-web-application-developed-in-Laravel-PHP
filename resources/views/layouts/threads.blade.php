@extends('layouts.app')
@section('content')
    <div class="container">
        @forelse($threads as $thread)
        <br/>
            <div class="card card-body bg-light">
                <div class="card-block">
                <div class="media">
                    <img class="mr-3" src="{{asset($thread->image)}}" style="height:60px;width:60px;border-radius:50%;margin-right:15px;" alt="Generic placeholder image">
                    <div class="media-body">
                    <h1 class="media-heading"><a href="question/{{$thread->slug}}">{{$thread->title}}</a></h1>
                        <p class="text-right">By {{$thread->user->name}}</p>
                        <ul class="list-inline list-unstyled">
                            @foreach($thread->tags as $tag)
                                <li class="list-inline-item">{{ $tag->name }}</li>
                            @endforeach
                        </ul>
                        <ul class="list-inline list-unstyled">
                            <li  class="list-inline-item"><span>{{$thread->created_at->diffForHumans()}}</span></li>
                            <li  class="list-inline-item">|</li>
                            @if($thread->posts->count()>0)
                                <li  class="list-inline-item">{{$thread->posts->count()}} comment(s)</li>
                            @else
                                <li  class="list-inline-item">Be the first to reply!</li>
                            @endif
                            <li  class="list-inline-item">|</li>
                            @auth
                                @if(Auth::user()->id==$thread->user_id)
                                    <li  class="list-inline-item"><span><a href="{{route('get_edit_thread',['id'=>$thread->id])}}">Edit</a></span></li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
                @auth
                    @if(Auth::user()->id==$thread->user_id)
                        {!!Form::open(['route'=>'delete_question','id' => 'delete-question-form', 'method'=>'DELETE', 'class'=>'text-right'])!!}
                        {!! Form::hidden('thread_id',$thread->id) !!}
                        
                        {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                        {!! Form::close() !!}
                    @endif
                @endauth
                </div>
            </div>
        @empty
            <p>No threads found</p>
        @endforelse
        <br/>
        {!!$threads->appends(Request::all())->render()!!}
    </div>
@endsection