<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'slug'];
    
    public function posts()
    {
        return $this->hasmany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
