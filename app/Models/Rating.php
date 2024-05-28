<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'poster_id',
        'seeker_id',
        'rating',
        'comment',
    ];

    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }
}
