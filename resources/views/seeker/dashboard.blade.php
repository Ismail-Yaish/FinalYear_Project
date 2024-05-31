<!DOCTYPE html>
<html lang="en">
<head>

    @include('seeker.layouts.head')

    <title>BRIDGES - Seeker Dashboard</title>




</head>


<body>

    {{-- Include Navbar --}}
    @include ('seeker.layouts.navbar')

    {{-- Include Seeker Header --}}
    @include ('seeker.layouts.header')


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
                                {{-- Save Button --}}
                                <div class="buttons float-md-end ">
                                    <a href="" class="save-link text-decoration-none">
                                        <i class="far fa-heart"></i> Save
                                    </a>
                                </div>
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

                                {{-- View Post Detail Button --}}
                                <div class="buttons float-md-start mt-4">
                                    <a href="{{ route('seeker.view.post', ['postId' => $post->id]) }}" class="btn btn-dark">View Post</a>
                                </div>

                                <div class="clearfix"></div>

                            </div><hr>
                        </div><hr>
                        @endforeach

                        {{-- Pagination Links --}}
                        <div id="pagination-links" class="d-flex justify-content-end pagination-links">
                            {{ $posts->links() }}
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
{{-- End Displayed Posts --}}  

    {{-- Include Footer --}}
    @include('seeker.layouts.footer')


    {{-- Include Scripts --}}
    @include('seeker.layouts.scripts')    



</body>
</html>