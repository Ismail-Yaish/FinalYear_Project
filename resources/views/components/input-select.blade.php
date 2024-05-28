{{-- NEW BLADE COMPONENT --}}

<select {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
    {{-- <option value="1">Admin</option> --}}
    <option value="3">Poster</option>
    <option value="4">Seeker</option>
</select>