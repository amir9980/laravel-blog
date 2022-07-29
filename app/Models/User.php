<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'is_active',
        'role_id',
        'email',
        'password',
        'profile_image',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Bookmark::class, "bookmarks", "user_id", "article_id");
    }

    public function user_bookmarks()
    {
        return $this->hasMany(Bookmark::class, "user_id", "id");
    }

    public function likes()
    {
        return $this->belongsToMany(Like::class, "likes", "user_id", "article_id");
    }
    public function user_likes()
    {
        return $this->hasMany(Like::class, "user_id");
    }
    public function notifications()
    {
        return $this->morphMany(Notification::class,'notifiable');
    }

}
