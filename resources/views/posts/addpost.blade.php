<!DOCTYPE html>
<html lang="en">
<head>
	{{-- Include meta tags --}}
	@include('seeker.layouts.meta')

    {{-- Bootstrap 5.3.3 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

    @include('posts.layouts.bootstrap')

    @include('posts.layouts.styles')

    {{-- <style>

        body {
            font-family: 'Open Sans', sans-serif;
            color: #31383d;
            font-size: 1.1rem;
        }
        
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #d7e2e9;
        }
        
        .navbar-toggler {
            border: none;
        }
        
        .navbar-brand,
        .navbar-nav .nav-link {
            color: #96a4b1;
            font-weight: 600;
            padding: 1rem 1.5rem;
        }
        
        .navbar-brand:hover,
        .navbar-nav .nav-link:hover {
            color: #73a5fc;
        }
        
        .container {
            margin-top: 5rem;
        }
        
        .btn-primary {
            background-color: #a3bded;
            border-color: #6991c7;
            color: #000000;
        }
        
        .btn-primary:hover {
            background-color: #393a5f;
            border-color: #393a5f;
        }
        
        </style> --}}

    <title>Add Post</title>
</head>

<body>

@include('posts.layouts.navbar')

{{-- <nav class="navbar navbar-toggleable-md navbar-light fixed-top" id="navbar-main">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span id="homeButton" onclick="redirectToPostsPage()" class="text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1.5a.5.5 0 0 0-.473.342l-6 18a.5.5 0 0 0 .473.658H14.5a.5.5 0 0 0 .473-.658l-6-18A.5.5 0 0 0 8 1.5zm-1 2a1.5 1.5 0 0 1 3 0v9h-3V3.5z"/>
                <path fill-rule="evenodd" d="M0 6.5A.5.5 0 0 1 .5 6h1a.5.5 0 0 1 .5.5V15h1V7.732a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354V15h1V6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5H1a.5.5 0 0 1-.5-.5v-9z"/>
            </svg>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" title="Work">
                    Work
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Jobs">
                    Jobs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Blog">
                    Blog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Contact">
                    Contact
                </a>
            </li>
        </ul>
    </div>
</nav> --}}

<div class="container mt-5" style="margin-bottom: 200px">
    <h2>What do you need help with?</h2>
    <p style="margin-bottom: 25px; color: #6991c7">Create your own Job Posting Below</p>
    <form method= "post" action = "{{route('posts.store')}}">
        @csrf
        @method('post')
        <div class="mb-3">
            <label for="postTitle" class="form-label"><b>Post Title</b></label>
            <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title" required>
        </div>
        <div class="mb-3">
            <label for="postBody" class="form-label"><b>Post Content</b></label>
            <textarea class="form-control" id="postBody" name="body" rows="5" placeholder="Enter post content" required></textarea>
        </div>
        <div class="mb-3">
            <label for="postStatus" class="form-label"><b>Post Status</b></label>
            <select class="form-select" id="postStatus" name="status" required>
                <option value="" selected disabled>Select post status</option>
                <option value="Active">ACTIVE</option>
                <option value="Inactive">INACTIVE</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="postCategory" class="form-label"><b>Post Category</b></label>
            <select class="form-select" id="postCategory" name="category_id" required>
                <option value="" selected disabled>Select post category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Set the author_id with the ID of authenticated user --}}
        <input type="hidden" name="author_id" value="{{ Auth::id() }}">
        <input type="submit" class="btn btn-primary" value="Submit"></input>
    </form>
</div>

@include ('posts.layouts.footer')


@include ('posts.layouts.scripts')

</body>
</html>




