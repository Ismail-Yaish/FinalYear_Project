<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RatingNotification;

class RatingController extends Controller
{
    public function store(Request $request, User $seeker)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $rating =Rating::create([
            'poster_id' => Auth::id(),
            'seeker_id' => $seeker->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);


        // Notify the seeker of the rating given
        $seeker->notify(new RatingNotification($rating));

        return redirect()->route('posts.ratings.show', ['seeker' => $seeker->id])->with('success', 'Rating submitted successfully');
    }

    public function show(User $seeker)
    {
        $ratings = $seeker->ratingsReceived()->with('poster')->get();

        return view('posts.ratings', compact('seeker', 'ratings'));
    }


    # For Seeker Dashboard
    public function show_ratings_seeker(User $seeker)
    {
        $ratings = $seeker->ratingsReceived()->with('poster')->get();

        return view('seeker.your-ratings', compact('seeker', 'ratings'));
    }
}
