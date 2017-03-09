<?php

namespace App;

use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author');
    }

    public function followers()
    {
        return $this->belongsToMany('User', 'follow', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany('User', 'follow', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function likes()
    {
        return $this->hasMany("app\Like");
    }


}
