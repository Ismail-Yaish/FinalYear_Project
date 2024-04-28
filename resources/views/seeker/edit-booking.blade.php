<!DOCTYPE html>
<html lang="en">
<head>

    @include('seeker.layouts.meta')
    
    {{-- Include Boostrap --}}
    @include('seeker.layouts.bootstrap')

    {{-- Include CSS Styles --}}
    @include('seeker.layouts.styles')

    {{-- Include flatpickr CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <title>Edit Booking</title>
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

    {{-- Edit Booking Section --}}
    <div class="container mt-5 container-content">
        <h2 style="margin-bottom: 2rem">Edit Your Booking</h2>

        <form method="post" action="{{ route('bookings.update', ['booking' => $booking]) }}">
            @csrf
            @method('put')

            {{-- Form fields --}}
            <div class="mb-3">
                <label for="OfferPrice" class="form-label"><b>OfferPrice</b></label>
                <input type="text" class="form-control" id="OfferPrice" name="offer_price" placeholder="Enter Offer Price" required pattern="[0-9]+(\.[0-9][0-9]?)?" title="Please enter a valid price (e.g., 10 or 10.50)" value="{{ $booking->offer_price }}">
            </div>
            @error('offer_price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="BookingDate" class="form-label"><b>Booking Date</b></label>
                <input type="text" class="form-control" id="BookingDate" name="booking_date" placeholder="Select Booking Date & Time" required value="{{ $booking->booking_date }}">
            </div>
            @error('booking_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" id="Description" name="description" placeholder="Provide a brief description" required>{{ $booking->description }}</textarea>
            </div>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            
            <div class="mb-3">
                <input type="hidden" name="status" value="PENDING">
            </div>
            <div class="mb-3">
                {{-- Hidden fields --}}
                {{-- <input type="hidden" name="status" value="{{ $booking->status }}"> --}}
                <input type="hidden" name="poster_id" value="{{ $booking->poster_id }}">
                <input type="hidden" name="seeker_id" value="{{ $booking->seeker_id }}">
                <input type="hidden" name="post_id" value="{{ $booking->post_id }}">
            </div>
            {{-- Submit button --}}
            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>

    {{-- Include Footer --}}
    @include('seeker.layouts.footer')

    {{-- Include Scripts --}}
    @include('seeker.layouts.scripts')

</body>
</html>