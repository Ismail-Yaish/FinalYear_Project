<!DOCTYPE html>
<html lang="en">
<head>
	{{-- Include meta tags --}}
	@include('seeker.layouts.meta')
	
    {{-- Include Boostrap --}}
    @include('seeker.layouts.bootstrap')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>


	{{-- Include CSS Styles --}}
	@include('seeker.layouts.styles')

    {{-- Include flatpickr CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <title>Seeker Dashboard</title>

</head>


<body>

    {{-- Include Navbar --}}
    @include ('seeker.layouts.navbar')


    {{-- Success Message on Edit --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fixed-top w-100" role="alert" id="successAlert">
        {{ session('success') }}

    </div>
    <script>
        // Automatically close the alert after 5 seconds
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000); // Adjust the time as needed (in milliseconds)
    </script>
    @endif

    {{-- Error Message on Un-Authenticated User Edit --}}
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fixed-top w-100" role="alert" id="error">
        {{ session('error') }}

    </div>
    <script>
        // Automatically close the alert after 5 seconds
        setTimeout(function() {
            document.getElementById('error').style.display = 'none';
        }, 3000); // Adjust the time as needed (in milliseconds)
    </script>
    @endif


    {{-- Booking Form Section --}}
<section>
    <div class="container mt-5">
        <h2>Make an Offer</h2>
        <h2 style="margin-bottom: 25px; color: #6991c7">Book Your Selected Job: </h2>
        {{-- Booking Form --}}
        <form method="POST" action="{{ route('bookings.create', ['postId' => $post->id]) }}">
            {{-- Form fields --}}
            @csrf
            <div class="mb-3">
                <label for="OfferPrice" class="form-label">Offer Price</label>
                <input type="text" class="form-control" id="OfferPrice" name="offer_price" placeholder="Enter offer price" required>
            </div>
            @error('offer_price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="BookingDate" class="form-label">Booking Date & Time</label>
                <input type="text" class="form-control" id="BookingDate" name="booking_date" placeholder="Select Booking Date & Time" required>
            </div>                     
            @error('booking_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" id="Description" name="description" placeholder="Provide a brief description" required></textarea>
            </div>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <input type="hidden" name="status" value="PENDING">
            </div>
            <input type="hidden" name="poster_id" value="{{ $post->author_id }}">
            <input type="hidden" name="seeker_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
        
    </div>
</section>



    {{-- Include Footer --}}
    {{-- @include ('posts.layouts.footer') --}}


    {{-- Include Scripts --}}
    @include ('seeker.layouts.scripts')

    {{-- Include flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
    // Initialize flatpickr with desired options
    flatpickr("#BookingDate", {
        enableTime: true,
        dateFormat: "Y-m-d H:i:S", // Set the desired date format
    });
    </script>

    

</body>
</html>