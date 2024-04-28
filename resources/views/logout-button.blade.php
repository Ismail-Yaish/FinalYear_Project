<!-- resources/views/logout-button.blade.php -->

<style>
    .logout-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #e53e3e; /* Red color */
        color: #fff; /* White text color */
        border: none;
        border-radius: 4px;
        padding: 8px 16px; /* Adjust padding as needed */
        cursor: pointer;
    }

    .logout-button:hover {
        background-color: #c53030; /* Darker red color on hover */
    }
</style>

<!-- Logout button -->
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit" class = "logout-button">Logout</button>
</form>
