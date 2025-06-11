<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $guarded = [];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
