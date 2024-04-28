<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Post;
use App\Models\Booking;
use App\Models\JobPoster;

use App\Http\Controllers\PostController;

use App\Notifications\BookingCreated;
use App\Notifications\BookingMade;
use App\Notifications\BookingAccepted;
use App\Notifications\BookingRejected;


class BookingController extends Controller
{
    // Create a new Booking Req
    public function create(Request $request, $postId)
    {
        // debugging line
        // dd($request->all());

        // Find the post
        $post = Post::findOrFail($postId);

        // Manually validate the request data
        if (!$request->has('status')) {
            // Handle absence of status field (e.g., set a default value)
            $request->merge(['status' => 'pending']);
        }

        // Validate the incoming request
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'status' => 'required|in:PENDING,ACCEPTED,DECLINED,TASK-COMPLETED,CANCELLED',
            'offer_price' => 'required|numeric',
            'accepted_price' => 'nullable|numeric',
            'booking_date' => 'required|date',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
        ]);


        // Determine the poster_id based on the role
        $posterId = $post->author_id;       

        // Determine the seeker_id based on the role
        $seekerId = Auth::id(); // Assuming the seeker is the authenticated user


        // Create Booking instance
        $booking = new Booking([
            'offer_price' => $request->offer_price,
            'booking_date' => $request->booking_date,
            'description' => $request->description,
            'status' => $request->status,
            'post_id' => $request->post_id,
            'poster_id' => $posterId,
            'seeker_id' => $seekerId,
        ]);

        // Save the booking to the database
        $booking->save();

        // Flash success message to session
        Session::flash('success', 'Booking successfully created. Your Client has been Notified!');



        // Notify the author of the job post
        $user = User::find($posterId); // Assuming $posterId is the user's ID
        $user->notify(new BookingMade($booking));
        $notifications = $user->notifications;
        

        // Redirect back to the seeker dashboard with success message
        return redirect()->route('seeker.dashboard')->with(compact('notifications'));
    }

    //Booking Form
    public function showBookingForm($postId)
    {
        $post = Post::findOrFail($postId);
        return view('seeker.booking', compact('post'));
    }

    public function edit($id)
    {
        // Find the booking by its ID
        $booking = Booking::findOrFail($id);
    
        // Check if the authenticated user is the author of the booking
        if(Auth::user()->id !== $booking->seeker_id) {
            // Redirect unauthorized users
            return redirect()->route('seeker.my-bookings')->with('error', 'You are not authorized to edit this booking.');
        }
        
        // Pass the $booking variable to the view
        return view('seeker.edit-booking', compact('booking'));
    }
    

    public function update(Request $request, Booking $booking)   # Save Edited Booking - update in DB
    {
        // $booking = Booking::findOrFail($booking);

        // Check if the authenticated user is the author of the booking
        if(Auth::user()->id !== $booking->seeker_id) {
            // Redirect unauthorized users
            return redirect()->route('seeker.my-bookings')->with('error', 'You are not authorized to edit this booking. ');
        }

        // Validation
        $data = $request->validate([
            'offer_price'=> 'required',
            'booking_date'=> 'required',
            'description' => 'required',
            'status'=> 'nullable',
        ]);

        $booking->update($data);

        return redirect(route('seeker.my-bookings'))->with('success', 'Booking Updated Successfully!');

        

    }

    public function markCompleted($booking) #Change status of booking to Task-Completed
    {
        $booking = Booking::findOrFail($booking);
        
        // Check if the authenticated user is the seeker of the booking
        if(Auth::user()->id !== $booking->seeker_id) {
            // Redirect unauthorized users
            return redirect()->route('seeker.my-bookings')->with('error', 'You are not authorized to mark this booking as completed.');
        }
    
        // Update the status of the booking to COMPLETED
        $booking->status = 'TASK-COMPLETED';
    
        // Save the changes
        $booking->save();
    
        return redirect()->back()->with('success', 'You have marked TASK-COMPLETED. Client will be notified to make payment');
    }

    public function destroy(Booking $booking)   # Destroy / Remove / Cancel Booking
    {
        // Check if the authenticated user is the author of the post
        if(Auth::user()->id !== $booking->seeker_id) {
            // Redirect unauthorized users
            return redirect()->route('seeker.my-bookings')->with('error', 'You are not authorized to delete this post. ');
        }

        // Delete Post
        $booking->delete();
        return redirect(route('seeker.my-bookings'))->with('success', 'Booking Deleted Successfully!');
    }



    public function seekerBookings()    //Authenticate Seeker Bookings
    {
        // Retrieve bookings created by the authenticated user
        $bookings = Booking::where('seeker_id', Auth::id())->get();

        // Retrieve all posts from Voyager's `posts` table using the Post model
        $posts = Post::get(); // Retrieve Category Name instead of ID

        // $bookings = JobPoster::whereHas('clients')->get();

        // Retrieve notifications for the authenticated user
        $notifications = Auth::user()->notifications;
        
        return view('seeker.my-bookings', ['bookings' => $bookings, 'posts' => $posts,'notifications' => $notifications]);
    }

    public function posterBookings()    //Authenticate Poster Bookings
    {
        // Retrieve bookings created by the authenticated user
        $bookings = Booking::where('poster_id', Auth::id())->get();

        // Retrieve all posts from Voyager's `posts` table using the Post model
        $posts = Post::get(); // Retrieve Category Name instead of ID

        // $bookings = JobPoster::whereHas('clients')->get();
        
        return view('posts.poster-bookings', ['bookings' => $bookings, 'posts' => $posts]);
    }

    public function accept_booking(Request $request, $id)
    {
        // Find the booking by its ID
        $data = Booking::findOrFail($id);
    
        // Check if the authenticated user is the poster of the booking
        if(Auth::user()->id !== $data->poster_id) {
            // Redirect unauthorized users
            return redirect()->back()->with('error', 'You are not authorized to accept this booking.');
        }
    
        // Update the status of the booking to ACCEPTED
        $data->status = 'ACCEPTED';
    
        // Check if accepted price is provided
        if ($request->has('accepted_price')) {
            $data->accepted_price = $request->accepted_price;
        }

        // Validate the request data
        $request->validate([
            'accepted_price' => 'required|numeric|between:0,9999999.99',
        ]);

        // Save the accepted booking status and accepted price
        $data->save();
    
        // Notify the seeker that their booking has been accepted
        $data->seeker->notify(new BookingAccepted($data));

        return redirect()->back()->with('accepted', 'You Have Accepted Your Booking! Your Tasker has been Notified.');
    }

    public function reject_booking($id) //Reject Booking Function
    {
        $data = Booking::find($id);

        $data->status='DECLINED';

        // Set the accepted_price to null
        $data->accepted_price = null;

        $data->save();

        // Notify the seeker that their booking has been rejected
        $data->seeker->notify(new BookingRejected($data));

        return redirect()->back()->with('declined', 'You Have Declined your Booking. Your Tasker has been Notified.');
    }
}























