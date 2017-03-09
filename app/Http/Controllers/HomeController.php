<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\User;
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
        //$posts = Post::all();

        //ORDER BY
        $posts = Post::orderBy('created_at','desc')->get();
        return view('home', ['posts' => $posts]);

        $users = User::all();
    }

    /**
     * Write a post to database
     * Récupère la valeur du post et insert
     * @return \Illuminate\Http\Response
     */
    public function write(Request $request)
    {
        $post = new Post();
        $post->post_content = $request->post_content;
        $post->author = Auth::id();
        $post->save();

        Session::flash('alert-success', 'Butter successfully added');

        return redirect('home');
    }
}
