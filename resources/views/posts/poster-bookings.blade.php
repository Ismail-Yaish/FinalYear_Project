<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')

    <title>BRIDGES - Bookings</title>

</head>


<body>

    @include('posts.layouts.navbar')

    {{-- Error Messages Part of Navbar --}}


{{-- Displayed Bookings Start --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="card-title">Your Bookings</h2>
                <hr>
                <br>

                <div class="card-body">
                    @if ($bookings->isEmpty())
                        <div class="text-center mt-3" style="margin-bottom: 60vh">
                            <p class="fs-4">You have no bookings currently available.</p>
                        </div>
                    @else
                        @foreach ($bookings as $booking)
                            <div class="card mb-5">
                                <div class="card-body">
                                    {{-- Booking No --}}
                                    <h4 class="card-title mb-2">
                                        Booking ID: #{{$booking->id}}
                                    </h4>

                                    <h6 class="card-subtitle mb-2 text-muted">
                                        The Tasker<span class="nav-link d-inline">'{{$booking->seeker->name}}'</span>has made a booking to your post!
                                    </h6>

                                    <br><br>
                                    {{-- Description --}}
                                    <p class="card-text fs-4 fw-bolder">Description:</p>
                                    <p class="card-text">{{ strip_tags($booking->description) }}</p>
                                    <br><br>                            

                                    {{-- Status --}}
                                    <p class="card-text"><strong class="fs-6 fw-bolder">Status: </strong><u class="fs-6 fw-normal">{{ $booking->status }}</u></p>

                                    {{-- Decline Reason --}}
                                    @if($booking->status === 'DECLINED' || $booking->status == 'CANCELLED')
                                    {{-- Decline Reason --}}
                                    <div class="mb-3 d-flex align-items-center">
                                        <button class="btn btn-link toggle-reason me-2""><i class="fas fa-eye text-primary"></i></button>
                                        <div class="reason-text d-none">
                                            <strong class="fs-6 fw-bolder">Provided Reason:</strong>
                                            <span>{{ $booking->decline_reason }}</span>
                                        </div>
                                    </div>
                                    @endif

                                    <br class="my-5">
                                    <hr>

                                    {{-- Schedule Date --}}
                                    <p class="card-text"><strong class="fs-6 fw-bolder">Scheduled Date: <span class="fs-6 fw-normal">{{ $booking->booking_date }}</span></strong></p>

                                    {{-- Initial Offer Price --}}
                                    <p class="card-text"><strong class="fs-6 fw-bolder">Initial Offer Price: <span class="fs-6 fw-normal">{{ $booking->offer_price }} MVR</span></strong></p>

                                    {{-- Accepted Offer Price --}}
                                    @if (empty($booking->accepted_price))
                                        <p class="card-text"><strong class="fs-6 fw-bolder">Accepted Price: <span class="fs-6 fw-normal">[No Price has been Offered]</span></strong></p>
                                    @else
                                        <p class="card-text"><strong class="fs-6 fw-bolder">Accepted Price: <span class="fs-6 fw-normal">{{ $booking->accepted_price }} MVR</span></strong></p>
                                    @endif

                                    {{-- Created Date --}}
                                    <p class="card-text fs-6 fw-bolder mb-3"><strong class="fs-6 fw-bolder">Created Date: <span class="fs-6 fw-normal">{{ $booking->created_at }}</span></strong></p>
                                    <hr class="my-4">

                                    {{-- Buttons Section Start --}}
                                    {{--  View the Corresponding Post Related to the Booking --}}
                                    <div class="buttons float-md-start">
                                        <a href="{{ route('posts.view', ['postId' => $booking->post_id]) }}" class="btn btn-secondary me-2">View Post</a>
                                    </div>
                                    
                                    {{-- View Corresponding Profile Related to Booking --}}
                                    <div class="buttons float-md-start">
                                        <a href="{{ route('posts.view.seeker.profile', ['bookingId' => $booking->id]) }}" class="btn btn-secondary ms-2">View Seeker Profile</a>
                                    </div>

                                    {{-- If booking status = Completed = Make Payment Gateway appear --}}
                                    @if($booking->status === 'TASK-COMPLETED')
                                        {{-- View Payment Gateway --}}
                                        <div class="buttons float-md-end">
                                            <a href="{{ route('checkout', ['booking' => $booking->id]) }}" class="btn btn-success"> <i class="fa fa-credit-card" aria-hidden="true"></i> 
                                            Make Payment</a>
                                        </div>
                                    @elseif ($booking->status === 'ACCEPTED')
                                        <div class="float-md-end">
                                            <i class="fa fa-spinner"></i>
                                            <span style="text-decoration: none;">Waiting for seeker response...</span>
                                            <div class="buttons float-md-end">
                                                {{-- <a href="#" class="btn btn-danger" onclick="showDeclineModal({{ $booking->id }})">Decline Instead</a> --}}
                                            </div>
                                        </div>
                                    @elseif($booking->status === 'CANCELLED' || $booking->status === 'DECLINED')
                                        <div class="buttons float-md-end mt-4">
  
                                                {{-- <button type="button" class="btn btn-danger"><empty></button> --}}

                                        </div>
                                    @elseif($booking->status === 'PAID')
                                    <div class="buttons float-md-end mt-4">
                                        <a href="{{ route('posts.ratings.show', ['seeker' => $booking->seeker_id]) }}" type="button" class="btn btn-primary"><i class="fa fa-star me-1" aria-hidden="true"></i>Rate This Seeker</a>
                                    </div>
                                    @else
                                        {{-- Buttons for Status Change --}}
                                        <div class="buttons float-md-end">
                                            <a href="#" class="btn btn-success me-2" onclick="showAcceptModal({{ $booking->id }})">Accept</a>
                                            {{-- <a href="{{url('reject_booking', $booking->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to decline this booking?')">Decline</a> --}}
                                            <div class="buttons float-md-end">
                                                <a href="#" class="btn btn-danger" onclick="showDeclineModal({{ $booking->id }})">Decline</a>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Buttons Section End --}}
                                    
                                    {{-- Display Modal for Accept/Decline Booking --}}
                                    @include('posts.layouts.modals')

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Displayed Bookings End --}}


    @include('posts.layouts.footer')



    @include('posts.layouts.scripts')

{{-- Additional JavaScript - ShowModal --}}
<script>
    function showAcceptModal(bookingId) {
        var modal = new bootstrap.Modal(document.getElementById('acceptModal'));
        document.getElementById('acceptModal').querySelector('form').action = "{{ url('accept_booking') }}/" + bookingId;
        modal.show();
    }

    function showDeclineModal(bookingId) {
        var modal = new bootstrap.Modal(document.getElementById('declineReasonModal'));
        document.getElementById('declineReasonModal').querySelector('form').action = "{{ url('reject_booking') }}/" + bookingId;
        modal.show();
    }

    document.querySelectorAll('.toggle-reason').forEach(button => {
        button.addEventListener('click', () => {
            const reasonText = button.nextElementSibling;
            reasonText.classList.toggle('d-none');
            button.childNodes[0].classList.toggle('fa-eye');
            button.childNodes[0].classList.toggle('fa-eye-slash');
        });
    });
</script>

</body>
</html>