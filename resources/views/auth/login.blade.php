{{-- <!-- NEW LOGIN FORM --> --}}
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>BRIDGES - Login</title>

</head>
<body>

{{-- LOGIN SECTION START --}}
  <div class="font-helvetica text-[#333]">
    <div class="min-h-screen flex fle-col items-center justify-center py-1 px-1">
      <div class="grid md:grid-cols-2 items-center gap-4 max-w-7xl w-full">
        <div class="relative border border-gray-300 rounded-md p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
            <a href="{{route('home')}}" class="absolute top-4 left-4 text-orange-400">
              <i class="fas fa-arrow-left"></i>
            </a> <br>
          <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div class="mb-10">
              <h3 class="text-3xl font-extrabold underline decoration-sky-30 text-orange-400">Sign in</h3>
              <p class="text-sm mt-4">Sign in to your account and explore what BRIDGES has to offer. Your journey begins here.</p>
            </div>
            <div>
              <label class="text-sm mb-2 block">Name / Email / Phone</label>
              <div class="relative flex items-center">
                <input name="login" type="text" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]" placeholder="Enter Name" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="#fb923c" stroke="#fb923c" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                  <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                  <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000"></path>
                </svg>
              </div>
              @error('login')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <div>
              <label class="text-sm mb-2 block" :value="__('Password')">Password</label>
              <div class="relative flex items-center">
                <input name="password" type="password" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]" placeholder="Enter Password" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="#fb923c" stroke="#fb923c" class="w-[18px] h-[18px] absolute right-4 cursor-pointer" id="password-toggle" style="cursor: pointer;" viewBox="0 0 128 128">
                  <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                </svg>
              </div>
              @error('password')
              <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
            <div class="flex items-center justify-between gap-2">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                <label for="remember-me" class="ml-3 block text-sm block-text svg mt">
                  Remember me
                </label>
              </div>
              <div class="text-sm">
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                  Forgot your password?
                </a>
              </div>
            </div>
            <div class="!mt-10">
              <button type="submit" class="btn btn-primary w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-[#fb923c] focus:outline-none">
                Log in
              </button>
            </div>
            <p class="text-sm !mt-10 text-center">Don't have an account <a href="{{route('register')}}" class="text-blue-600 hover:underline ml-1 whitespace-nowrap">Register here</a></p>
          </form>
        </div>
            {{-- Image --}}
            <div class="w-[calc(108.5vh-50px)] h-[calc(104vh-50px)] border-solid border-2 border-orange-300 rounded-lg shadow-lg shadow-orange-300/25 overflow-hidden">
                <img src="{{ asset('images/login.jpg') }}" class="w-full h-full" alt="Login Image" />
            </div>
      </div>
    </div>
  </div>
{{-- LOGIN SECTION END --}}

</body>

{{-- <!-- JavaScript Libraries --> --}}
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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
