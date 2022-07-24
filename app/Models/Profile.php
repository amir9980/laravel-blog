<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'articles_count',
        'bio',
        'social_media',
        'likes'
    ];

    protected $casts = [
      'social_media' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
