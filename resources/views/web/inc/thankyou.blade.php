@extends('web.layouts.app')

@section('main_contents')
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/background/bg4.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white text-center">{{ $page->title }}</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container d-flex flex-column justify-content-center align-items-center text-center"
                style="min-height: 50vh;">
                <h1 class="mb-2">Thank You</h1>
                <div class="mb-5">
                    Your application details have been sent, HR Team will contact you shortly.
                </div>
                <div>
                    <a href="{{ route('home') }}" class="site-button">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
@endsection
