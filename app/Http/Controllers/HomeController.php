<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Like;
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

        $followed_user = Follow::where('follower_id', Auth::id())->get();
        $followed_ids = [Auth::id()];

        foreach($followed_user as $followed){

            $followed_ids[] = $followed->followed_id;

        }

        //ORDER BY
        $posts = Post::whereIn('author', $followed_ids)->orderBy('created_at','desc')->get();


        $user = User::all();

        return view('home', ['posts' => $posts, 'users' => $user, 'followeds' => $followed_ids]);
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

        $users = User::all();
        $names_ids = [];

        $content = $post->post_content;

        global $user;

        $user = null;

        foreach ($users as $user)
        {
            $names_ids[$user->name] = $user->id;

            $content = preg_replace_callback('/^@([A-Za-z0-9_]+)/',
                    function ($tab)
                    {
                        global $user;

                        if ($tab[1] == $user->name)
                            return '<a href="'.url('profil', $user->id).'">'.$tab[0].'</a>';
                        else
                            return $tab[0];
                    }
                , $content);
        }

        $post->post_content = $content;

        $post->save();
        Session::flash('alert-success', 'Post successfully added');

        return redirect('home');
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;

        $post = Post::find($post_id);

        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;

    }

    public function add_follower_from_home(Request $request){
        $follow = new Follow;
        $follow->followed_id = $request->user_id;
        $follow->follower_id = Auth::id();
        $follow->save();

        return redirect('home');
    }

    //how to unfollow
    public function del_follower_from_home(Request $request){

        $follow = Follow::where([
            ['follower_id', '=', Auth::id()],
            ['followed_id', '=', $request->user_id],
        ])->first();

        $follow->delete();

        return redirect('home');
    }

    public function delete_post(Request $request, $id){

        $post = Post::where([
            ['author','=',Auth::id()],
            ['id','=',$id],
        ])->first();

        $post->delete();

        return redirect()->back();
    }


}
