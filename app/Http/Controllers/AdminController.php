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

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $threads=Thread::orderBy('created_at','desc')->paginate(5);
        return view('layouts.admin',compact('threads'));
    }
    public function deleteAdminQuestion(Request $request){
        try{
            $thread=Thread::findOrFail($request['thread_id']);
            $thread->delete();
            Alert::success('Question deleted successfully!', 'Good job!');
            return redirect()->back();

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
    }
    public function deleteAdminPost(Request $request){
        try{
            $post=Post::findOrFail($request['post_id']);
            $post->delete();
            Alert::success('Comment deleted successfully!', 'Good job!');
            return redirect()->back();

        }catch(ModelNotFoundException $ex){
            return redirect('/');
        }
    }
}
