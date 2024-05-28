<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')

    <title>BRIDGES - Post Details</title>


</head>

<body>

    @include('posts.layouts.navbar')


{{-- Single Post Detail Start --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="card-title">Post Details:</h2>
                <hr>
                <br>
                    <div class="card-body">
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

                                {{-- Edit / Delete Post Button with Auth --}}
                                @if ($post->author_id == auth()->id())
                                <div class="buttons float-md-end mt-4">
                                    <a href="{{route('posts.edit', ['post' => $post])}}" class="btn btn-warning me-2">Edit</a>
                                    
                                    <form id="deleteForm{{$post->id}}" method="post" action="{{route('posts.destroy', ['post' => $post ])}}" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="confirmDelete({{$post->id}})" class="btn btn-danger ms-2">Delete</button>
                                    </form>
                                </div>
                                @else
                                <div class="buttons float-md-start mt-4">
                                    {{-- View Poster Profile Button --}}
                                    <a href="{{ route('profile.view.poster', ['postId' => $post->author_id]) }}" class="btn btn-primary me-2">View Profile</a>
                                    {{-- Fake Like Button --}}
                                    <a href="#" class="btn btn-outline-danger">Like <i class="fas fa-heart"></i></a>
                                </div>
                                @endif

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
{{-- Single Post Detail End --}}



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