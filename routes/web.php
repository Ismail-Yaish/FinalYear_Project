<?php

use App\Http\Controllers\StripeController;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;  
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NotificationController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#laravel.blade.php
Route::get('/', function () {
    return view('welcome');
});

#dashboard.blade.php
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


#edit-profile function (top right of dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

#This line is used to include routes defined in another file called auth.php.
require __DIR__.'/auth.php';


//Voyager admin dashboard
Route::middleware(['auth', 'role:1'])->group(function () {
Route::group(['prefix' => 'admin/dashboard'], function () {
    Voyager::routes();
});
});

/* ROLES:
1 : Admin
2: Normal User / Agent
3: Poster
4: Seeker
*/

//Test Route Dashboard 
// Route::middleware(['auth','role:1'])->group(function () {
//     // Routes accessible only to users with role_id 1 (admin)
//     Route::get('admin/dashboard/test', function () {
//         return view('admin.admin-dashboard');
//     })->name('admin-dashboard');
// });


# Posts - Poster Dashboard
Route::middleware(['auth', 'role:1,2,3'])->group(function () {
    Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
    // Route::get('/posts', 'App\Http\Controllers\PostController@showHeader')->name('show.header');   //Categories in Header


    // Add-Posts Navigation
    Route::get('/posts/create', 'App\Http\Controllers\PostController@add')->middleware(['auth', 'verified', 'role:1,3'])->name('posts.addpost');

    // Store Posts - Save entered data when user clicks edit post
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Edit-Post Navigation
    Route::get('/posts/update', function () {
        return view('posts.editpost');
    })->middleware(['auth', 'verified'])->name('posts.editpost');

    // Route to handle form submission and edit data of posts in the database
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}/update', [PostController::class,'update'])->name('posts.update');

    // Route to handle form deletion to delete data in database
    Route::delete('/posts/{post}/destroy', [PostController::class,'destroy'])->name('posts.destroy');

    // Route to display only posts created by the authenticated user
    Route::get('/posts/myposts', [PostController::class, 'myPosts'])->name('posts.myposts');   

    // Route to display poster profile
    Route::get('/posts/profile', [ProfileController::class, 'PosterProfile'])->name('posts.profile');  

    # My (Poster) Bookings Page (Display only Bookings of the authenticated poster)
    Route::get('posts/bookings', [BookingController::class, 'posterBookings']
     )-> name('posts.poster-bookings');

    # Accept Booking Route
    // Route::get('accept_booking/{id}', [BookingController::class, 'accept_booking']
    // );
    // Add this route for accepting bookings
    Route::post('accept_booking/{id}', [BookingController::class, 'accept_booking'])->name('accept_booking');

    # Reject Booking Route
    Route::get('reject_booking/{id}', [BookingController::class, 'reject_booking']
    );     

    // View Profile of selected Poster
    Route::get('/poster/profile/view/{postId}', [ProfileController::class, 'ProfileView_Poster'])->name('profile.view.poster');

    
    // Route to View Selected Post - from Poster Dashboard
    Route::get('/posts/view/{postId}', [PostController::class, 'view'])->name('posts.view');

    // Route to  view the selected Seeker profile within Poster dashboard
    Route::get('/posts/view-seeker-profile/{bookingId}', [ProfileController::class, 'viewSeekerProfileFromBooking'])->name('posts.view.seeker.profile');

    # Notifications - Mark ALL as Read 
    Route::get('/poster/notifications/markAsRead', [NotificationController::class, 'posterMarkAllNotificationAsRead'])->name('posts.notifications.markAsReadAll');

    # Notifications - Mark individual notification as READ
    Route::get('/poster/notifications/markAsRead/{id}', [NotificationController::class, 'posterMarkIndividualNotificationAsRead'])->name('posts.notifications.markAsReadIndividual');  
    
    # STRIPE - PAYMENT GATEWAY
    Route::get('/posts/checkout/{booking}', [StripeController::class, 'checkout'])->name('checkout');
    Route::post('/posts/session/{booking}', [StripeController::class, 'session'])->name('session');
    Route::get('/posts/success/{booking}', [StripeController::class, 'success'])->name('success');



});


# Seeker Dashboard
Route::middleware(['auth', 'role:1,4'])->group(function () {

    Route::get('/seeker/dashboard', 'App\Http\Controllers\PostController@seeker')->name('seeker.dashboard');
        // return view('seeker.dashboard');

    // Make Booking Navigation
    Route::get('/seeker/make-booking', function () {
        return view('seeker.booking');
    })->middleware(['auth', 'verified'])->name('seeker.booking');

    # Bookings
    Route::post('/seeker/bookings/create/{postId}', [BookingController::class, 'create'])->name('bookings.create');
    // Route::post('/bookings/create/{postId}', function () {
    //     dd('Reached the route definition'); 
    //     // Add the actual method call here
    //     [BookingController::class, 'create'];
    // })->name('bookings.create');
    Route::get('/seeker/make-booking/{postId}', [BookingController::class, 'showBookingForm'])->name('seeker.booking');


    // Edit-Booking Navigation
    Route::get('/seeker/edit-booking', function () {
        return view('seeker.edit-booking');
    })->middleware(['auth', 'verified'])->name('seeker.edit-booking');

    // Route to handle form submission and edit data of bookings in the database
    Route::get('/seeker/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');

    Route::put('/seeker/{booking}/update', [BookingController::class,'update'])->name('bookings.update');

    //  Mark Bookings as Completed
    Route::post('/seeker/bookings/{booking}/markcompleted', [BookingController::class, 'markCompleted'])->name('bookings.markcompleted');


    // Route to handle form deletion to delete data in database
    Route::delete('/seeker/{booking}/destroy', [BookingController::class,'destroy'])->name('bookings.destroy');

    # My (Seeker) Bookings Page (Display only Bookings of the authenticated seeker)
    Route::get('seeker/dashboard/my-bookings', [BookingController::class, 'seekerBookings']
    )-> name('seeker.my-bookings');

    // Route to seeker profile
    Route::get('/seeker/profile', [ProfileController::class, 'SeekerProfile'])->name('seeker.profile');
    
    // Route to seeker profile edit - TEST - NOT FULLY IMPLEMETNED - MAYB LATER
    Route::get('/seeker/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit-profile');   
    

    Route::get('/seeker/profile/view/{postId}', [ProfileController::class, 'ProfileView_Seeker'])->name('profile.view.seeker');

    // Route to View Selected Post - from Seeker Dashboard
    Route::get('/seeker/view/{postId}', [PostController::class, 'viewClientPost'])->name('seeker.view.post');

    // Route to  view the selected Client profile within Seeker dashboard
    // Route::get('/seeker/view-client-profile/{bookingId}', [ProfileController::class, 'viewClientProfileFromBooking'])->name('seeker.view.client.profile');

    # Notifications - Mark ALL as Read 
    Route::get('/seeker/notifications/markAsRead', [NotificationController::class, 'seekerMarkAllNotificationAsRead'])->name('seeker.notifications.markAsReadAll');

    # Notifications - Mark individual notification as READ
    Route::get('/seeker/notifications/markAsRead/{id}', [NotificationController::class, 'seekerMarkIndividualNotificationAsRead'])->name('seeker.notifications.markAsReadIndividual');

    // Add-Skills Navigation
    Route::get('/seeker/add-skills', function () {
        return view('seeker.addskills');
    })->middleware(['auth', 'verified'])->name('seeker.add-skills');    
        
});


