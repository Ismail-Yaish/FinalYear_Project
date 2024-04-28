{{-- BootStrap 5.3.3 --}}

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}


{{-- HEADER --}}
<header class="masthead text-center">
    <div class="container">
        <div class="row"> <!-- Center the row -->
            <div class="col-md-10 offset-md-1">
                <div class="site-heading">
                    <h1 class="heading">
                        WELCOME JOB SEEKER
                    </h1>
                    <hr>
                    <h2 class="sub-heading">
                        '{{ Auth::user()->name }}'
                    </h2>
                    <br>
                    <span class="subheading larger-font" style="font-size: 1.5rem; margin-bottom: 10px">
                        TO GET STARTED, CHOOSE A POST AVAILABLE BELOW:
                    </span>
                        {{-- Create Post Section --}}
                            <div class="container">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-6 text-center">
                                        <a class="btn btn-success btn-lg" style=" font-size: 1.5rem; margin-bottom: 10px; text-decoration: none" href="#">CLICK THIS TO BOOK A CLIENT</a>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</header>