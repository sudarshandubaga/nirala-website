@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url({{ asset('images/background/bg4.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">{{ $faqCategory->name }}</h1>
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
                        {{ $faqCategory->name }}
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <h2>{{ $faqCategory->name }}</h2>
                <div>
                    {!! $faqCategory->description !!}
                </div>
                <div class="accordion" id="accordionExample">
                    @foreach ($faqs as $key => $faq)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h3 class="mb-0" data-toggle="collapse" data-target="#collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </h3>
                            </div>

                            <div id="collapse{{ $faq->id }}" class="collapse {{ $key === 0 ? 'show' : '' }}"
                                aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Collapsible Group Item #2
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                Some placeholder content for the second accordion panel. This panel is hidden by default.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Collapsible Group Item #3
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                And lastly, the placeholder content for the third and final accordion panel. This panel is
                                hidden by default.
                            </div>
                        </div>
                    </div> --}}
                </div>
                {{-- <div class="row">
                    @foreach ($faqs as $faq)
                        <div class="col-md-4 col-lg-4 col-sm-6 m-b30">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4>{{ $faq->question }}</h4>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
            </div>
        </div>
        <!-- contact area  END -->
    </div>
    <!-- Content END-->
@endsection
