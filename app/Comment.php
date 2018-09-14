<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function poste()
    {
        return $this->belongsTo(Post::class);
    }
}
