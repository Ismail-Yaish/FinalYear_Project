<!DOCTYPE html>
<html lang="en">
<head>
    @include('posts.layouts.head')
    <title>BRIDGES - Create Rating</title>
</head>
<body>
    @include('posts.layouts.navbar')

    {{-- Rating Section Start --}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Rate This Seeker: <a href="#">{{ $seeker->name }}</a></h2>
                <hr>

                <div class="col-md-6">
                    {{-- Rating Form --}}
                    <form id="ratingForm" action="{{ route('posts.ratings.store', ['seeker' => $seeker->id]) }}" method="POST" class="rating-section">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="d-none">
                                    <label for="star{{ $i }}" class="star"><i class="fas fa-star" data-rating="{{ $i }}"></i></label>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit Rating</button>
                    </form>
                </div>

                <br><br><hr><br>

                <div class="col-md-6"> 
                    {{-- Existing Ratings --}}
                    <div class="rating-section"> 
                        <h3 class="mt-5">Current User Ratings: <a href="#">{{ $seeker->name }}</a></h3>
                        @if($ratings->isEmpty())
                            <p>No ratings available for this seeker...</p>
                        @else
                            @foreach($ratings as $rating)
                                <div class="card mb-3" style="width: 53rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Rating By: <a href="#">{{ $rating->poster->name }}</a></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $rating->created_at->format('d M Y') }}</h6>
                                        <p class="card-text mt-5 mb-3">
                                            <strong>Rating:</strong> 
                                            @for($i = 1; $i <= $rating->rating; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                        </p>
                                        <p class="card-text mt-4">" {{ $rating->comment }} "</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Rating Section End --}}

    @include('posts.layouts.footer')
    @include('posts.layouts.scripts')
    
    <script>
        // Script to handle star rating interaction
        const stars = document.querySelectorAll('.rating i');

        stars.forEach((star, index) => {
            star.addEventListener('mouseover', (event) => {
                const rating = event.target.dataset.rating;
                for (let i = 0; i < stars.length; i++) {
                    if (i < rating) {
                        stars[i].classList.add('text-warning');
                    } else {
                        stars[i].classList.remove('text-warning');
                    }
                }
            });

            star.addEventListener('click', (event) => {
                const rating = event.target.dataset.rating;
                document.querySelector(`#star${rating}`).checked = true;
            });
        });

        document.getElementById('ratingForm').addEventListener('mouseout', () => {
            const checked = document.querySelector('.rating input:checked');
            const rating = checked ? checked.value : 0;
            for (let i = 0; i < stars.length; i++) {
                if (i < rating) {
                    stars[i].classList.add('text-warning');
                } else {
                    stars[i].classList.remove('text-warning');
                }
            }
        });
    </script>
</body>
</html>
