<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function profile($request = null){

        if ($request === null)
            $user_id = Auth::id();
        else
            $user_id = $request;

        $user = User::findOrFail($user_id);

        //ORDER BY
        $posts = Post::orderBy('created_at','desc')->where('author', $user_id)->get();

        $follow = Follow::where('follower_id', Auth::id())->get();

        foreach($follow as $followed){
            if($followed->followed_id == $user_id)
                $isFollowed = true;
            else
                $isFollowed = false;
        }

        $nbfollowers = Follow::all()->where('followed_id', $user_id)->count();
        $nbfolloweds = Follow::all()->where('follower_id', $user_id)->count();

        return view('profil', ['user_id' => $user_id, 'user' => $user, 'posts' => $posts, 'isFollowed' => $isFollowed,
        'nbfollowers' => $nbfollowers, 'nbfolloweds' => $nbfolloweds]);
    }

    public function update_avatar(Request $request){

        // Si la demande contient le fichier "avatar"
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            //Création d'un name unique
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            //Resize de l'image en 300x300, enregistrement
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            //ORDER BY
            $posts = Post::orderBy('created_at','desc')->where('author', Auth::id())->get();
        }

        return view('profil', array('user' => Auth::user(), 'user_id' => Auth::id(), 'posts' => $posts) );

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

        return redirect('profil');
    }

    public function add_follower(Request $request){
        $follow = new Follow;
        $follow->followed_id = $request->user_id;
        $follow->follower_id = Auth::id();
        $follow->save();

        return redirect('profil/'.$request->user_id);
    }

    //how to unfollow
    public function del_follower(Request $request){

        $follow = Follow::where([
            ['follower_id', '=', Auth::id()],
            ['followed_id', '=', $request->user_id],
        ])->first();

        $follow->delete();

        return redirect('profil/'.$request->user_id);
    }

    public function settings(Request $request){

        $user = User::findOrFail(Auth::id());

        return view('settings', ['user' => $user]);
    }

    public function update_settings(Request $request){

        User::where('id', Auth::id())
            ->update(['password' => bcrypt($request->password)]);

        return redirect()->back();

    }

    public function list_followers($request = false){

        $user_id = $request;

        $user = User::findOrFail($user_id);

        $follow = Follow::where('follower_id', Auth::id())->get();

        $nbfollowers = Follow::all()->where('followed_id', $user_id)->count();
        $nbfolloweds = Follow::all()->where('follower_id', $user_id)->count();

        return view('followers', ['user_id' => $user_id, 'user' => $user,
            'nbfollowers' => $nbfollowers, 'nbfolloweds' => $nbfolloweds, 'follow' => $follow]);
    }

    public function list_followeds($request = false){
        $user_id = $request;

        $user = User::findOrFail($user_id);

        $follow = Follow::where('follower_id', Auth::id())->get();

        $nbfollowers = Follow::all()->where('followed_id', $user_id)->count();
        $nbfolloweds = Follow::all()->where('follower_id', $user_id)->count();

        return view('followeds', ['user_id' => $user_id, 'user' => $user,
            'nbfollowers' => $nbfollowers, 'nbfolloweds' => $nbfolloweds, 'follow' => $follow]);
    }
}
