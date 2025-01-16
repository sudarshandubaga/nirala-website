@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url({{ asset('images/background/bg4.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">{{ $mediaCategory->name }}</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>
                        {{ $mediaCategory->name }}
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    @foreach ($medias as $media)
                        <div class="col-md-4 col-lg-4 col-sm-6 m-b30">
                            <div class="card">
                                <img src="{{ $media->image }}" alt="" class="card-img-top">
                                <div class="card-body text-center">
                                    <h4>{{ $media->title }}</h4>
                                    <a href="{{ route('media.show', $media) }}" class="site-button">
                                        SEE DETAILS
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- contact area  END -->
    </div>
    <!-- Content END-->
@endsection
