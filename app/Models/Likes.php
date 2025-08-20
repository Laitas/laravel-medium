<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function likes()
    {
        return $this->belongsTo(Post::class);
    }
}
