<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Thread;

class PagesController extends Controller
{
    public function home(){
        $threads=Thread::orderBy('created_at','desc')->paginate(5);
        return view('layouts.threads',compact('threads'));
    }
}
