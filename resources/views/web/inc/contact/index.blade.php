@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/background/bg4.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Contact Us</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Contact us</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                @if (request('type') == 'site')
                    <div class="row">
                        @foreach ($site->offices as $office)
                            <div class="col-lg-12">
                                <h3>{{ $office['office_name'] }}</h3>
                                <div class="icon-bx-wraper bx-style-1 p-a30 d-flex align-items-center rounded m-b20">
                                    <div class="icon-xl text-primary">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="icon-content">
                                        <h5 class="dez-tilte text-uppercase">Address</h5>
                                        <p>{{ $office['address'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row">
                        <!-- Left part start -->
                        <div class="col-lg-6">
                            <div class="p-a30 bg-gray clearfix m-b30 rounded border">
                                <h2>Send Message Us</h2>
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
                                        <button name="submit" type="submit" value="Submit" class="site-button ">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                        <!-- Left part END -->
                        <!-- right part start -->
                        <div class="col-lg-6 m-b30">
                            <h3>REGISTERED OFFICE</h3>
                            <div class="icon-bx-wraper bx-style-1 p-a30 d-flex align-items-center rounded m-b20">
                                <div class="icon-xl text-primary">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="icon-content">
                                    <h5 class="dez-tilte text-uppercase">Address</h5>
                                    <p>G- 83/207, Vijay Chowk, Laxmi Nagar, Delhi-110092.</p>
                                </div>
                            </div>

                            <h3>CORPORATE OFFICE</h3>
                            <div class="icon-bx-wraper bx-style-1 rounded m-b20">
                                <div class="d-flex align-items-center border-bottom p-b20 p-a20">
                                    <div class="icon-xl text-primary">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="icon-content">
                                        <h5 class="dez-tilte text-uppercase">Address</h5>
                                        <p>{{ $site->address }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center border-bottom p-b20 p-a20">
                                    <div class="icon-xl text-primary">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="icon-content">
                                        <h5 class="dez-tilte text-uppercase">Phone</h5>
                                        <p>{{ $site->phone }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center border-bottom p-b20 p-a20">
                                    <div class="icon-xl text-primary">
                                        <i class="fa fa-mobile"></i>
                                    </div>
                                    <div class="icon-content">
                                        <h5 class="dez-tilte text-uppercase">For Sales Enquiry</h5>
                                        <p>{{ $site->mobile }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center border-bottom p-b20 p-a20">
                                    <div class="icon-xl text-primary">
                                        <i class="fa fa-print"></i>
                                    </div>
                                    <div class="icon-content">
                                        <h5 class="dez-tilte text-uppercase">Fax</h5>
                                        <p>{{ $site->fax }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center border-bottom p-b20 p-a20">
                                    <div class="icon-xl text-primary">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="icon-content">
                                        <h5 class="dez-tilte text-uppercase">Email ID</h5>
                                        <p>{{ $site->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- right part END -->
                    </div>
                @endif
            </div>
        </div>
        <!-- contact area  END -->
    </div>
    <!-- Content END-->

    <iframe src="{{ $site->google_map }}" style="border:0; width:100%; min-height:350px; height: 100%;" allowfullscreen
        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@endsection
