<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait; // add this trait to your user model
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','slug','bio'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gravatar(){
        $email = $this->email;
        $default = "https://image.flaticon.com/icons/svg/149/149071.svg";
        $size = 110;
        return $default;//"https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }

    public function posts(){
        return $this->hasMany(Post::class,'author_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
