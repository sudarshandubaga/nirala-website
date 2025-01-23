@extends('web.layouts.app')

@section('main_contents')
    <div class="container d-flex flex-column justify-content-center align-items-center text-center" style="min-height: 50vh;">
        <h1 class="mb-2">Thank You</h1>
        <div class="mb-5">
            Your application details have been sent, HR Team will contact you shortly.
        </div>
        <div>
            <a href="{{ route('home') }}" class="site-button">Go to Homepage</a>
        </div>
    </div>
@endsection
