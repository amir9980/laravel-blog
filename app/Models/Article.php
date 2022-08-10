<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'body',
        'slug',
        'likes',
        'thumbnail',
        'tags',
        'is_active'
    ];

    protected $casts = [
        'tags'=>'json'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'article_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'article_id');
    }

}
