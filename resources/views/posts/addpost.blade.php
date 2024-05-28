<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')

    <title>BRIDGES - Create Post</title>

</head>


<body>

    @include('posts.layouts.navbar')

{{-- Add Post Detail Start --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="card-title">Create Your Post:</h2>
                <hr>
                <br>
                    <div class="card-body">
                        <div class="card mb-5">
                            <div class="card-body">

                                {{-- Create Form Start --}}
                                <form method= "post" action = "{{route('posts.store')}}">
                                    @csrf
                                    @method('post')
                                    {{-- Form Fields --}}
                                    <div class="mb-3">
                                        <label for="postTitle" class="form-label fs-5"><b>Post Title</b></label>
                                        <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="postBody" class="form-label fs-5"><b>Post Content</b></label>
                                        <textarea class="form-control" id="postBody" name="body" rows="5" placeholder="Enter post content" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="postStatus" class="form-label fs-5"><b>Post Status</b></label>
                                        <select class="form-select" id="postStatus" name="status" required>
                                            <option value="" selected disabled>Select post status</option>
                                            <option value="Active">ACTIVE</option>
                                            <option value="Inactive">INACTIVE</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="postCategory" class="form-label fs-5"><b>Post Category</b></label>
                                        <select class="form-select" id="postCategory" name="category_id" required>
                                            <option value="" selected disabled>Select post category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Form Fields End --}}
                            
                                    {{-- Set the author_id with the ID of authenticated user --}}
                                    <input type="hidden" name="author_id" value="{{ Auth::id() }}">
                                    <input type="submit" class="btn btn-primary mt-4" value="Submit"></input>
                                </form>
                                {{-- Create Form End --}}

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
{{-- Add Post Detail End --}}


@include('posts.layouts.footer')



@include('posts.layouts.scripts')


</body>
</html>