<!DOCTYPE html>
<html lang="en">
<head>

    {{-- Include Head Content --}}
    @include('seeker.layouts.head')

    <title>BRIDGES - Create Booking</title>

</head>


<body>

    {{-- Include Navbar --}}
    @include ('seeker.layouts.navbar')




{{-- Booking Form Section Start --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="card-title">Book This Job:</h2>
                <hr>
                <br>
                    <div class="card-body">
                        <div class="card mb-5">
                            <div class="card-body">

                                {{-- Booking Form --}}
                                <form method="POST" action="{{ route('bookings.create', ['postId' => $post->id]) }}">
                                    {{-- Form fields --}}
                                    @csrf
                                    <div class="mb-3">
                                        <label for="OfferPrice" class="form-label fs-5">Offer Price</label>
                                        <input type="text" class="form-control" id="OfferPrice" name="offer_price" placeholder="Enter offer price" required>
                                    </div>
                                    @error('offer_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <div class="mb-3">
                                        <label for="BookingDate" class="form-label fs-5">Booking Date & Time</label>
                                        <input type="text" class="form-control" id="BookingDate" name="booking_date" placeholder="Select Booking Date & Time" required>
                                    </div>                     
                                    @error('booking_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <div class="mb-3">
                                        <label for="Description" class="form-label fs-5">Description</label>
                                        <textarea class="form-control" id="Description" name="description" placeholder="Provide a brief description" required></textarea>
                                    </div>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    {{-- Form Fields End --}}

                                    <div class="mb-3">
                                        <input type="hidden" name="status" value="PENDING">
                                    </div>
                                    <input type="hidden" name="poster_id" value="{{ $post->author_id }}">
                                    <input type="hidden" name="seeker_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="submit" class="btn btn-primary mt-4" value="Submit">
                                </form>
                                
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
{{-- Booking Form Section End --}}


    {{-- Include Footer --}}
    @include ('seeker.layouts.footer')





    {{-- Include Scripts --}}
    @include ('seeker.layouts.scripts')



</body>
</html>