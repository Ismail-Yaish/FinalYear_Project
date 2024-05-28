{{-- THIS IS THE SEEKER PROFILE VIEW WITHIN POSTER DASHBOARD --}}

<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')

    <title>BRIDGES - Seeker Profile</title>

</head>


<body>

    @include('posts.layouts.navbar')


{{-- Poster Profile Content Start --}}
<div class="container mt-5">
    <div class="row justify-content-center">
        @if(Auth::check() && Auth::id() === $profileData->id)
        <div class="col-md-8 mb-3"> <h1> Your Profile: </h1>
        @else
        <div class="col-md-8 mb-3"> <h1> Profile: </h1>
        @endif
            <div class="card rounded mt-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img class="wd-100 rounded-circle me-3" src="{{ (!empty($profileData->avatar)) ? url('upload/user_images/default.png') : url('upload/no_image.jpg') }}" alt="profile">
                        <div class="card-title ms-3">
                            <label class="fs-3 fw-bolder mb-3 text-uppercase"><span>{{ $profileData->name ?? '[empty]' }}</span></label>
                            <br>
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
                        <label class="tx-11 fw-bolder fw-bold text-uppercase mb-2"><u>Email:</u></label>
                        <p class="text-muted mb-4">{{ $profileData->email ?? '[empty]' }}</p>
                    </div>
                    <hr>
                    @if(Auth::check() && Auth::id() === $profileData->id)
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder text-uppercase mb-2"><u>Address:</u></label>
                        <p class="text-muted mb-4">{{ $profileData->address ?? '[empty]' }}</p>
                    </div>
                    <hr>
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder text-uppercase mb-2"><u>Phone:</u></label>
                        <p class="text-muted mb-4">{{ $profileData->phone ?? '[empty]' }}</p>
                    </div>
                    @else
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder text-uppercase mb-2"><u>Address:</u></label>
                        <p class="text-muted mb-4">[Address of User Hidden]</p>
                    </div>
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder text-uppercase mb-2"><u>Phone:</u></label>
                        <p class="text-muted mb-4">[Phone of User Hidden]</p>
                    </div>
                    @endif
                    <hr>
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder text-uppercase mb-2"><u>Joined:</u></label>
                        <p class="text-muted mb-4">{{ $profileData->created_at ?? '[empty]' }}</p>
                    </div>
                    <hr>
                    <div class="mt-4">
                        <label class="tx-11 fw-bolder text-uppercase mb-2"><u>Skills:</u></label>
                        <p class="text-muted mb-4">{{ $profileData->skills ?? '[empty]' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
{{-- Seeker Profile Content End --}}


@include('posts.layouts.footer')


@include('posts.layouts.scripts')

</body>
</html>