@extends('frontend.master')


{{-- Topbar Section Start --}}
@section('topbar')
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-white-50 py-2 px-0 d-none d-lg-block">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-phone-alt me-2"></small>
                    <small>+960 332-3902</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="far fa-envelope-open me-2"></small>
                    <small>info@bridges.com.mv</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <ol class="breadcrumb justify-content-end mb-0">
                    <li class="breadcrumb-item"><a class="text-white-50 small" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white-50 small" href="#">Terms</a></li>
                    <li class="breadcrumb-item"><a class="text-white-50 small" href="#">Privacy</a></li>
                    <li class="breadcrumb-item"><a class="text-white-50 small" href="#">Support</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
@endsection
{{-- Topbar Section End --}}


{{-- Navbar Section Start --}}
@section('navbar')
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-light navbar-light sticky-top px-4 px-lg-5">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0"><img class="img-fluid me-3" src="{{ asset('img/icon/icon-00-logo-primary.png') }}" alt="">BRIDGES</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto bg-light pe-4 py-3 py-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('service') }}" class="nav-item nav-link">Services</a>
                <a href="{{ route('login') }}" class="nav-item nav-link">Popular Posts</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu bg-light border-0 m-0">
                        <a href="{{ route('feature') }}" class="dropdown-item">Features</a>
                        <a href="{{ route('service') }}" class="dropdown-item">Services</a>
                        <a href="#" class="dropdown-item">Popular Seekers</a>
                        <a href="#" class="dropdown-item">Testimonial</a>
                        <a href="#" class="dropdown-item">404 Page</a>
                    </div>
                </div>
            </div>
            
                    {{-- Conditional Links based on User Role When Authenticated --}}
                    @auth
                    @if (Auth::user()->role_id == 1)
                        {{-- Admin Dashboard Link --}}
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <a href="{{ route('dashboard')}}" class="btn btn-small btn-primary text-white outline-none rounded-5 shadow ms-2">DASHBOARD</a>
                        </div>
                        {{-- Logout Button --}}
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger ms-4 mt-1 rounded-pill px-3 py-2" id="logout-button">Logout</button>
                            </form>
                        </div>
                    @elseif (Auth::user()->role_id == 3)
                        {{-- Poster Dashboard Link --}}
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <a href="{{ route('posts.index')}}" class="btn btn-small btn-primary text-white outline-none rounded-5 shadow ms-2">DASHBOARD</a>
                        </div>
                        {{-- Logout Button --}}
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger ms-4 mt-1 rounded-pill px-3 py-2" id="logout-button">Logout</button>
                            </form>
                        </div>
                    @elseif (Auth::user()->role_id == 4)
                        {{-- Poster Dashboard Link --}}
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <a href="{{ route('seeker.dashboard')}}" class="btn btn-small btn-primary text-white outline-none rounded-5 shadow ms-2">DASHBOARD</a>
                        </div>
                        {{-- Logout Button --}}
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger ms-4 mt-1 rounded-pill px-3 py-2" id="logout-button">Logout</button>
                            </form>
                        </div>
                    @endif
                    @else
                    {{-- When NOT Authenticated --}}
                    <div class="h-100 d-flex align-items-center justify-content-center mt-3">
                        <p class="nav-link"><a href="{{ route('login')}}">LOG IN</a></p>
                    </div>

                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <a href="{{ route('register')}}" class="btn btn-small btn-primary text-white outline-none rounded-5 shadow ms-2">GET STARTED</a>
                    </div>
                    @endauth
        </div>
    </nav>
    <!-- Navbar End -->
@endsection
{{-- Navbar Section End --}}



{{-- Footer Section Start --}}
@section('footer')
    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6">
                    <h1 class="text-white mb-4"><img class="img-fluid me-3" src="img/icon/icon-00-logo-light.png" alt="">BRIDGES</h1>
                    <span> Introduced in 2019, started up as a small business that advertised jobs to the population of Maldives.
                         Now it has grown since and has become a market that connects people who are skilled workers with the people that need day-to-day services.</span>
                </div>
                <div class="col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Subscribe to our Newsletter.</p>
                    <div class="position-relative">
                        <input class="form-control bg-transparent w-75 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Sign Up</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Get In Touch</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>H. Orchid, 402 Ameenee Magu, Malé</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+960 332-3902</p>
                    <p><i class="fa fa-envelope me-3"></i>info@bridges.com.mv</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Our Services</h5>
                    <a class="btn btn-link" href="">Become a Job Seeker</a>
                    <a class="btn btn-link" href="">Become a Job Poster</a>
                    <a class="btn btn-link" href="">Administrative</a>
                    <a class="btn btn-link" href="">Categories</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="contact.html">Contact Us</a>
                    <a class="btn btn-link" href="">Services</a>
                    <a class="btn btn-link" href="">Terms & Conditions</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Follow Us</h5>
                    <div class="d-flex">
                        <a class="btn btn-square rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square rounded-circle me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">BRIDGES 2024</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        <!-- Designed By <a href="https://htmlcodex.com">HTML Codex</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
@endsection
{{-- Footer Section Start --}}