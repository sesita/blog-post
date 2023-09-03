<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'route',
    ];
    
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

}
