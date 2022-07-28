<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $table = "bookmarks";
    protected $fillable = ['user_id', 'article_id'];
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo(Article::class,'article_id');
    }

}
