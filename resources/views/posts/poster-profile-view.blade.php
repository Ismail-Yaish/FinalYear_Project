<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Include meta tags --}}
    @include('posts.layouts.meta')

    {{-- Bootstrap 5.3.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Include CSS Styles --}}
    @include('posts.layouts.styles')

    <title>Your Profile</title>
</head>
<body>
    {{-- Include Navbar --}}
    @include ('posts.layouts.navbar')

    {{-- Success Message on Edit --}}
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fixed-top w-100" role="alert" id="successAlert">
        {{ session('status') }}

    </div>
    <script>
        // Automatically close the alert after 5 seconds
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000); // Adjust the time as needed (in milliseconds)
    </script>
    @endif

{{-- Profile Content --}}
<div class="container mt-5">
    <div class="row justify-content-center">
        @if(Auth::check() && Auth::id() === $profileData->id)
        <div class="col-md-8"> <h1> Your Profile: </h1>
        @else
        <div class="col-md-8"> <h1> Profile: </h1>
        @endif
            <div class="card rounded">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img class="wd-100 rounded-circle me-3" src="{{ (!empty($profileData->avatar)) ? url('upload/user_images/default.png') : url('upload/no_image.jpg') }}" alt="profile">
                        <div>
                            <label class="tx-11 fw-bolder mb-2 text-uppercase">{{ $profileData->name ?? '[empty]' }}</label>
                            @if($profileData->role_id == 1)
                                <p class="text-muted mb-0"><b>Role: </b><u>Admin</u></p>
                            @elseif($profileData->role_id == 3)
                                <p class="text-muted mb-0"><b>Role: </b><u>Poster</u></p>
                            @elseif($profileData->role_id == 4)
                                <p class="text-muted mb-0"><b>Role: </b><u>Seeker</u></p>
                            @endif
                        </div>
                    </div>
                    {{-- Condition where the edit-button dissapers if the profile is not of auth user --}}
                    @if(Auth::check() && Auth::id() === $profileData->id)
                    <a href="{{ route('profile.edit')}}" class="btn btn-primary">Edit Profile</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="mt-5">
                        <label class="tx-11 fw-bolder  text-uppercase">Email:</label>
                        <p class="text-muted mb-4">{{ $profileData->email ?? '[empty]' }}</p>
                    </div>
                    <hr>
                    @if(Auth::check() && Auth::id() === $profileData->id)
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder  text-uppercase">Address:</label>
                        <p class="text-muted mb-4">{{ $profileData->address ?? '[empty]' }}</p>
                    </div>
                    <hr>
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder  text-uppercase">Phone:</label>
                        <p class="text-muted mb-4">{{ $profileData->phone ?? '[empty]' }}</p>
                    </div>
                    @else
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder  text-uppercase">Address:</label>
                        <p class="text-muted mb-4">[Address of User Hidden]</p>
                    </div>
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder  text-uppercase">Phone:</label>
                        <p class="text-muted mb-4">[Phone of User Hidden]</p>
                    </div>
                    @endif
                    <hr>
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder  text-uppercase">Joined:</label>
                        <p class="text-muted mb-4">{{ $profileData->created_at ?? '[empty]' }}</p>
                    </div>
                    <hr>
                    @if(Auth::check() && Auth::id() === $profileData->id)
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder  text-uppercase">Skills:</label>
                        <p class="text-muted mb-4">[none]</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>





    {{-- Include Footer --}}
    @include ('posts.layouts.footer')

    {{-- Include Scripts --}}
    @include ('posts.layouts.scripts')
</body>
</html>
