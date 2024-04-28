<!DOCTYPE html>
<html lang="en">
<head>
	{{-- Include meta tags --}}
	@include('posts.layouts.meta')
	
    @include('posts.layouts.bootstrap')
        {{-- Bootstrap 5.3.3 & Icons --}}
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}

	{{-- Include CSS Styles --}}
	@include('posts.layouts.styles')


    <title>Create a Post - BRIDGES</title>

</head>


<body>

    {{-- Include Navbar --}}
    @include ('posts.layouts.navbar')




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
                    <div><h2>Your Active Posts</h2></div>
                    <ul class="job-list">
                        @foreach ($posts as $post)
                        {{-- Check if the author_id of the post matches the ID of the authenticated user --}}
                        @if ($post->author_id == auth()->id())
                        <li class="job-preview">
                            <div class="content">
                                <h4 class="job-title">
                                    {{ $post->title }}
                                </h4>
                                <h5 class="company">
                                    Published by: You
                                    ( {{ strip_tags($post->author->name) }} )
                                </h5>
                                {{-- Body --}}
                                <h6> {{ strip_tags($post->body) }} </h6>    
                                <h6>Category: {{ $post->category->name}}</h6>
                                <p>Status: {{ $post->status }}</p>
                                <hr>
                                <br>
                                <p>Created Date: {{ $post->created_at }}</p>
                            </div>

                            <div class="buttons float-md-start">
                                <a href="{{ route('posts.view', ['postId' => $post->id]) }}" class="btn btn-apply">View</a>
                            </div>
                    
                            {{-- Edit & Delete Form  --}}
                            <div class="buttons float-md-end">
                                
                                <a href="{{route('posts.edit', ['post' => $post])}}" class="btn btn-apply">Edit</a>
                                
                                <form id="deleteForm{{$post->id}}" method="post" action="{{route('posts.destroy', ['post' => $post ])}}" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="button" onclick="confirmDelete({{$post->id}})" class="btn btn-apply">Delete</button>
                                </form>
                            </div>
                                <div class="clearfix"></div>
                            </li>
                        @endif
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