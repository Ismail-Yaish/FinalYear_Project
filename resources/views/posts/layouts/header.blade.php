

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}




{{-- HEADER --}}
<header class="masthead text-center">
    <div class="container">
        <div class="row"> <!-- Center the row -->
            <div class="col-md-10 offset-md-1">
                <div class="site-heading">
                    <h1 class="heading">
                        WELCOME JOB POSTER!
                    </h1>
                    <hr>
                    <h2 class="sub-heading">
                        '{{ Auth::user()->name }}'
                    </h2>
                    <br>
                    <br>
                    <span class="subheading larger-font" style="font-size: 1.5rem; margin-bottom: 10px">
                        Available Categories:
                    </span>
                    <div class="d-flex flex-row justify-content-center">
                        @foreach ($categories as $category)
                            <a class="btn btn-outline-dark fs-5 fw-bold me-2" href="#">{{ $category->name }}</a>
                        @endforeach
                        <!-- Add more categories here if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>