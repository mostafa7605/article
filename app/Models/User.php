<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'uid',
        'first_name',
        'last_name',
        'gender',
        'phone',
        'username',
        'cover',
        'facebookname',
        'twittername',
        'instagramname',
        'last_login',
        'bio',
        'google_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'gender' => 'integer',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function bookmark_article()
    {
        return $this->hasMany(\App\Models\Bookmark::class);
    }

    public function devices()
    {
        return $this->hasMany(\App\Models\DeviceToken::class);
    }
    public function articales()
    {
        return $this->hasMany(\App\Models\Article::class);
    }

    public function tagged_articles()
    {

        return $this->belongsToMany(\App\Models\Article::class, 'tagged_people', 'user_id', 'article_id');
    }


    public function relationships_following()
    {
        return $this->belongsToMany(\App\Models\User::class, "follower", "user_id", "follow_id");
    }
    public function relationships_followers()
    {
        return $this->belongsToMany(\App\Models\User::class, "follower", "follow_id", "user_id");
    }
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}
