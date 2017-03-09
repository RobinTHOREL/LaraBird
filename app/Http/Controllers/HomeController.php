<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
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
        //SELECT *
        // $posts = Post::all();

        $isFollowed = false;


        $follow = Follow::where('follower_id', Auth::id())->get();
        $followed_ids = [];

        foreach($follow as $followed){
            if($followed->followed_id == Auth::id())
                $isFollowed = true;
            else
                $isFollowed = false;
        }

        //ORDER BY
        $posts = Post::orderBy('created_at','desc')->get();
        $user = User::all();

        return view('home', ['posts' => $posts, 'users' => $user, 'isFollowed' => $isFollowed]);
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
