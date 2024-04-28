    {{-- JAVASCRIPT & OTHER SCRIPT FILES --}}
    
    
    {{-- JS Boostrap5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Bootstrap bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



    {{-- JavaScript --}}
    <script>
        // JavaScript function to redirect to back to dashboard page
        // function redirectToHomePage() {
        //   window.location.href = "{{ route('dashboard') }}";     //Return to main dashboard (Unused)
        // }

        function redirectToCreatePostPage() {
            window.location.href = "{{route('posts.addpost')}}";
        }

        function confirmDelete(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                document.getElementById('deleteForm' + postId).submit();
            }
        }



    </script>