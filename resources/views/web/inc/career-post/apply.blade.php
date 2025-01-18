@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/career-bg.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Career</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Career</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="clearfix">
            <!-- About Company -->
            <div class="section-full bg-white content-inner"
                style="background-image: url(images/bg-img.png); background-repeat: repeat-x; background-position: left bottom -37px;">
                <div class="container">
                    <div class="section-content">
                        <div id="stepWizardApp"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @viteReactRefresh
    @vite('resources/js/app.jsx')
@endsection
