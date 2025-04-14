@include('error.header')

<div class="container text-center">
    <h1 class="display-1">400</h1>
    <h2 class="display-4">Bad Request</h2>
    <p class="lead">The request could not be understood by the server due to malformed syntax.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Back to Home</a>
</div>

@include('layouts.front.footer')