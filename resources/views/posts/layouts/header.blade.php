{{--  Header Start  --}}
<header class="masthead text-center mt-2">
    <div class="container">
        <div class="row"> 
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
                        Categories:
                    </span>
                    <div class="d-flex flex-wrap justify-content-center align-items-center">
                        @foreach ($categories as $category)
                            <div class="col-md-auto mb-2 me-2">
                                <a class="btn btn-outline-dark fs-5 fw-bold scroll-to-middle" href="#">{{ $category->name }}</a>
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
{{--  Header End  --}}