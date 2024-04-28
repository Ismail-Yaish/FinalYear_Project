<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    //Loads authentication 
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Http\Controllers\BookingController;

use App\Models\User;
use App\Models\Post;
use App\Models\Booking;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);

        // TEST
        // return view('profile.edit-profile', [
        //     'user' => $request->user(),
        // ]);
    }

    /**
     * Update the user's profile information (OLD)
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('seeker.profile')->with('status', 'Your Profile has been Updated!');
    // }
    
    // NEW UPDATE FUNCTION WITH ROLE
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Fill the user's attributes with validated data from the request
    $user->fill($request->validated());

    // If the email is updated, unset the email verification
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Save the changes to the user model
    $user->save();

    // Determine the redirect route based on the user's role_id
    $redirectRoute = match ($user->role_id) {
        3 => route('posts.profile'), // Poster
        4 => route('seeker.profile'), // Seeker
        default => route('dashboard'), // Default fallback route
    };

    // Redirect the user to the appropriate route
    return Redirect::to($redirectRoute)->with('status', 'Your Profile has been Updated!');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse     // Destroy Profile
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/dashboard');
    }

    public function PosterProfile()       // Function to view the Profile of the Authenticated Seeker
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view ('posts.poster-profile-view',compact('profileData'));
    }

    public function SeekerProfile()     // Function to view the Profile of the Authenticated Seeker
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view ('seeker.seeker-profile-view',  compact('profileData'));
    }

    public function ProfileView_Seeker($postId = null)    
    {
        // If $postId is null, it means the seeker is viewing their own profile
        if (!$postId) {
            // Retrieve the authenticated user's profile data
            $profileData = Auth::user();
    
            // Return the view with the seeker's profile data
            return view('seeker.seeker-profile-view', compact('profileData'));
        }
        
        // Retrieve the post based on the provided author ID
        $post = Post::where('author_id', $postId)->first();
    
        // Check if the post exists
        if ($post) {
            // Retrieve the user who created the post
            $poster = $post->author;
            
            // Check if the retrieved user exists and has the role of a poster
            if ($poster && in_array($poster->role_id, [1, 2, 3])) {
                // Retrieve profile data of the poster
                $profileData = $poster;
    
                // Retrieve the booking related to the post
                $booking = Booking::where('post_id', $post->id)->first();
    
                // Return the view with the poster's profile data and booking information
                return view('seeker.seeker-profile-view', compact('profileData', 'booking'));
            } else {
                // Redirect or display an error message if the user is not a poster
                return redirect()->route('seeker.dashboard')->with('error', 'The specified user is not a poster.');
            }
        } else {
            // Redirect or display an error message if the post does not exist
            return redirect()->route('seeker.dashboard')->with('error', 'The specified post does not exist.');
        }
    }

    public function ProfileView_Poster($postId)     // Function to view the profile of the poster who posted the post in poster dashboard
    {
        // Retrieve the post based on the provided author ID
        $post = Post::where('author_id', $postId)->first();
    
        // Check if the post exists
        if ($post) {
            // Retrieve the user who created the post
            $poster = $post->author;
            
            // Check if the retrieved user exists and has the role of a poster
            if ($poster && in_array($poster->role_id, [1, 2, 3])) {
                // Retrieve profile data of the poster
                $profileData = $poster;
    
                // Return the view with the poster's profile data
                return view('posts.poster-profile-view', compact('profileData'));
            } else {
                // Redirect or display an error message if the user is not a poster
                return redirect()->route('posts.index')->with('error', 'The specified user is not a poster.');
            }
        } else {
            // Redirect or display an error message if the post does not exist
            return redirect()->route('posts.index')->with('error', 'The specified post does not exist.');
        }
    }

    public function viewSeekerProfileFromBooking($bookingId)    // View the profile of Seeker in Booking Tab from Poster Dashboard
    {
        // Retrieve the booking
        $booking = Booking::findOrFail($bookingId);
        
        // Retrieve the seeker who made the booking
        $seeker = $booking->seeker;
        
        // Check if the seeker exists
        if (!$seeker) {
            return response()->json(['error' => 'Seeker not found'], 404);
        }
        
        // Retrieve the associated user data
        $profileData = $seeker;

        // Debug
        // dd($profileData);
        
        return view('posts.seeker-profile-view', compact('profileData'));
    }

    // public function viewClientProfileFromBooking($bookingId)  // View the profile of Poster(Client) in Booking Tab from Seeker Dashboard - REDACTED
    // {
    //     // Retrieve the booking
    //     $booking = Booking::findOrFail($bookingId);
        
    //     // Retrieve the seeker who made the booking
    //     $poster = $booking->poster;
        
    //     // Check if the poster exists
    //     if (!$poster) {
    //         return response()->json(['error' => 'poster not found'], 404);
    //     }
        
    //     // Retrieve the associated user data
    //     $profileData = $poster;

    //     // Debug
    //     // dd($profileData);
        
    //     return view('seeker.seeker-profile-view', compact('profileData'));
    // }


}
