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

  <title>BRIDGES - Register</title>
  
</head>
<body>

{{-- REGISTER SECTION START --}}
<div class="font-helvetica text-[#333]">
    <div class="min-h-screen flex fle-col items-center justify-center py-1 px-1">
      <div class="grid md:grid-cols-2 items-center gap-4 max-w-7xl w-full">
        <div class="relative border border-gray-300 rounded-md p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
            <a href="{{route('home')}}" class="absolute top-4 left-4 text-orange-400">
                <i class="fas fa-arrow-left"></i> 
              </a> <br>
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            <div class="mb-5">
              <h3 class="text-3xl font-extrabold underline decoration-sky-30 text-orange-400">Register</h3>
            </div>
            <div>
                <label class="text-sm mb-2 block">Username</label>
                <input name="name" type="text" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]" placeholder="Enter your username" />
            </div>
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div>
                <label class="text-sm mb-2 block">Email</label>
                <input name="email" type="email" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]" placeholder="Enter your email" />
            </div>
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div class="mb-10 grid grid-cols-2 gap-4">
              <div>
                <label class="text-sm mb-2 block">Phone</label>
                <input name="phone" type="tel" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]" placeholder="Enter your phone" />
              </div>
              @error('phone')
              <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
              <div>
                <label class="text-sm mb-2 block">Address</label>
                <input name="address" type="text" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]" placeholder="Enter your address" />
              </div>
            </div>

            <div>
              <label class="text-sm mb-2 block">Password</label>
              <div class="relative flex items-center">
              <input name="password" type="password" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]" placeholder="Enter your password" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="#fb923c" stroke="#fb923c" class="w-[18px] h-[18px] absolute right-4 cursor-pointer" id="password-toggle" style="cursor: pointer;" viewBox="0 0 128 128">
                <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
              </svg>
              </div>
            </div>
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div>
              <label class="text-sm mb-2 block">Confirm Password</label>
              <div class="relative flex items-center">
              <input name="password_confirmation" type="password" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]" placeholder="Confirm your password" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="#fb923c" stroke="#fb923c" class="w-[18px] h-[18px] absolute right-4 cursor-pointer" id="password-toggle" style="cursor: pointer;" viewBox="0 0 128 128">
                <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
              </svg>
            </div>
            </div>
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div>
              <label class="text-sm mb-2 block" :value="__('Role')">Role</label>
              <select id="role" name="role_id" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#001064]">
                <option value="" disabled selected>Select your role</option>
                <option value="3">Poster</option>
                <option value="4">Seeker</option>
              </select>
            </div>
            @error('role')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div class="flex items-center justify-between gap-2">
              <div class="flex items-center">
                <input id="#" name="#" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required />
                <label for="#" class="ml-3 block text-sm block-text svg mt">
                  I agree to the <a href="#" class="text-blue-600 hover:underline">terms and conditions</a>
                </label>
              </div>
            </div>
            <div class="!mt-10">
                <button type="submit" class="btn btn-primary w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-[#fb923c] focus:outline-none">
                    Register
                </button>
            </div>
            <p class="text-sm !mt-10 text-center">Already have an account? <a href="{{route('login')}}" class="text-blue-600 hover:underline ml-1 whitespace-nowrap">Sign in here</a></p>
          </form>
        </div>
            {{-- Image --}}
            <div class="w-[calc(103.5vh-50px)] h-[calc(94vh-50px)] max-md:mt-10 border-solid border-2 border-orange-200 rounded-lg shadow-lg shadow-orange-300/60 overflow-hidden"">
                <img src="images/sign_this.jpg" class="w-full h-full object-cover" alt="" />
            </div>
      </div>
    </div>
  </div>
{{-- REGISTER SECTION END --}}


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