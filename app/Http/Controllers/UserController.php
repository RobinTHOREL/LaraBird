<?php

namespace App\Http\Controllers;

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

        return view('profil', ['user_id' => $user_id, 'user' => $user, 'posts' => $posts]);
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
        }

        return view('profil', array('user' => Auth::user()) );

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
}
