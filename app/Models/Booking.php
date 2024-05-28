<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use App\Models\JobPoster;
use TCG\Voyager\Models\DataType as VoyagerDataType;
use App\Models\Post;

class Booking extends Model
{
    use HasFactory;


    protected $table = 'bookings';

    protected $fillable = [
        'poster_id',
        'seeker_id',
        'post_id',
        'status',
        'offer_price',
        'accepted_price',
        'decline_reason', #Newly added column
        'booking_date',
        'description',
        'address',

    ];

    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }


    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
