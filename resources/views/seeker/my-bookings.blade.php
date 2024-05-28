<!DOCTYPE html>
<html lang="en">
<head>

    {{-- Include Head Content --}}
    @include('seeker.layouts.head')

    <title>BRIDGES - My Bookings</title>

</head>
<body>
    {{-- Include Navbar --}}
    @include ('seeker.layouts.navbar')



 {{-- Display Bookings Start --}}
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
                            <p class="fs-4">You have not made any Bookings yet.</p>
                        </div>
                    @else
                    <div class="card-body">
                        @foreach ($bookings as $booking)
                            <div class="card mb-5">
                                <div class="card-body">
                                    {{-- Booking No. --}}
                                    <div class="row justify-content-between">
                                        <div class="col-md-auto">
                                            <div class="d-flex align-items-center">
                                                {{-- Booking No. --}}
                                                <div class="me-4">
                                                    <h4 class="card-title">Booking No. {{$booking->id}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Clientel Name --}}
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        Client Name: <a href="{{ route('profile.view.seeker', ['postId' => $booking->poster_id]) }}"><span style="font-weight: normal;">{{ $booking->poster->name }}</a>
                                    </h6>
                                    <br><br>
                                    {{-- Dsscription --}}
                                    <h6 class="card-text mb-2 text-muted">
                                        <h5 class="card-subtitle">Description: </h5>
                                    </h6>
                                    <h6 class="card-text mt-3 text-muted">
                                        <p class="card-text">{{ strip_tags($booking->description) }}</p>
                                    </h6>
                                    <br><br>
                                    <p class="card-text"><strong>Status: <span style="font-weight: normal;">{{ $booking->status }}</span></strong></p>

                                    {{-- Cancelled Reason --}}
                                    @if($booking->status === 'CANCELLED' ||  $booking->status === 'DECLINED')
                                    {{-- Decline Reason --}}
                                    <div class="mb-3 d-flex align-items-center">
                                        <button class="btn btn-link toggle-reason me-2""><i class="fas fa-eye text-primary"></i></button>
                                        <div class="reason-text d-none">
                                            <strong class="fs-6 fw-bolder">Provided Reason:</strong>
                                            <span>{{ $booking->decline_reason }}</span>
                                        </div>
                                    </div>
                                    @endif

                                    <hr class="my-2">
                                    <br>
                                    {{-- Category --}}
                                    <p class="card-text"><strong>Category: <span style="font-weight: normal;">Moving</span></strong></p>
                                    {{-- Initial Offer Price --}}
                                    <p class="card-text"><strong>Initial Offer Price: <span style="font-weight: normal;">{{ $booking->offer_price }}</span></strong></p>
                                    {{-- Accepted Price --}}
                                    @if (empty($booking->accepted_price))
                                    <p class="card-text"><strong>Accepted Price <span style="font-weight: normal;">[No Price has Been Offered]</span></strong></p>
                                    @else
                                    <p class="card-text"><strong>Accepted Price <span style="font-weight: normal;">{{ $booking->accepted_price }}</span></strong></p>
                                    @endif

                                    {{-- Scheduled Date --}}
                                    <p class="card-text"><strong>Scheduled Date: <span style="font-weight: normal;">{{ $booking->booking_date }}</span></strong></p>
                                    <hr><br>
                                    {{-- Created Date --}}
                                    <p class="card-text"><strong>Booking Created Date: <span style="font-weight: normal;">{{ $booking->created_at }}</span></strong></p>


                                    {{-- Buttons --}}

                                    {{--  View the Corressponding Post Related to the Booking --}}
                                    <div class="buttons float-md-start mt-4">
                                        <a href="{{ route('seeker.view.post', ['postId' => $booking->post_id]) }}" class="btn btn-secondary me-2">View Post</a>
                                    </div>
                                    
                                    {{-- View Corresponding Profile Related to Booking --}}
                                    <div class="buttons float-md-start mt-4 ms-2">
                                        <a href="{{ route('seeker.profile.view.poster', ['bookingId' => $booking->id]) }}" class="btn btn-secondary me-2">View Profile</a>


                                    </div>
                                    
                                    {{-- Mark as Completed Button --}}
                                    {{-- <div class="buttons float-md-start mt-4 ms-2">
                                        <form action="{{ route('bookings.markcompleted', ['booking' => $booking->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Mark as Completed</button>
                                        </form>
                                    </div>                          --}}

                                    @if($booking->status === 'ACCEPTED')
                                    <div class="buttons float-md-end ms-2">
                                        <form action="{{ route('bookings.markcompleted', ['booking' => $booking->id]) }}" method="post">
                                            @csrf
                                            {{-- Mark Completed Button --}}
                                            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle-fill"></i> Mark Completed</button>
                                        </form>
                                    </div>
                                    <div class="buttons float-md-end">
                                        <button type="button" class="btn btn-danger" onclick="showDeclineModal({{ $booking->id }})">Cancel</button>
                                    </div>
                                    @elseif($booking->status === 'TASK-COMPLETED')
                                    <div class="float-md-end">
                                        <i class="fa fa-spinner"></i>
                                        <span style="text-decoration: none;">Waiting for payment from poster...</span>
                                        {{-- <a href="{{url('cancel_booking', $booking->id)}}" class="btn btn-danger ms-2" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</a> --}}
                                    </div>
                                    @elseif($booking->status === 'CANCELLED')
                                    <div class="buttons float-md-end mt-4">
                                    {{-- Delete From --}}
                                    <form  method="post" action="{{route('bookings.destroy', ['booking' => $booking ])}}" id="deleteForm{{$booking->id}}" class="d-inline-block">
                                        @csrf
                                        @method('delete')   
                                        <button type="button" onclick="confirmDelete({{$booking->id}})" class="btn btn-danger">Delete</button>
                                    </form>
                                    </div>
                                    @elseif( $booking->status === 'DECLINED')
                                    <div class="buttons float-md-end mt-4">
                                        {{-- Edit Button --}}
                                        <a href="{{route('bookings.edit', ['booking' => $booking])}}" class="btn btn-warning me-1">Edit</a>
                                        {{-- Delete From --}}
                                        <form  method="post" action="{{route('bookings.destroy', ['booking' => $booking ])}}" id="deleteForm{{$booking->id}}" class="d-inline-block">
                                            @csrf
                                            @method('delete')   
                                            <button type="button" onclick="confirmDelete({{$booking->id}})" class="btn btn-danger">Delete</button>
                                        </form>
                                        </div>
                                    @elseif( $booking->status === 'PAID')
                                    <div class="buttons float-md-end mt-4">
                                        <a href="{{ route('seeker.ratings.show', ['seeker' => $booking->seeker_id]) }}" type="button" class="btn btn-primary"><i class="fa fa-star me-1" aria-hidden="true"></i>View Your Rating</a>
                                    </div>
                                    @else
                                    {{-- Edit & Delete Button  --}}
                                    <div class="buttons float-md-end mt-4">
                                        
                                        {{-- Edit Button --}}
                                        <a href="{{route('bookings.edit', ['booking' => $booking])}}" class="btn btn-warning me-1">Edit</a>
                                        
                                        {{-- Delete From --}}
                                        <form  method="post" action="{{route('bookings.destroy', ['booking' => $booking ])}}" id="deleteForm{{$booking->id}}" class="d-inline-block">
                                            @csrf
                                            @method('delete')   
                                            <button type="button" onclick="confirmDelete({{$booking->id}})" class="btn btn-danger">Delete</button>
                                        </form>

                                    </div>
                                    @endif

                                    {{-- Display Modal for Cancel Booking --}}
                                    @include('seeker.layouts.modals')

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
 {{-- Display Bookings End --}}


    {{-- Include Footer --}}
    @include ('seeker.layouts.footer')



    {{-- Include Scripts --}}
    @include ('seeker.layouts.scripts')



    {{-- Additional JavaScript - ShowModal --}}
<script>

    // Cancel Booking
    function showDeclineModal(bookingId) {
        var modal = new bootstrap.Modal(document.getElementById('declineReasonModal'));
        var actionUrl = "{{ route('bookings.cancel', ':id') }}";
        actionUrl = actionUrl.replace(':id', bookingId);
        document.getElementById('declineReasonModal').querySelector('form').action = actionUrl;
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
