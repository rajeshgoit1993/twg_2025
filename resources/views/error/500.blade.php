@include('error.header')

<div class="container text-center">
    <h1 class="display-1">500</h1>
    <h2 class="display-4">Internal Server Error</h2>
    <p class="lead">Something went wrong on our end. Please try again later.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Back to Home</a>
</div>

@include('layouts.front.footer')