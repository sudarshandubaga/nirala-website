@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle"
            style="background-image:url({{ !empty($project->bg_image) ? asset('storage/' . $project->bg_image) : asset('images/background/bg4.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">{{ $category->name }} Projects</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $category->name }} Projects</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    @foreach ($phases as $phase)
                        <div class="col-md-4 col-lg-4 col-sm-6 m-b30">
                            <div class="category-block text-center">
                                <h4 class="dez-title m-t20">
                                    {{ $phase->name }}
                                </h4>
                                <a href="{{ route('project.index', [$category, $phase]) }}"></a>
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


@section('extra_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"
        integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
