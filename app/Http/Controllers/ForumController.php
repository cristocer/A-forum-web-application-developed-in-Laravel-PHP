<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Tag;
use App\Thread;
use App\Post;
use App\Http\Requests\CreateThreadRequest;
use App\Http\Requests\CreatePostRequest;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\UploadedFile;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['viewThread']]);
    }
    public function getThread(){

        $categories=Category::all();
        //$tags=Tag::all();
        $tags = \App\Tag::get()->pluck('name', 'id');
        return view('layouts.question',compact('categories','tags'));
    }
    public function postQuestion(CreateThreadRequest $request){

        $thread = new Thread();
        $thread->user_id=$request->user()->id;
        //$thread->user_id=Auth::user()->id;
        $thread->category_id=$request['category'];
        $thread->title=$request['title'];
        $thread->body=$request['body'];
        request()->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:19048',
        ]);
        if($request->photo=null){
            $file =$request->photo;
            $photoName = time().'.'.$file->getClientOriginalExtension() ;
            $file->move(public_path('images'), $photoName);
            $thread->image='images/'.$photoName;
        }else{
            $thread->image='images/animal.jpg';
        }
        $thread->save();
        $thread->tags()->sync((array)$request->input('tag'));
        Alert::success('Question submitted!', 'Good job!');
        return redirect('/');
    }
    public function viewThread($slug){
        try{
            $thread=Thread::where('slug','=',$slug)->first();
            return view('layouts.post',compact('thread'));

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
        
    }
    public function savePost(CreatePostRequest $request){
        $thread=Thread::where('slug','=',$request['slug']);
        if($thread){
            $post = new Post();
            $post->thread_id=$request->input('thread_id');
            $post->user_id=$request->user()->id;
            //$post->user_id=Auth::user()->id;
            $post->body=$request['body'];
            $post->save();
            Alert::success('Comment submitted!', 'Good job!');
            return redirect()->back();
        }
        return redirect('/');
    }
    public function deleteQuestion(Request $request){
        try{
            $thread=Thread::findOrFail($request['thread_id']);
            if(Auth::user()->id==$thread->user_id){
                $thread->delete();
                Alert::success('Question deleted successfully!', 'Good job!');
            }
            return redirect()->back();

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
    }
    public function deletePost(Request $request){
        try{
            $post=Post::findOrFail($request['post_id']);
            if(Auth::user()->id==$post->user_id){
                $post->delete();
                Alert::success('Comment deleted successfully!', 'Good job!');
            }
            return redirect()->back();

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
    }
    public function getEditThread($id){
        try{
            $thread=Thread::findOrFail($id);
            if(Auth::user()->id==$thread->user_id){
               $categories=Category::all();
               return view('layouts.edit_thread',compact('thread','categories'));
            }
            return redirect()->back();

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
    }
    public function saveEditThread(CreateThreadRequest $request){
        try{
            $thread=Thread::findOrFail($request['thread_id']);
            if(Auth::user()->id==$thread->user_id){
                $thread->category_id=$request['category'];
                $thread->title=$request['title'];
                $thread->body=$request['body'];
                $thread->save();
                Alert::success('Question updated successfully!', 'Good job!');
                return redirect('/');
            }

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
    }
    public function getEditPost($id){
        try{
            $post=Post::findOrFail($id);
            if(Auth::user()->id==$post->user_id){
               return view('layouts.edit_post',compact('post'));
            }
            return redirect()->back();

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
    }
    public function saveEditPost(CreatePostRequest $request){
        try{
            $post=Post::findOrFail($request['post_id']);
            if(Auth::user()->id==$post->user_id){
                $post->body=$request['body'];
                $post->save();
                Alert::success('Post updated successfully!', 'Good job!');
                return redirect('/');
            }

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
    }
}
