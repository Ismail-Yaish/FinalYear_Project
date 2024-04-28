<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- FIXED NAV-BAR --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="navbar-main">
    <div class="container-fluid">
        {{-- Home Button --}}
        <a class="navbar-brand" href="{{ route ('posts.index')}}">
            <img src="{{ asset('/images/bridges-logo.png') }}" alt="Bridges Logo" style="width: 80px; height: 80px;">
        </a>
        <span class="navbar-text navbar-title">BRIDGES</span>
        <button class="navbar-toggler" type="button" onclick="toggleNavbar()" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                {{-- Dropdown Notifications --}}
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle" role="button" aria-haspopup="true">
                        <i class="fa-solid fa-bell fa-xl" style="color: #31383d;"></i>
                        @if (auth()->user()->unreadNotifications)
                            <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span> <!-- Notification count -->
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-start mt-2" aria-labelledby="navbarDropdown" style="max-height: 300px; overflow-y: auto;">
                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <span>Notifications</span>
                            <div style="padding-left: 15px">
                                <a class="btn btn-sm btn-outline-danger" href="{{ route('posts.notifications.markAsReadAll')}}">Mark All As Read</a> <!-- Mark As read -->
                                {{-- <button class="btn btn-sm btn-outline-danger" onclick="clearNotifications()">Clear All</button> <!-- Clear button --> --}}
                            </div>
                        </div>
                        @if (auth()->user()->notifications->isEmpty())
                            <a class="dropdown-item">No notifications</a>
                        @else
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <div class="dropdown-item d-flex justify-content-between align-items-start">
                                    <div>
                                        <span><i class="fas fa-circle text-primary me-1" style="font-size: 8px;"></i>{{ $notification->data['message'] }} - <b> Booking no. {{$notification->data['id']}}</b></span>
                                    </div>
                                    <div style="padding-left: 15px">
                                        <a href="{{ route('posts.notifications.markAsReadIndividual', ['id' => $notification->id]) }}" class="btn btn-sm btn-outline-primary me-2"><u>View</u></a> <!-- Mark as read button -->
                                        {{-- <a href="{{ route('seeker.my-bookings')}}" class="btn btn-sm btn-outline-secondary"><u>View</u></a> <!-- View link --> --}}
                                    </div>
                                </div>
                            @endforeach
                            @foreach (auth()->user()->readNotifications as $notification)
                                <div class="dropdown-item d-flex justify-content-between align-items-start">
                                    <div>
                                        <span>{{ $notification->data['message'] }} - <b> Booking no. {{$notification->data['id']}}</b></span>
                                    </div>
                                    <div style="padding-left: 15px">
                                        <a href="{{ route('posts.notifications.markAsReadIndividual', ['id' => $notification->id]) }}" class="btn btn-sm btn-outline-primary me-2" ><u>View</u></a> <!-- Mark as read button -->
                                        {{-- <a href="{{ route('seeker.my-bookings')}}" class="btn btn-sm btn-outline-secondary"><u>View</u></a> <!-- View link --> --}}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </li>
                {{-- Dropdown Notifications End --}}

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}" title="Home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route ('posts.profile') }}" title="Book">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('posts.myposts')}}" title="Posts">My Posts</a>
                </li>
                <li class="nav-item">
                    {{-- Seperate Page for Poster Bookings --}}
                    <a class="nav-link" href="{{route ('posts.poster-bookings')}}" title="Posts">Bookings</a>   
                </li>
                <li class="nav-item dropdown"  style="padding-right: 15px">
                    <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle" role="button" aria-haspopup="true">Messages <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">    
                        <a class="dropdown-item">No Messages</a>
                    </div>
                </li>
                <li class="nav-item" style="padding-left: 5px">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" id="logout-button">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

<script>
        function toggleNavbar() {
        $('#navbarCollapse').collapse('toggle');
    }
    
    // Manually initialize the dropdown
    $(document).ready(function(){
        $('#navbarDropdown').click(function(){
            $(this).next('.dropdown-menu').toggleClass('show');
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });
    });
</script>
