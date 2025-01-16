@extends('web.layouts.app')
<style>
    .location_advantange ul li {
        font-weight: 500;
        color: rgb(24, 25, 29);
    }

    .section-container {
        position: relative;
        background: url("{{ asset('images/pic2.jpg') }}") no-repeat center center/cover;
        color: #fff;
        padding: 80px 0;
        overflow: hidden;
    }

    /* Background Overlay */
    .section-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.6);
        /* Transparent black */
        z-index: 1;
    }

    /* Ensures content stays above the overlay */
    .section-container .container {
        position: relative;
        z-index: 2;
    }

    .text-content {
        max-width: 500px;
        padding: 20px;
    }

    .info-cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .info-card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: background 0.3s ease;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 5px;
    }

    .info-card:hover {
        background: rgba(46, 204, 113, 0.6);
    }

    .info-card i {
        font-size: 40px;
        color: #2ecc71;
        margin-bottom: 10px;
    }

    .info-card h5 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .info-card p {
        font-size: 14px;
    }
</style>
@section('main_contents')
    {{-- {{ dd($phase?->project?->category?->name) }} --}}
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle"
            style="background-image: url({{ !empty($phase->project->bg_image) ? asset('storage/' . $phase->project->bg_image) : asset('images/background/bg4.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                   <h1 class="text-white">{{ $phase->name }}</h1>
                    {{-- <h1 class="text-white">NIRALA ESTATE</h1> --}}
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
                        <a href="{{ route('phase.index', $phase->category) }}">
                            {{ $phase->project->category->name }}
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phase.index', ['project' => $phase->project]) }}">
                            {{ $phase->project->name }}
                        </a>
                    </li>
                    <li>{{ $phase->name }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <div class="row">
            <div class="col-lg-12 col-md-12 bg-gray p-lr0 box-services">
               @if ($phase->name == 'NIRALA TRIO')
                    <iframe width="560" height="285"
                        src="https://www.youtube.com/embed/WOGx-pF54Fw?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @elseif($phase->name == 'NIRALA ESTATE')
                    <iframe width="560" height="285"
                        src="https://www.youtube.com/embed/{{ $site->video_id }}?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @endif

            </div>
        </div>
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div>
                <div class="product-details">
                    <section class="pb-5">
                        @include('web.inc.phase.inc.overview')
                    </section>
                    @if ($phase?->project?->category?->name != 'Completed')
                        <section class="py-5" style="background:#FDF7F4;">
                            @include('web.inc.phase.inc.location_map')
                        </section>
                        <section class="py-5">
                            @include('web.inc.phase.inc.profile_layout')
                        </section>
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center fw-bold mb-4">Luxury Amenities</h2>
                                <div class="row g-4">
                                    <!-- Commercial Plaza -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/building.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Commercial Plaza</h6>
                                        </div>
                                    </div>
                                    <!-- Jacuzzi -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/jacuzzi.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Jacuzzi</h6>
                                        </div>
                                    </div>
                                    <!-- SPA -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/massage.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">SPA</h6>
                                        </div>
                                    </div>
                                    <!-- Gym -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/weightlifter.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Gym</h6>
                                        </div>
                                    </div>
                                    <!-- Kids Play Area -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/playground.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Kids Play Area</h6>
                                        </div>
                                    </div>
                                    <!-- Yoga Meditation Pavilion -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <i class="fa fa-pray fa-2x text-primary mb-3"></i>
                                            <img src="{{asset('images/icons/meditation.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Yoga Meditation Pavilion</h6>
                                        </div>
                                    </div>
                                    <!-- Badminton Court -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/badminton-court.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Badminton Court</h6>
                                        </div>
                                    </div>
                                    <!-- Banquet Hall -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/hall.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Banquet Hall</h6>
                                        </div>
                                    </div>
                                    <!-- Party Lawn -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/garlands.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Party Lawn</h6>
                                        </div>
                                    </div>
                                    <!-- Swimming Pool -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <img src="{{asset('images/icons/swimming.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Swimming Pool</h6>
                                        </div>
                                    </div>
                                    <!-- Kids Pool -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <i class="far fa-water fa-2x text-primary mb-3"></i>
                                            <img src="{{asset('images/icons/swimming-pool.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Kids Pool</h6>
                                        </div>
                                    </div>
                                    <!-- Open Theatre -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card text-center p-3 h-100 border-0 shadow-sm">
                                            <i class="far fa-water fa-2x text-primary mb-3"></i>
                                            <img src="{{asset('images/icons/theater.png')}}" style="height: 50px;object-fit:contain;">
                                            <h6 class="fw-bold">Open Theatre</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="py-5" style="background:#F2F9FF;">
                            @include('web.inc.phase.inc.price_plan')
                        </section>
                        <section class="py-5" style="background:#F2F9FF;">
                            @include('web.inc.phase.inc.unit_plans')
                        </section>
                        <section class="py-5" style="background:#fff;">
                            <div class="container">


                                <div class="row">
                                    <div class="col-md-5">
                                        <img src="{{ asset('images/specification.png') }}" alt=""
                                            data-aos="fade-right">
                                    </div>
                                    <div class="col-md-7 location_advantange">
                                        <h2 data-aos="fade-left">Specifications</h2>
                                        <div class="dez-separator-outer">
                                            <div class="dez-separator bg-danger style-skew" data-aos="fade-right"></div>
                                        </div>
                                        <h3 data-aos="fade-in">Modern & premium apartments</h3>
                                        <p>Nirala World residences in Noida have a stunning and exceptionally designed
                                            master plan. The project features:</p>
                                        <div class="row">
                                            <div class="location_advantange">
                                                {!! $phase->specification !!}
                                            </div>
                                        </div>


                                    </div>
                                </div>


                            </div>
                        </section>
                    @endif
                    {{-- <section class="section-container">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="text-content">
                                        <p data-aos="zoom-in">GET TO KNOW US</p>
                                        <h1 class="text-white" data-aos="fade-left">Modern & Luxury Living Complexes</h1>
                                        <a href="#" class="btn btn-success" data-aos="zoom-in">KNOW MORE</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-cards">
                                        <div class="info-card" data-aos="flip-left">
                                            <i class="fa fa-building"></i>
                                            <h5 class="text-white">Luxury Living</h5>
                                        </div>
                                        <div class="info-card" data-aos="flip-left">
                                            <i class="fa fa-hotel"></i>
                                            <h5 class="text-white">Amenities Buildings</h5>
                                        </div>
                                        <div class="info-card" data-aos="flip-left">
                                            <i class="fa fa-map"></i>
                                            <h5 class="text-white">Center Downtown</h5>
                                        </div>
                                        <div class="info-card" data-aos="flip-left">
                                            <i class="fa fa-tv"></i>
                                            <h5 class="text-white">Contemporary Lifestyle</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> --}}

                    <section class="py-5 bg-white">
                        @include('web.inc.phase.inc.views')
                    </section>
                    @if ($phase?->project?->category?->name != 'Completed')
                        <section class="py-5">
                            @include('web.inc.phase.inc.download')
                        </section>
                        {{-- <section class="" id="payment-plan" style="background:#FDF7F4;">
                            @include('web.inc.phase.inc.payment_plans')
                        </section> --}}
                        {{-- <section class="py-5" id="price-list">
                            @include('web.inc.phase.inc.price_list')
                        </section> --}}
                        <div class="container-fluid">
                            <div class="row no-gutters">
                                <div class="col-md-7">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.722543808531!2d77.3722512!3d28.6080993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce50069738d83%3A0xcd0b1f4fef051e45!2sNirala%20World!5e0!3m2!1sen!2sin!4v1714802919612!5m2!1sen!2sin"
                                        style="border:0; width:100%; min-height:350px; height: 100%;" allowfullscreen
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                <div class="col-md-5">
                                    <div class="p-a30 bg-gray clearfix m-b30 rounded border">
                                        <h2 data-aos="fade-left">Contact Us</h2>
                                        <div class="dez-separator-outer " data-aos="fade-left">
                                            <div class="dez-separator bg-danger  style-skew"></div>
                                        </div>
                                        {{ Form::open(['url' => route('contact.store'), 'files' => true]) }}
                                        <x-alert />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input name="name" type="text" required class="form-control"
                                                            placeholder="Your Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input name="email" type="email" class="form-control" required
                                                            placeholder="Your Email Id">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input name="phone" type="text" required class="form-control"
                                                            placeholder="Phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input name="subject" type="text" required class="form-control"
                                                            placeholder="Subject">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <textarea name="message" rows="10" class="form-control" required placeholder="Your Message..."
                                                            style="height: 170px"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button name="submit" type="submit" value="Submit"
                                                    class="site-button ">
                                                    <span>Submit</span>
                                                </button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('extra_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"
        integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Select all <ul> elements inside the element with class "location_advantange"
            const locationAdvantageLists = document.querySelectorAll('.location_advantange ul');

            // Iterate through each <ul> element and add the desired classes
            locationAdvantageLists.forEach(ul => {
                ul.classList.add('list-check-circle', 'primary');
            });
        });
    </script>
@endpush

@push('extra_styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css"
        integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
