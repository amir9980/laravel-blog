<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
      'title',
      'slug',
      'parent_id',
      'articles_count'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }


    //child category:
    public function category()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
}
