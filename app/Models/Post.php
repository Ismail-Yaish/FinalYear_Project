<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    protected $table = 'posts'; // Specify the database table associated with this model

    protected $fillable = ['title', 'body', 'status', 'category_id', 'author_id']; // Specify the fields that can be mass-assigned

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define additional methods for querying or manipulating posts
    public function scopePublished($query)
    {
        // return $query->where('published', true);
        return $query->where('status','ACTIVE');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
