@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url({{ asset('images/background/bg4.jpg') }});">
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
            <div class="container">

                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" data-toggle="pill" data-target="#overview" type="button">
                                Overview
                            </button>
                            <button class="nav-link" data-toggle="pill" data-target="#location-map" type="button">
                                Location Map
                            </button>
                            <button class="nav-link" data-toggle="pill" data-target="#profile-layout" type="button">
                                Profile Layout
                            </button>
                            <button class="nav-link" data-toggle="pill" data-target="#unit-plan" type="button">
                                Unit Plan
                            </button>
                            <button class="nav-link" data-toggle="pill" data-target="#specification" type="button">
                                Specification
                            </button>
                            <button class="nav-link" data-toggle="pill" data-target="#views" type="button">
                                Views
                            </button>
                            <button class="nav-link" data-toggle="pill" data-target="#download" type="button">
                                Download
                            </button>
                            <button class="nav-link" data-toggle="pill" data-target="#payment-plan" type="button">
                                Payment Plan
                            </button>
                            <button class="nav-link" data-toggle="pill" data-target="#price-list" type="button">
                                Price List
                            </button>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="overview">
                                @include('web.inc.project.inc.overview')
                            </div>
                            <div class="tab-pane fade" id="location-map">
                                @include('web.inc.project.inc.location_map')
                            </div>
                            <div class="tab-pane fade" id="profile-layout">
                                @include('web.inc.project.inc.profile_layout')
                            </div>
                            <div class="tab-pane fade" id="unit-plan">
                                @include('web.inc.project.inc.unit_plans')
                            </div>
                            <div class="tab-pane fade" id="specification">
                                {!! $project->specification !!}
                            </div>
                            <div class="tab-pane fade" id="views">
                                @include('web.inc.project.inc.views')
                            </div>
                            <div class="tab-pane fade" id="download">
                                @include('web.inc.project.inc.download')
                            </div>
                            <div class="tab-pane fade" id="payment-plan">
                                @include('web.inc.project.inc.payment_plans')
                            </div>
                            <div class="tab-pane fade" id="price-list">
                                @include('web.inc.project.inc.price_list')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
