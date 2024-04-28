<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Include meta tags --}}
    @include('seeker.layouts.meta')

    {{-- Include Boostrap --}}
    @include('seeker.layouts.bootstrap')

    {{-- Include CSS Styles --}}
    @include('seeker.layouts.styles')

    <title>My Bookings</title>
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


 {{-- Main Content --}}
 {{-- Display Bookings --}}
 <main>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    @if ($bookings->isEmpty())
                        <hr>
                        <h2 style="text-align: center">You currently have no bookings.</h2>
                        <hr>
                    @else
                    <h2>Your Current Bookings</h2>
                    <hr>
                        <ul class="job-list">
                            @foreach ($bookings as $booking)
                                <li class="job-preview">
                                    <div class="content">
                                        <h4 class="job-title">
                                            Booking No. {{$booking->id}}
                                        </h4>
                                        <h5 class="company">
                                            Desc: {{ strip_tags($booking->description) }}
                                        </h5>
                                        <h6>Status: {{ $booking->status }}</h6>
                                        <h6>Scheduled Date: {{ $booking->booking_date }}</h6>
                                        <h6>Client Name: {{ $booking->poster->name }}</h6>
                                        <h6>Initial Offer Price: {{ $booking->offer_price }}</h6>
                                        @if (empty($booking->accepted_price))
                                        <h6>Accepted Price: [No Price has been Offered] </h6>
                                        @else
                                        <h6>Accepted Price: {{ $booking->accepted_price }}</h6>
                                         @endif
                                        <h6>Created Date: {{ $booking->created_at }}</h6>
                                    </div>

                            {{--  View the Corressponding Post Related to the Booking --}}
                            <div class="buttons float-md-start">
                                <a href="{{ route('seeker.view.post', ['postId' => $booking->post_id]) }}" class="btn btn-apply">View Post</a>
                            </div>
                            - 
                            {{-- View Corresponding Profile Related to Booking --}}
                            <div class="buttons float-md-start">
                                <a href="{{ route('profile.view.seeker', ['postId' => $booking->poster_id]) }}" class="btn btn-apply">View Client Profile</a>
                            </div>
                            
                            {{-- Mark as Completed --}}
                            <div class="buttons float-md-start">
                                <form action="{{ route('bookings.markcompleted', ['booking' => $booking->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-apply">Mark as Completed</button>
                                </form>
                            </div>                         

                            {{-- Edit & Delete Form  --}}
                            <div class="buttons float-md-end">
                                
                                <a href="{{route('bookings.edit', ['booking' => $booking])}}" class="btn btn-apply">Edit</a>
                                
                                <form  method="post" action="{{route('bookings.destroy', ['booking' => $booking ])}}" id="deleteForm{{$booking->id}}" class="d-inline-block">
                                    @csrf
                                    @method('delete')   
                                    <button type="button" onclick="confirmDelete({{$booking->id}})" class="btn btn-apply">Delete</button>
                                </form>
                            </div>
                                <div class="clearfix"></div>
                            </li>

                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>

    {{-- Include Footer --}}
    @include ('seeker.layouts.footer')

    {{-- Include Scripts --}}
    @include ('seeker.layouts.scripts')
</body>
</html>
