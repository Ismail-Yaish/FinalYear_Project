<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')

    <title>BRIDGES - Edit Post</title>

</head>


<body>

    @include('posts.layouts.navbar')


{{-- Edit Post Start --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="card-title">Edit Your Post:</h2>
                <hr>
                <br>
                    <div class="card-body">
                        <div class="card mb-5">
                            <div class="card-body">

                                {{-- Edit Form Start --}}
                                <form method= "post" action = "{{route('posts.update', ['post' => $post])}}">
                                    @csrf
                                    @method('put')
                            
                                    {{-- Form fields --}}
                                    <div class="mb-3">
                                        <label for="postTitle" class="form-label fs-5"><b>Post Title</b></label>
                                        <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title" required value="{{$post->title}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="postBody" class="form-label fs-5"><b>Post Content</b></label>
                                        <textarea class="form-control" id="postBody" name="body" rows="5" placeholder="Enter post content" required>{{ strip_tags($post->body) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="postStatus" class="form-label fs-5"><b>Post Status</b></label>
                                        <select class="form-select" id="postStatus" name="status">
                                            <option value="{{$post->status}}">{{$post->status}}</option>
                                            <option value="Active">ACTIVE</option>
                                            <option value="Inactive">INACTIVE</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="postCategory" class="form-label fs-5"><b>Post Category</b></label>
                                        <select class="form-select" id="postCategory" name="category_id" required>
                                            <option value="{{$post->category->id}}">{{$post->category->name}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-primary mt-4" value="Update"></input>
                                </form>
                                {{-- Edit Form End --}}

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
{{-- Edit Post End --}}



@include('posts.layouts.footer')



@include('posts.layouts.scripts')

</body>
</html>