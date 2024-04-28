{{-- Poster Bookings Page --}}

<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Include meta tags --}}
    @include('posts.layouts.meta')

    {{-- Include Bootstrap 5.3.3 --}}
    @include('posts.layouts.bootstrap')

    {{-- Include CSS Styles --}}
	@include('posts.layouts.styles')


    <title>My Bookings</title>
</head>
<body>
    {{-- Include Navbar --}}
    @include ('posts.layouts.navbar')

    {{-- Message on Accept --}}
    @if (session('accepted'))
    <div class="alert alert-success alert-dismissible fixed-top w-100" role="alert" id="acceptAlert">
        {{ session('accepted') }}

    </div>
    <script>
        // Automatically close the alert after 5 seconds
        setTimeout(function() {
            document.getElementById('acceptAlert').style.display = 'none';
        }, 3000); // Adjust the time as needed (in milliseconds)
    </script>
    @endif

    {{-- Message on Decline --}}
    @if (session('declined'))
    <div class="alert alert-danger alert-dismissible fixed-top w-100" role="alert" id="declineAlert">
        {{ session('declined') }}

    </div>
    <script>
        // Automatically close the alert after 5 seconds
        setTimeout(function() {
            document.getElementById('declineAlert').style.display = 'none';
        }, 3000); // Adjust the time as needed (in milliseconds)
    </script>
    @endif   

{{-- Displayed Bookings --}}
<section>
    <div class="container mt-5 .container-content">
        <div class="row" style="padding-bottom: 200px">
            <div class="col-md-10 offset-md-1">
                <div><h2>Your Current Bookings</h2></div>
                <ul class="job-list">
                    @foreach ($bookings as $booking)
                    <li class="job-preview">
                        <div class="content">
                            <h4 class="job-title">
                                Booking No. {{$booking->id}}
                            </h4>
                            <h5 class="company">
                                The Tasker  <u>'{{ $booking->seeker->name }}'</u> has made a booking to your post!
                            </h5>
                            <h6>Status: {{ $booking->status }}</h6>
                            <h6>Scheduled Date: {{ $booking->booking_date }}</h6>
                            <h6>Description: {{ strip_tags($booking->description) }}</h6>
                            <h6>Initial Offer Price: {{ $booking->offer_price }}</h6>
                            @if (empty($booking->accepted_price))
                            <h6>Accepted Price: [No Price has been Offered] </h6>
                            @else
                            <h6>Accepted Price: {{ $booking->accepted_price }}</h6>
                            @endif
                            <h6>Created Date: {{ $booking->created_at }}</h6>

                            {{--  View the Corresponding Post Related to the Booking --}}
                            <div class="buttons float-md-start">
                                <a href="{{ route('posts.view', ['postId' => $booking->post_id]) }}" class="btn btn-apply">View Post</a>
                            </div>
                            - 
                            {{-- View Corresponding Profile Related to Booking --}}
                            <div class="buttons float-md-start">
                                <a href="{{ route('posts.view.seeker.profile', ['bookingId' => $booking->id]) }}" class="btn btn-apply">View Seeker Profile</a>
                            </div>

                            {{-- If booking status = Completed = Make Payment Gateway appear --}}
                            @if($booking->status === 'TASK-COMPLETED')
                                {{-- View Payment Gateway --}}
                                <div class="buttons float-md-end">
                                    <a href="{{ route('checkout', ['booking' => $booking->id]) }}" class="btn btn-success"> <i class="fa fa-credit-card" aria-hidden="true"></i> 
                                    Make Payment</a>
                                </div>
                            @else
                                {{-- Buttons for Status Change --}}
                                <div class="buttons float-md-end">
                                    <a href="#" class="btn btn-primary mr-2" onclick="showAcceptModal({{ $booking->id }})">Accept</a>
                                    <a href="{{url('reject_booking', $booking->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to decline this booking?')">Decline</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Modal for Accepting Booking --}}
<div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptModalLabel">Accept Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('accept_booking', ['id' => $booking->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="AcceptedPrice" class="form-label">Accepted Price</label>
                        <input type="number" step="0.01" class="form-control" id="AcceptedPrice" name="accepted_price" placeholder="Enter accepted price" required>
                        @error('accepted_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Include Footer --}}
@include ('posts.layouts.footer')

{{-- JavaScript to show modal --}}
<script>
    function showAcceptModal(bookingId) {
        var modal = new bootstrap.Modal(document.getElementById('acceptModal'));
        document.getElementById('acceptModal').querySelector('form').action = "{{ url('accept_booking') }}/" + bookingId;
        modal.show();
    }
</script>


    {{-- Include Scripts --}}
    @include ('posts.layouts.scripts')


</body>
</html>