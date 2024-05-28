{{-- NOT FULLY ADDED YET --}}


<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')

    <title>BRIDGES - Add Skills</title>

</head>

<body>

    @include('posts.layouts.navbar')

{{-- Add Skills Section --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="card-title">Add Your Skill:</h2>
                <hr>
                <br>
                    <div class="card-body">
                        <div class="card mb-5">
                            <div class="card-body">

                                {{-- Skills Form Start --}}
                                <form method="POST" action="{{ route ('seeker.profile') }}">
                                    {{-- Form fields --}}
                                    @csrf
                                    @method('get')
                                    <div class="mb-3">
                                        <label for="skillCategory" class="form-label"><b>Skill Category</b></label>
                                        <select class="form-select" id="skillCategory" name="category_id" required>
                                            <option value="" selected disabled>Select skill category</option>
                                            {{-- @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach --}}
                                            <option value="1">Furniture Assembler</option>
                                            <option value="3">Mover</option>
                                            <option value="4">Utility Repairman</option>
                                        </select>
                                    </div>
                                    @error('skill')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <br>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submit"></input>
                                </form>
                                {{-- Skills Form End --}}

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</section>


    @include('seeker.layouts.footer')




    @include('seeker.layouts.scripts')
    
</body>
</html>