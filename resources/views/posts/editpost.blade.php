<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Include meta tags --}}
    @include('posts.layouts.meta')

    {{-- Include Boostrap --}}
    @include('posts.layouts.bootstrap')

    {{-- Include CSS Styles --}}
    @include('posts.layouts.styles')


    <title>Edit Post</title>
</head>

<body>

    {{-- Include Navbar --}}
    @include('posts.layouts.navbar')



<div class="container mt-5" style="margin-bottom: 200px">
    <h2 style="margin-bottom: 2rem">Edit Your Post</h2>

    <form method= "post" action = "{{route('posts.update', ['post' => $post])}}">
        @csrf
        @method('put')

        {{-- Form fields --}}
        <div class="mb-3">
            <label for="postTitle" class="form-label"><b>Post Title</b></label>
            <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title" required value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="postBody" class="form-label"><b>Post Content</b></label>
            <textarea class="form-control" id="postBody" name="body" rows="5" placeholder="Enter post content" required>{{ strip_tags($post->body) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="postStatus" class="form-label"><b>Post Status</b></label>
            <select class="form-select" id="postStatus" name="status">
                <option value="{{$post->status}}">{{$post->status}}</option>
                <option value="Active">ACTIVE</option>
                <option value="Inactive">INACTIVE</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="postCategory" class="form-label"><b>Post Category</b></label>
            <select class="form-select" id="postCategory" name="category_id" required>
                <option value="{{$post->category->id}}">{{$post->category->name}}</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Update"></input>
    </form>
</div>

@include('posts.layouts.footer')

@include ('posts.layouts.scripts')

</body>
</html>




