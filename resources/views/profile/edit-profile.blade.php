<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Include meta tags --}}
    @include('seeker.layouts.meta')

    {{-- Bootstrap 5.3.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Include CSS Styles --}}
    @include('seeker.layouts.styles')

    <style>
        /* Add custom styles here */
        .form-group {
            margin-bottom: 20px; /* Add space between each form field */
        }

        /* Ensure footer stays at the bottom */
        html,
        body {
            height: 100%;
        }

        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }
    </style>

    <title>Your Profile</title>
</head>
<body class="wrapper">
    {{-- Include Navbar --}}
    @include('seeker.layouts.navbar')

    {{-- Profile Content --}}
    <div class="content">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    {{-- <h1>Your Profile</h1> --}}

                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
                            <p class="mt-1 text-sm text-gray-600">Update your account's profile information and email address.</p>
                        </header>
            
                        <!-- Your customized form with modified styles -->
                        <form method="post" action="{{ route('profile.update') }}" class="my-custom-form">
                            @csrf
                            @method('patch')
                            <!-- Name field -->
                            <div class="form-group">
                                <label for="name" class="font-bold">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                <!-- Add any error messages or validation here -->
                            </div>
                            <!-- Email field -->
                            <div class="form-group">
                                <label for="email" class="font-bold">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="email">
                                <!-- Add any error messages or validation here -->
                            </div>
                            <!-- Phone number field -->
                            <div class="form-group">
                                <label for="phone" class="font-bold">Phone Number:</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required autocomplete="tel">
                                <!-- Add any error messages or validation here -->
                            </div>
                            <!-- Address field -->
                            <div class="form-group">
                                <label for="address" class="font-bold">Address:</label>
                                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $user->address) }}" autocomplete="address">
                                <!-- Add any error messages or validation here -->
                            </div>
                            <!-- Save button -->
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Footer --}}
    @include('seeker.layouts.footer')

    {{-- Include Scripts --}}
    @include('seeker.layouts.scripts')
</body>
</html>
