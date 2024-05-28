<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use  Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    //NEW
    protected $fillable = [
        "name",
        "email",
        "phone",
        "address",
        "password",
        "role_id",

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    public function isAdmin()
    {
        return $this->role_id === 1;
    }


    # RATINGS RELATED:

    public function ratingsGiven()
    {
        return $this->hasMany(Rating::class, 'poster_id');
    }

    public function ratingsReceived()
    {
        return $this->hasMany(Rating::class, 'seeker_id');
    }
}