// OLD


// {
//     // Create a new Booking Req
//     public function create(Request $request, $postId)
//     {
//          // Display the contents of the request for debugging
//          dd($request->all());  

        
//         // Find the post
//         $post = Post::findOrFail($postId);

//         // Determine the poster_id based on the role
//         $posterId = Auth::user()->role_id === 3 ? Auth::id() : $post->user_id;

//         // Determine the seeker_id based on the role
//         $seekerId = Auth::user()->role_id === 4 ? Auth::id() : null;

//         //Validate the incoming request
//         $request->validate([
//             // 'poster_id' => 'required|exists:users,id',
//             // 'seeker_id' => 'required|exists:users,id',
//             'post_id' => 'required|exists:posts,id',
//             'status' => 'required|in:pending,accepted,declined',
//             'offer_price' => 'required|numeric',
//             'accepted_price' => 'nullable|numeric',
//             'booking_date' => 'required|date',
//             'description' => 'nullable|string',
//             'address' => 'nullable|string',
//             // Addtional validation if needed
//         ]);


//         //Create Booking instance
//         $booking = new Booking([
//             'offer_price' => $request->offer_price,
//             'booking_date' => $request->booking_date,
//             'description' => $request->description,
//             'status' => 'pending',
//             'post_id' => $postId, // Correct variable name
//             'poster_id' => $posterId,
//             'seeker_id' => $seekerId,
//             // 'user_id' => Auth::id(), // Set the user_id as the currently authenticated user
//         ]);

//         // Save the booking to the database
//         $booking->save();
        
//         // Redirect or return a response
         
//     }

//     //Booking Form
//     public function showBookingForm($postId)
//     {
//         $post = Post::findOrFail($postId);
//         return view('seeker.booking', compact('post'));
//     }


// }