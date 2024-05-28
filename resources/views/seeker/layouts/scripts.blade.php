{{-- <!-- JavaScript Libraries --> --}}
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('lib/parallax/parallax.min.js') }}"></script>

{{-- <!-- Updated Bootstrap 5.3.3 bundle JS --> --}}
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


{{-- Template Javascript --}}
<script src="{{ asset('js/main.js') }}"></script>

     {{-- Include flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



    {{-- Additional JavaScript --}}
    <script>

        function confirmDelete(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                document.getElementById('deleteForm' + postId).submit();
            }
        }

        // Initialize flatpickr with desired options
        flatpickr("#BookingDate", {
            enableTime: true,
            dateFormat: "Y-m-d H:i:S", // Set the desired date format
        });


        // Pagination Navigation Scroll Maintain
        $(document).ready(function() {
            // Delegate click event to a static parent element
            $(document).on('click', '#pagination-links a', function(event) {
                event.preventDefault();
                
                var url = $(this).attr('href');
                if (url) {
                    $('#loader').show();
                    $.get(url, function(data) {
                        var newContent = $(data).find('#posts-container').html();
                        var newPaginationLinks = $(data).find('#pagination-links').html();
                        $('#posts-container').html(newContent);
                        $('#pagination-links').html(newPaginationLinks); // Update pagination links
                        // Update the URL in the browser
                        window.history.pushState({ path: url }, '', url);
                        // Scroll to posts-section
                        $('html, body').animate({
                            scrollTop: $('#posts-section').offset().top
                        }, 1000);
                    }).fail(function() {
                        alert('Failed to load data.');
                    }).always(function() {
                        $('#loader').hide();
                    });
                }
            });
        });



    </script>