<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('posts.layouts.bootstrap')

    @include('posts.layouts.styles')

    <title>View Post</title>
</head>

<body>

    @include('posts.layouts.navbar')



{{-- Singe Post Detail --}}
<div class="container mt-5" style="margin-bottom: 200px">
    <h2>Post Detail:</h2>
    <hr>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="content">
                            <h4 class="job-title">
                                Title: {{ $post->title }}
                            </h4>
                            <h5 class="company">
                                Published by: {{ $post->author->name }}
                            </h5>
                            {{-- Body --}}
                            <p><b>Description:-</b></p>
                            <p>{{ $post->body }}</p>
                            <p><b>Category: </b> {{ $post->category->name }}</p>
                            <p><b>Status: </b>  {{ $post->status }}</p>
                            <hr>
                            <p><b>Created Date: </b>  {{ $post->created_at }}</p>
                        </div>

                        @if ($post->author_id == auth()->id())
                        {{-- Edit & Delete Form  --}}
                        <div class="buttons float-md-end">
    
                            <a href="{{route('posts.edit', ['post' => $post])}}" class="btn btn-apply">Edit</a>
                            
                            <form id="deleteForm{{$post->id}}" method="post" action="{{route('posts.destroy', ['post' => $post ])}}" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="confirmDelete({{$post->id}})" class="btn btn-apply">Delete</button>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    <hr>
</div>

@include('posts.layouts.footer')

@include ('posts.layouts.scripts')

</body>
</html>




