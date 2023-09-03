<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'author_id', 'publish_date'];

    protected $appends = ['author'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function getAuthorAttribute()
    {
        return $this->author()->first(['id', 'name']);
    }
}
