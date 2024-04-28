<!DOCTYPE html>
<html lang="en">
<head>
	{{-- Include meta tags --}}
	@include('posts.layouts.meta')
	
    @include ('posts.layouts.bootstrap')

	{{-- Include CSS Styles --}}
	@include('posts.layouts.styles')


    <title>Create a Post - BRIDGES</title>

</head>


<body>

    {{-- Include Navbar --}}
    @include ('posts.layouts.navbar')

    {{-- Include Header --}}
    @include ('posts.layouts.header')


    {{-- Create Post Section --}}
    <section>
        <div class="container">
            <div class="row justify-content-center align-items-center border">
                <div class="col-md-6 text-center">
                    <button class="btn btn-primary" style="background-color: #73a5fc" onclick="redirectToCreatePostPage()">Create Your Task</button>
                </div>
            </div>
        </div>
    </section>

    {{-- Success Message on Edit --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fixed-top w-100" role="alert" id="successAlert">
        {{ session('success') }}

    </div>
    <script>
        // Automatically close the alert after 5 seconds
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000); // Adjust the time as needed (in milliseconds)
    </script>
    @endif

    {{-- Error Message on Un-Authenticated User Edit --}}
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fixed-top w-100" role="alert" id="error">
        {{ session('error') }}

    </div>
    <script>
        // Automatically close the alert after 5 seconds
        setTimeout(function() {
            document.getElementById('error').style.display = 'none';
        }, 3000); // Adjust the time as needed (in milliseconds)
    </script>
    @endif


    {{-- Displayed Posts Section --}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div><h2>Current Active Posts</h2></div>
                    <ul class="job-list">
                        @foreach ($posts as $post)
                        <li class="job-preview">
                            <div class="content">
                                <h4 class="job-title">
                                    {{ $post->title }}
                                </h4>
                                <h5 class="company">
                                Published by: <a href="{{ route('profile.view.poster', ['postId' => $post->author_id]) }}"> {{ strip_tags($post->author->name) }} </a>
                                </h5>
                                {{-- Body --}}
                                <h6> {{ strip_tags($post->body) }} </h6>    
                                <h6>Category: {{ $post->category->name}}</h6>
                                <p>Status: {{ $post->status }}</p>
                                <hr>
                                <br>
                                <p>Created Date: {{ $post->created_at }}</p>
                            </div>

                            {{-- Buttons --}}
                            <div class="buttons float-md-end">
                                
                                <a href="{{ route('profile.view.poster', ['postId' => $post->author_id]) }}" class="btn btn-apply"> View Profile </a>
                                {{-- Fake Like Button --}}
                                <a href="#" class="btn btn-apply">Like <i class="fa-solid fa-heart"></i></a>
                                
                            </div>
                            
                            <div class="clearfix"></div>
                            <div class="float-md-end"><p style="font-size: 12px">[If you would like to edit your own post go to MY POSTS]</p></div>
                        </li>
                        
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Include Footer --}}
    @include ('posts.layouts.footer')


    {{-- Include Scripts --}}
    @include ('posts.layouts.scripts')

</body>
</html>