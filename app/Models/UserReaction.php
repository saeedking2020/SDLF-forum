<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReaction extends Model
{
    protected $fillable = [
        'user_id',
        'reply_id',
        'like_dislike'
    ];
}
