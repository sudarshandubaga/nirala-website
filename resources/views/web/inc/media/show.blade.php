@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle"
            style="background-image: url({{ asset('images/background/bg4.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">{{ $media->title }}</h1>
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
                        <a href="{{ route('media.index', $media->mediaCategory) }}">
                            {{ $media->mediaCategory->name }}
                            Projects
                        </a>
                    </li>
                    <li>{{ $media->title }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="{{ $media->image }}" alt="" class="w-100">
                    </div>
                    <div class="col-sm-6">
                        <h2>{{ $media->title }}</h2>
                        <div>
                            {!! $media->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
