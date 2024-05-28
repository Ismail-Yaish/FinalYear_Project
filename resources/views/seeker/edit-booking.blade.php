<!DOCTYPE html>
<html lang="en">
<head>

    {{-- Include Head Content --}}
    @include('seeker.layouts.head')

    <title>BRIDGES - Edit Booking</title>

</head>
<body>

    {{-- Include Navbar --}}
    @include ('seeker.layouts.navbar')


{{-- Edit Booking Section Start --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="card-title">Edit Your Booking:</h2>
                <hr>
                <br>
                    <div class="card-body">
                        <div class="card mb-5">
                            <div class="card-body">

                                {{-- Edit Booking Form Start --}}
                                <form method="post" action="{{ route('bookings.update', ['booking' => $booking]) }}">
                                    @csrf
                                    @method('put')

                                    {{-- Form fields --}}
                                    <div class="mb-3">
                                        <label for="OfferPrice" class="form-label fs-5"><b>OfferPrice</b></label>
                                        <input type="text" class="form-control mt-3" id="OfferPrice" name="offer_price" placeholder="Enter Offer Price" required pattern="[0-9]+(\.[0-9][0-9]?)?" title="Please enter a valid price (e.g., 10 or 10.50)" value="{{ $booking->offer_price }}">
                                    </div>
                                    @error('offer_price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <div class="mb-3">
                                        <label for="BookingDate" class="form-label fs-5"><b>Booking Date</b></label>
                                        <input type="text" class="form-control mt-3" id="BookingDate" name="booking_date" placeholder="Select Booking Date & Time" required value="{{ $booking->booking_date }}">
                                    </div>
                                    @error('booking_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <div class="mb-3">
                                        <label for="Description" class="form-label fs-5"><strong>Description</strong></label>
                                        <textarea class="form-control mt-3" id="Description" name="description" placeholder="Provide a brief description" required>{{ $booking->description }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <div class="mb-3">
                                        <input type="hidden" name="status" value="PENDING">
                                    </div>
                                    <div class="mb-3">
                                        {{-- Hidden fields --}}
                                        <input type="hidden" name="poster_id" value="{{ $booking->poster_id }}">
                                        <input type="hidden" name="seeker_id" value="{{ $booking->seeker_id }}">
                                        <input type="hidden" name="post_id" value="{{ $booking->post_id }}">
                                    </div>
                                    {{-- Submit button --}}
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </form>
                                {{-- Edit Booking Form End --}}

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>

{{-- Edit Booking Section End --}}



    {{-- Include Footer --}}
    @include('seeker.layouts.footer')



    {{-- Include Scripts --}}
    @include('seeker.layouts.scripts')

</body>
</html>