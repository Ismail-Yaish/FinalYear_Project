<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')
    
    <title>BRIDGES - Poster Dashboard</title>

</head>


<body>

    @include('posts.layouts.navbar')
    
    @include('posts.layouts.header')


<!-- {{-- Create Post Button Start --}} -->
<section class="mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-center">
                <a href="{{ route('posts.addpost') }}" class="btn btn-primary" style="box-shadow: 0px 12px 12px 0px rgba(0, 0.5, 0.1, 0.1);""> <i class="fa fa-plus" aria-hidden="true"></i> Post Your Task </a>
            </div>
        </div>
    </div>
</section>
<!-- {{-- Create Post Button End--}} -->


{{-- Displayed Posts Section --}}
<section id="posts-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 mt-4">
                <h2 class="card-title">Current Active Posts</h2>
                <hr>
                    {{-- Pagination Links --}}
                    <div id="pagination-links" class="d-flex justify-content-end pagination-links">
                        {{ $posts->links() }}
                    </div>
                <br>

                {{-- Posts Container --}}
                <div id="posts-container">
                    <div class="card-body">
                        @foreach ($posts as $post)
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

                                <div class="buttons float-md-end mt-4">
                                    {{-- View Poster Profile Button --}}
                                    <a href="{{ route('profile.view.poster', ['postId' => $post->author_id]) }}" class="btn btn-primary me-2">View Profile</a>
                                    {{-- Fake Like Button --}}
                                    <a href="#" class="btn btn-outline-danger">Like <i class="fas fa-heart"></i></a>
                                </div>

                                {{-- View Post Detail Button --}}
                                <div class="buttons float-md-start mt-4">
                                    <a href="{{ route('posts.view', ['postId' => $post->id]) }}" class="btn btn-primary">View</a>
                                </div>

                                <div class="clearfix"></div>
                                <div class="float-md-end mt-3"><p style="font-size: 12px">[If you would like to edit your own post go to MY POSTS]</p></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                    <div id="loader" style="display: none; text-align: center;">Loading...</div>

            </div>
        </div>
    </div>
</section>
{{-- End Displayed Posts --}}


    @include('posts.layouts.footer')

    @include('posts.layouts.scripts')


    


</body>
</html>