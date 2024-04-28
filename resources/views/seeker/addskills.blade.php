<!DOCTYPE html>
<html lang="en">
<head>
    @include('seeker.layouts.meta')
    @include('seeker.layouts.bootstrap')
    @include('seeker.layouts.styles')

    <title>Add Your Skills</title>
</head>
<body>
    @include('seeker.layouts.navbar')

{{-- Add Skills Section --}}
<main>
    <section>
        <div class="container mt-5" style="margin-bottom: 300px">
            <div class="row mt-5">
                <div class="col-md-10 offset-md-1">   
                        <h2 style="margin-bottom: 2rem">Add Your Skill: </h2>
                        {{-- Skills Form --}}
                        <form method="POST" action="#">
                            {{-- Form fields --}}
                            @csrf
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
                </div>
            </div>
        </div>
    </section>
</main>








</section>


    @include('seeker.layouts.footer')
    @include('seeker.layouts.scripts')
    
</body>
</html>