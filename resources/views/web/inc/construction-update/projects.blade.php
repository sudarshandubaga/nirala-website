@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url({{ asset('images/background/bg4.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Construction Update</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Construction Update</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    @foreach ($projects as $project)
                        <div class="col-md-4 col-lg-4 col-sm-6 m-b30">
                            {{-- <x-project-box :project="$project" /> --}}
                            <div class="dez-box p-a20 border-1">
                                <div class="dez-media">
                                    <a href="{{ route('construction-update.index', [$project]) }}">
                                        <img src="{{ asset('storage/' . $project->image) }}" alt=""
                                            style="object-fit: contain"></a>
                                </div>
                                <div class="dez-info text-center">
                                    <h4 class="dez-title m-t20">
                                        <a href="{{ route('construction-update.index', [$project]) }}">
                                            {{ $project->name }}</a>
                                    </h4>
                                    <p>
                                        {{ substr(html_entity_decode(strip_tags($project->description)), 0, 107) }}
                                    </p>
                                    <a href="{{ route('construction-update.index', [$project]) }}" class="site-button">Read
                                        More</a>
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
