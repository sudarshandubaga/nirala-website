@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/background/bg4.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">CMD Message</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>CMD Message</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="clearfix">
            <!-- About Company -->
            <div class="section-full bg-gray content-inner"
                style="background-image: url(images/bg-img.png); background-repeat: repeat-x; background-position: left bottom -37px;">
                <div class="container">
                    <div class="section-content">
                        @foreach ($teams as $team)
                            <div class="row mb-3">
                                <div class="col-sm-4" style="text-align: center" data-aos="fade-right">
                                    <img alt="{{ $team->name }}" src="{{ $team->image }}" class="w-100 h-100"
                                        style="object-fit: contain">
                                </div>
                                <div class="col-sm-8">
                                    <h3 data-aos="fade-down">{{ $team->name }}</h3>
                                    <p data-aos="fade-up">
                                        <strong >{{ $team->designation }}</strong>
                                    </p>
                                    <p data-aos="zoom-in">
                                        {{ $team->about }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
