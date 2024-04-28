<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dev Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in") }}           as               '{{ Auth::user()->name }}' !
                </div>

                {{-- Admin Dashboard Button --}}
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button class="buttons" id="myButton">Admin Dashboard</button>
                </div>
                
                {{-- Poster Dashboard Button --}}
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button class="buttons"  id="myButton2">Poster Dashboard</button>
                </div>

                {{-- Seeker Dashboard Button --}}
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button class="buttons" id="myButton3">Seeker Dashboard</button>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>




<style>
.buttons {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
}



</style>


<script>
document.getElementById("myButton").addEventListener("click", function() {
    window.location.href = "http://finalyear_project.test/admin/dashboard";
});

document.getElementById("myButton2").addEventListener("click", function() {
    window.location.href = "http://finalyear_project.test/posts";
});

document.getElementById("myButton3").addEventListener("click", function() {
    window.location.href = "http://finalyear_project.test/seeker/dashboard";
});

</script>