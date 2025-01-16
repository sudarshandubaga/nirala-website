@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle"
            style="background-image:url({{ $page->bg_image ?: asset('images/background/bg4.jpg') }});">
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
                        <div class="row">
                            <div class="col-lg-{{ !empty($page->image) ? 7 : 12 }} col-md-12">
                                <h1 class="m-b20" data-aos="fade-right">{{ $page->title }}</h1>
                                <div class="dez-separator bg-primary" data-aos="fade-right" ></div>
                                <div class="clear"></div>
                                <div data-aos="zoom-in">
                                    {!! $page->description !!}
                                </div>
                                
                            </div>
                            @if (!empty($page->image))
                                <div class="col-lg-5 col-md-12" data-aos="fade-up">
                                    <div class="dez-thu m-b30"><img src="{{ $page->image }}" alt=""></div>
                                </div>
                            @endif
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
