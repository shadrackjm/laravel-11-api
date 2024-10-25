<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];
    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    function comment(){
        return $this->belongsTo(Comment::class,'user_id');
    }

    function likes(){
        return $this->belongsTo(Like::class,'user_id');
    }
}
