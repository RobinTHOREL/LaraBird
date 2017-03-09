<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Write a post to database
     *
     * @return \Illuminate\Http\Response
     */
    public function write(Request $request)
    {
        $post = new Post;
        $post->post_content = $request->post_content;
        $post->author = Auth::id();
        $post->save();
        Session::flash('alert-success', 'Post successfully added');

        return redirect('home');
    }
}
