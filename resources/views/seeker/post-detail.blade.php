<!DOCTYPE html>
<html lang="en">
<head>

    @include('seeker.layouts.head')

    <title>BRIDGES - Post Details</title>


</head>

<body>

    @include('seeker.layouts.navbar')


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
                                    Published by: <a href="{{ route('profile.view', ['postId' => $post->author_id]) }}">{{ strip_tags($post->author->name) }}</a>
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
                                {{-- RIGHT BUTTONS --}}
                                <div class="buttons float-md-end mt-4">
                                    <div class="d-flex align-items-center">
                                        {{-- View Profile Button --}}
                                        <a href="{{ route('profile.view', ['postId' => $post->author_id]) }}" class="btn btn-dark me-3">View Profile</a>
                                        {{-- BOOK THIS TASK BUTTON --}}
                                        <a href="{{ route('seeker.booking', ['postId' => $post->id]) }}" class="btn btn-primary btn-lg">BOOK THIS TASK</a>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
{{-- Single Post Detail End --}}



    @include('seeker.layouts.footer')



    @include('seeker.layouts.scripts')

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