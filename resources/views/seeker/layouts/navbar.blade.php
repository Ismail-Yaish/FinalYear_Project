{{-- Seeker - navbar.blade.php --}}

{{-- Navbar Start --}}
<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top px-4 px-lg-5">
    <a href="{{ route ('seeker.dashboard')}}" class="navbar-brand d-flex align-items-center">
        <h1 class="m-0" style="color: white;"><img class="img-fluid me-3" src="{{ asset('img/icon/icon-00-logo-primary.png') }}" alt="">BRIDGES</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto bg-dark pe-4 py-3 py-lg-0">
            {{-- Navbar items to appear on the right --}}
            <li class="nav-item"><a href="{{ route('seeker.dashboard') }}" class="nav-link {{ request()->routeIs('seeker.dashboard') ? 'active' : '' }}">Home</a></li>
            <li class="nav-item"><a href="{{ route ('seeker.profile') }}" class="nav-link {{ request()->routeIs('seeker.profile') ? 'active' : '' }}">Profile</a></li>
            <li class="nav-item"><a href="{{ route('seeker.my-bookings') }}" class="nav-link {{ request()->routeIs('seeker.my-bookings') ? 'active' : '' }}">My Bookings</a></li>
            <li class="nav-item"><a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">Account</a></li>

            {{-- Dropdown Notifications Start --}}
            <li class="nav-item dropdown">
                <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle" role="button" aria-haspopup="true">
                    <i class="far fa-bell fa-xl"></i>
                    @if (auth()->user()->unreadNotifications) 
                        {{-- Notification count --}}
                        <span class="badge bg-danger badge-sm" style="font-size: 0.6rem;">{{ auth()->user()->unreadNotifications->count() }}</span>  
                    @endif 
                </a>
                <div class="dropdown-menu dropdown-menu-start mt-2" aria-labelledby="navbarDropdown" style="max-height: 300px; overflow-y: auto;">
                    <div class="dropdown-header d-flex justify-content-between align-items-center">
                        <h6>Notifications</h6>
                        <div style="padding: 0 0 15px 15px">
                            {{--  Mark As read  --}}
                            <a class="btn btn-sm btn-outline-danger me-2" href="{{ route('seeker.notifications.markAsReadAll')}}">Mark All As Read</a> 
                            {{--  Clear button   --}}
                            <button class="btn btn-sm btn-outline-danger" onclick="clearNotifications()">Clear All</button> 
                        </div>
                    </div>
                    {{-- Check IF Notification is Empty - ELSE display unread / read notification --}}
                    @if (auth()->user()->notifications->isEmpty()) 
                        <a class="dropdown-item">No notifications</a> 
                    @else

                        {{--Display Unread Notification  --}}
                        @foreach (auth()->user()->unreadNotifications as $notification) 
                            <div class="dropdown-item d-flex justify-content-between align-items-start">
                                <div>
                                    <span><i class="fas fa-circle text-primary me-1" style="font-size: 8px;"></i>{{ $notification->data['message'] }} - <b> Booking ID: #{{$notification->data['id']}}</b></span> 
                                </div>
                                <div style="padding-left: 15px">
                                    {{--  Mark as read button  --}}
                                    <a href="{{ route('seeker.notifications.markAsReadIndividual', ['id' => $notification->id]) }}" class="btn btn-sm btn-outline-primary me-2">Clear</a>  
                                    {{--  View link Button  --}}
                                    <a href="{{ route('seeker.my-bookings')}}" class="btn btn-sm btn-outline-secondary">View</a> 
                                </div>
                            </div>
                        @endforeach 

                        {{-- Display Read Notifications --}}
                        @foreach (auth()->user()->readNotifications as $notification) 
                            <div class="dropdown-item d-flex justify-content-between align-items-start">
                                <div>
                                    <span>{{ $notification->data['message'] }} - <b> Booking ID: #{{$notification->data['id']}}</b></span> 
                                </div>
                                <div style="padding-left: 15px">
                                    {{--  Mark as read button  --}}
                                    <a href="{{ route('seeker.notifications.markAsReadIndividual', ['id' => $notification->id]) }}" class="btn btn-sm btn-outline-primary me-2" >Clear</a>  
                                    {{--  View link  --}}
                                    <a href="{{ route('seeker.my-bookings')}}" class="btn btn-sm btn-outline-secondary">View</a>  
                                </div>
                            </div>
                        @endforeach 
                    @endif
                </div> 
            </li>
             {{-- Dropdown Notifications End --}} 

            {{-- Logout Button --}}
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger ms-4 mt-1 rounded-pill px-3 py-2" id="logout-button">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
{{-- Navbar End --}}



{{-- Navbar Messages Start --}}

{{-- -----------------------------------MYPOSTS PAGE MESSAGES----------------------------------------- --}}
{{-- Success Message on Edit --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fixed-top w-20 mt-2" role="alert" id="successAlert">
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
<div class="alert alert-danger alert-dismissible fixed-top w-20 mt-2" role="alert" id="error">
    {{ session('error') }}

</div>
<script>
    // Automatically close the alert after 5 seconds
    setTimeout(function() {
        document.getElementById('error').style.display = 'none';
    }, 3000); // Adjust the time as needed (in milliseconds)
</script>
@endif

{{-- ----------------------------------BOOKING PAGE MESSAGES------------------------------------------ --}}
{{-- Message on Accept --}}
@if (session('accepted'))
<div class="alert alert-success alert-dismissible fixed-top w-20 mt-2" role="alert" id="acceptAlert">
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
<div class="alert alert-danger alert-dismissible fixed-top w-20 mt-2" role="alert" id="declineAlert">
    {{ session('declined') }}

</div>
<script>
    // Automatically close the alert after 5 seconds
    setTimeout(function() {
        document.getElementById('declineAlert').style.display = 'none';
    }, 3000); // Adjust the time as needed (in milliseconds)
</script>
@endif  

{{-- Navbar Messages End --}}
