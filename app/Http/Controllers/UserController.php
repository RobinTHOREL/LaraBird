<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function profile($request = null){

        if ($request === null)
            $user_id = Auth::id();
        else
            $user_id = $request;

        $user = User::findOrFail($user_id);

        return view('profil', ['user_id' => $user_id, 'user' => $user]);
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
}