<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;


class Category extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
