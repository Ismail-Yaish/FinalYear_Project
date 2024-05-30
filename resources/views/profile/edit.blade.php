<!DOCTYPE html>
<html lang="en">
<head>

    @if(Auth::user()->role_id === 3 || Auth::user()->role_id === 1)
        @include('posts.layouts.head')
    @elseif(Auth::user()->role_id === 4 || Auth::user()->role_id === 1)
        @include('seeker.layouts.head')
    @endif

    <title>BRIDGES - Edit Profile</title>
</head>
<body>

    @if(Auth::user()->role_id === 3 || Auth::user()->role_id === 1)
        @include('posts.layouts.navbar')
    @elseif(Auth::user()->role_id === 4 || Auth::user()->role_id === 1)
        @include('seeker.layouts.navbar')
    @endif

    <br><br>
    {{-- Edit Profile Section Start --}}
    <section class="bg-white">
        <div class="container py-5">
            <div class="max-w-2xl mx-auto border rounded-md p-4 shadow-sm">
                <div class="mb-5">
                    <h3 class="text-2xl fw-bolder text-primary">Update Profile Information</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                </div>
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="row g-3 mb-5">
                        <div class="col-md-6 mb-4">
                            <label for="name" class="fw-bolder fs-6">Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="form-control">
                            @error('name')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="email" class="fw-bolder fs-6">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="email" class="form-control">
                            @error('email')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="phone" class="fw-bolder fs-6">Phone</label>
                            <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" class="form-control">
                            @error('phone')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="address" class="fw-bolder fs-6">Address</label>
                            <input id="address" name="address" type="text" value="{{ old('address', $user->address) }}" autocomplete="address" class="form-control">
                            @error('address')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-white">Save</button>
                        @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Saved. Your Profile has been Updated!') }}
                        </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{-- Edit Profile Section End --}}

    {{-- Update Password Section Start --}}
    <section class="bg-white mt-3">
        <div class="container py-5">
            <div class="max-w-2xl mx-auto border rounded-md p-4 shadow-sm">
                <div class="mb-5">
                    <h3 class="text-2xl fw-bolder text-primary">Change Password</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                </div>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="row g-3 mb-5">
                        <div class="col-7 mb-5">
                            <label for="update_password_current_password" class="fw-bolder fs-6">Current Password</label>
                            <input id="update_password_current_password" name="current_password" type="password" class="form-control" required autocomplete="current-password">
                            @error('current_password')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-7 mb-5">
                            <label for="update_password_password" class="fw-bolder fs-6">New Password</label>
                            <input id="update_password_password" name="password" type="password" class="form-control" required autocomplete="new-password">
                            @error('password')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-7 mb-4">
                            <label for="update_password_password_confirmation" class="fw-bolder fs-6">Confirm Password</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" required autocomplete="new-password">
                            @error('password_confirmation')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-white">Save</button>
                        @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-success mt-2">
                            {{ __('Password updated successfully.') }}
                        </p>
                        @elseif (session('error'))
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-danger mt-2">
                            {{ session('error') }}
                        </p>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{-- Update Password Section End --}}

    {{-- Delete Account Section Start --}}
    <section class="bg-white mt-3">
        <div class="container py-5">
            <div class="max-w-2xl mx-auto border rounded-md p-4 shadow-sm">
                <div class="mb-4 mt-5">
                    <h3 class="text-2xl fw-bolder text-danger">Delete Account</h3>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <p class="mb-5 text-danger fw-bold">
                        {{ __('Once your account is deleted, all of the data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                    <div class="row g-3 mb-5">
                        <div class="col-6 mb-4">
                            <label for="password" class="fw-bolder fs-6">Password</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password" autocomplete="current-password">
                            @error('password')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger text-white">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
</section>
{{-- Delete Account Section End --}}

</body>
@include('posts.layouts.footer')
@include('posts.layouts.scripts')

{{-- Additional Scripts --}}
<script>
    const togglePassword = document.getElementById('password-toggle');
    const passwordField = document.querySelector('input[type="password"]');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
</html>
