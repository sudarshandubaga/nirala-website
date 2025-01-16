@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url({{ asset('images/background/bg4.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Construction Update of {{ $project->name }}</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Construction Update of {{ $project->name }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->

        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-lg-3">
                        {{ Form::open(['method' => 'GET', 'id' => 'searchForm']) }}
                        <div class="mb-3">
                            {{ Form::label('phase_id', 'Phase', ['class' => 'form-label']) }}
                            {{ Form::select('phase_id', $phases, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Phase']) }}
                        </div>
                        <div class="mb-3">
                            {{ Form::label('tower_id', 'Tower', ['class' => 'form-label']) }}
                            {{ Form::select('tower_id', $towers, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Tower']) }}
                        </div>
                        {{-- <div class="mb-3">
                            {{ Form::label('flat_id', 'Flat', ['class' => 'form-label']) }}
                            {{ Form::select('flat_id', $flats, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Flat']) }}
                        </div> --}}
                        <button class="btn btn-primary btn-block site-button ">
                            SEARCH
                        </button>
                        {{ Form::close() }}
                    </div>

                    <div class="col-sm-8 col-lg-9">
                        @if ($constructionUpdates)
                            <div id="accordion">
                                @foreach ($constructionUpdates as $c)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $c->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapse{{ $c->id }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $c->id }}">
                                                    {{ $c->title }}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{ $c->id }}" class="collapse"
                                            aria-labelledby="heading{{ $c->id }}" data-parent="#accordion">
                                            <div class="card-body">
                                                <div>
                                                    {!! $c->description !!}
                                                </div>

                                                @if (!empty($c->images))
                                                    <h3>Images</h3>
                                                    <div class="row cUpdate-gallery">
                                                        @foreach ($c->images as $img)
                                                            <div class="col-sm-4 mb-3">
                                                                <a href="{{ $img->image }}" data-lightbox="gallery"
                                                                    title="{{ $img->title }}">
                                                                    <div>
                                                                        <img src="{{ $img->image }}"
                                                                            alt="{{ $img->title }}"
                                                                            title="{{ $img->title }}">
                                                                    </div>
                                                                    <div class="text-center">
                                                                        {{ $img->title }}
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area  END -->
    </div>
    <!-- Content END-->
@endsection


@push('extra_styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
@endpush

@push('extra_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <script>
        $(function() {
            $(document).on("change", "#phase_id", function() {
                $("#tower_id")
                    .html('<option value>Loading</option>')
                    .attr("disabled", "disabled");

                $.ajax({
                    url: "{{ route('api.tower.index') }}",
                    data: {
                        phase_id: $(this).val()
                    },
                    success: function(res) {
                        $("#tower_id")
                            .html('<option value>Select Tower</option>')
                            .removeAttr("disabled");

                        for (const id in res) {
                            $("#tower_id").append(`<option value=${id}>${res[id]}</option>`);
                        }
                    }
                });
            });

            $(document).on("change", "#tower_id", function() {
                $('#searchForm').trigger('submit');
                // $("#flat_id")
                //     .html('<option value>Loading</option>')
                //     .attr("disabled", "disabled");

                // $.ajax({
                //     url: "{{ route('api.flat.index') }}",
                //     data: {
                //         tower_id: $(this).val()
                //     },
                //     success: function(res) {
                //         $("#flat_id")
                //             .html('<option value>Select Flat</option>')
                //             .removeAttr("disabled");

                //         for (const id in res) {
                //             $("#flat_id").append(`<option value=${id}>${res[id]}</option>`);
                //         }
                //     }
                // });
            });
        });
    </script>
@endpush
