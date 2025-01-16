@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
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
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $page->title }}</li>
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
                        <div class="text-center pb-3">
                            <img src="{{ asset('images/rera_logo.png') }}" alt="RERA">
                        </div>
                        <h1 class="m-b20 text-center">{{ $page->title }}</h1>
                        <div class="dez-separator d-block bg-primary mx-auto"></div>
                        <div class="clear"></div>

                        <div class="text-center py-5">
                            <a class="btn btn-outline-primary hightlight-btn rounded-pill px-5"
                                title="Uttar Pradesh Real Estate Regulatory Authority" href="https://www.up-rera.in"
                                target="_blank" rel="noopener">
                                www.up-rera.in
                            </a>
                        </div>

                        <div>
                            {!! $page->description !!}
                        </div>

                    </div>
                </div>
            </div>
            <!-- About Company END -->
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection
