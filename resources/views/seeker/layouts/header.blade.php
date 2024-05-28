{{--  Header Start  --}}
<header class="masthead text-center mt-2">
    <div class="container">
        <div class="row"> 
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
                    <br>
                    <span class="subheading larger-font" style="font-size: 1.5rem; margin-bottom: 10px">
                        Available Categories:
                    </span>
                    <div class="d-flex flex-wrap justify-content-center align-items-center">
                        @foreach ($categories as $category)
                            <div class="col-md-auto mb-2 me-2">
                                <a class="btn btn-outline-dark fs-5 fw-bold scroll-to-middle" href="#">{{ $category->name }}</a>
                            </div>
                        @endforeach 
                    </div>
                    <div class="d-flex flex-wrap justify-content-center align-items-center">
                        <div class="col-md-auto mt-5">
                            <a href="#" class="btn btn-outline-secondary scroll-to-middle"> <i class="fa fa-arrow-down" aria-hidden="true"></i> 
                                Select a Post Below</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
{{--  Header End  --}}

{{-- <!-- Back to Top --> --}}
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>