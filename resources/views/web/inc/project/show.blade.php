@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle"
            style="background-image: url({{ !empty($project->bg_image) ? asset('storage/' . $project->bg_image) : asset('images/background/bg4.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">{{ $project->name }}</h1>
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
                        <a href="{{ route('project.phase', $project->category) }}">
                            {{ $project->category->name }}
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('project.index', [$project->category, $project->phase]) }}">
                            {{ $project->phase->name }}
                        </a>
                    </li>
                    <li>{{ $project->name }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div>
                <div class="product-details">
                    <section class="py-5">
                        @include('web.inc.project.inc.overview')
                    </section>
                    <section class="py-5">
                        @include('web.inc.project.inc.location_map')
                    </section>
                    <section class="py-5">
                        @include('web.inc.project.inc.profile_layout')
                    </section>
                    <section class="py-5">
                        @include('web.inc.project.inc.unit_plans')
                    </section>
                    <section class="py-5">
                        <div class="container">
                            <h2>Specifications</h2>
                            {!! $project->specification !!}
                        </div>
                    </section>
                    <section class="py-5">
                        @include('web.inc.project.inc.views')
                    </section>
                    <section class="py-5">
                        @include('web.inc.project.inc.download')
                    </section>
                    <section class="py-5" id="payment-plan">
                        @include('web.inc.project.inc.payment_plans')
                    </section>
                    <section class="py-5" id="price-list">
                        @include('web.inc.project.inc.price_list')
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
