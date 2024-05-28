<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')

    <title>BRIDGES - My Posts</title>

</head>

<body>

    @include('posts.layouts.navbar')


<!-- {{-- Create Post Section Start --}} -->
<section class="mt-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-center">
                <a href="{{ route('posts.addpost') }}" class="btn btn-primary" style="box-shadow: 0px 12px 12px 0px rgba(0, 0.5, 0.1, 0.1);""> <i class="fa fa-plus" aria-hidden="true"></i>  Create Post </a>
            </div>
        </div>
    </div>
</section>
<!-- {{-- Create Post Section End--}} -->


{{-- Displayed Posts Section --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="card-title">Your Posts</h2>
                <hr>
                <br>

                <div class="card-body">
                    @if ($posts->isEmpty())
                        <div class="text-center mt-3" style="margin-bottom: 60vh">
                            <p class="fs-4">You have not created any Post</p>
                        </div>
                    @else

                        @foreach ($posts as $post)
                        @if ($post->author_id == auth()->id())
                        <div class="card mb-5">
                            <div class="card-body">
                                {{-- Title --}}
                                <h4 class="card-title">{{ $post->title }}</h4>
                                {{-- Published by --}}
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Published by: <a href="{{ route('profile.view.poster', ['postId' => $post->author_id]) }}">{{ strip_tags($post->author->name) }}</a>
                                </h6>
                                <br><br>
                                {{-- Body --}}
                                <p class="card-text">{{ strip_tags($post->body) }}</p>
                                <br><br>
                                {{-- Category --}}
                                <p class="card-text"><strong>Category: <span style="font-weight: normal;">{{ $post->category->name }}</span></strong></p>
                                {{-- Status --}}
                                <p class="card-text"><strong>Status: <span style="font-weight: normal;">{{ $post->status }}</span></strong></p>
                                <hr class="my-2">
                                {{-- Created Date --}}
                                <p class="card-text"><strong>Created Date: {{ $post->created_at }}</strong></p>

                                {{-- Buttons --}}
                                {{-- View Post Detail Button --}}
                                <div class="buttons float-md-start mt-4">
                                    <a href="{{ route('posts.view', ['postId' => $post->id]) }}" class="btn btn-primary">View</a>
                                </div>

                                {{-- View Profile Button - DISCARDED --}}
                                {{-- <div class="buttons float-md-start mt-4 ms-2">
                                    <a href="{{ route('profile.view.poster', ['postId' => $post->author_id]) }}" class="btn btn-primary me-2">View Profile</a>
                                </div> --}}

                                {{-- Edit / Delete Post Button --}}
                                <div class="buttons float-md-end mt-4">

                                    {{-- Edit Button --}}
                                    <a href="{{route('posts.edit', ['post' => $post])}}" class="btn btn-warning me-1">Edit</a>
                                    
                                    {{-- Delete Form --}}
                                    <form id="deleteForm{{$post->id}}" method="post" action="{{route('posts.destroy', ['post' => $post ])}}" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="confirmDelete({{$post->id}})" class="btn btn-danger">Delete</button>
                                    </form>
                                    
                                </div>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                        @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
{{-- End Displayed Posts --}}


@include('posts.layouts.footer')


@include('posts.layouts.scripts')

{{-- Additional JavaScript --}}
<script>
    function confirmDelete(postId) {
    if (confirm("Are you sure you want to delete this post?")) {
        document.getElementById('deleteForm' + postId).submit();
    }
}
</script>

</body>
</html>