<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-start project-left-sidebar">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview"
                    type="button" role="tab">
                    Overview
                </button>
                <button class="nav-link" id="location-map-tab" data-bs-toggle="pill" data-bs-target="#location-map"
                    type="button" role="tab" aria-controls="location-map" aria-selected="false">
                    Location Map
                </button>
                <button class="nav-link" id="profile-layout-tab" data-bs-toggle="pill" data-bs-target="#profile-layout"
                    type="button" role="tab" aria-controls="profile-layout" aria-selected="false">
                    Profile Layout
                </button>
                <button class="nav-link" id="unit-plan-tab" data-bs-toggle="pill" data-bs-target="#unit-plan"
                    type="button" role="tab" aria-controls="unit-plan" aria-selected="false">
                    Unit Plan
                </button>

                <button class="nav-link" id="specification-tab" data-bs-toggle="pill" data-bs-target="#specification"
                    type="button" role="tab" aria-controls="specification" aria-selected="false">
                    Specification
                </button>
                <button class="nav-link" id="views-tab" data-bs-toggle="pill" data-bs-target="#views" type="button"
                    role="tab" aria-controls="views" aria-selected="false">
                    Views
                </button>
                <button class="nav-link" id="download-tab" data-bs-toggle="pill" data-bs-target="#download"
                    type="button" role="tab" aria-controls="download" aria-selected="false">
                    Download
                </button>
                <button class="nav-link" id="payment-plan-tab" data-bs-toggle="pill" data-bs-target="#payment-plan"
                    type="button" role="tab" aria-controls="payment-plan" aria-selected="false">
                    Payment Plan
                </button>
                <button class="nav-link" id="new-price-list-tab" data-bs-toggle="pill" data-bs-target="#new-price-list"
                    type="button" role="tab" aria-controls="payment-plan" aria-selected="false">
                    New Price List
                </button>
                <button class="nav-link" id="price-list-tab" data-bs-toggle="pill" data-bs-target="#price-list"
                    type="button" role="tab" aria-controls="price-list" aria-selected="false">
                    Price List
                </button>
            </div>
            <div class="tab-content flex-grow-1" id="v-pills-tabContent" style="padding-top: 0; padding-bottom:0;">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="mb-3">
                                {{ Form::label('project_id', 'Select Project', ['class' => 'form-label']) }}
                                {{ Form::select('project_id', $projects, null, ['class' => 'form-select', 'placeholder' => 'Select Project', 'required' => 'required']) }}
                            </div>
                            <div class="mb-3">
                                {{ Form::label('name', null, ['class' => 'form-label']) }}
                                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => 'required']) }}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                {{ Form::label('image', 'Choose Image (size: 500x500)', ['class' => 'form-label']) }}
                                <label for="image_file" class="d-block upload-image">
                                    <img src="{{ !empty($phase->image) ? asset('storage/' . $phase->image) : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                                        alt="" id="img-preview" loading="lazy">
                                    {{ Form::file('image_file', ['class' => 'd-none', 'data-target' => '#img-preview', 'data-text-target' => '#image', 'id' => 'image_file']) }}
                                </label>
                                {{-- @if (!empty($phase->image))
                                    <div class="text-center">
                                        <a href="">Remove Image</a>
                                    </div>
                                @endif --}}
                                <textarea name="image" id="image" class="d-none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        {{ Form::label('overview', null, ['class' => 'form-label']) }}
                        {{ Form::textarea('overview', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter description']) }}
                    </div>
                </div>
                <div class="tab-pane fade" id="location-map" role="tabpanel" aria-labelledby="location-map-tab">
                    <div class="mb-3">
                        {{ Form::label('location_advantages', null, ['class' => 'form-label']) }}
                        {{ Form::textarea('location_advantages', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter location advantages']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('loc_image_file', 'Choose Image (size: 500x500)', ['class' => 'form-label']) }}
                        <label for="loc_image_file" class="d-block upload-image">
                            <img src="{{ !empty($phase->location_image) ? asset('storage/' . $phase->location_image) : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                                alt="" id="location-preview" loading="lazy">
                            {{ Form::file('loc_image_file', ['class' => 'd-none', 'data-target' => '#location-preview', 'data-text-target' => '#location_image']) }}
                        </label>
                        <textarea name="location_image" id="location_image" class="d-none"></textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-layout" role="tabpanel" aria-labelledby="profile-layout-tab">
                    <x-phase-multi-image :images="@$phase->images" name="images" />
                </div>
                <div class="tab-pane fade" id="unit-plan" role="tabpanel" aria-labelledby="unit-plan-tab">
                    <x-phase-multi-image :images="@$phase->unit_plans" name="unit_images" />
                </div>
                <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                    <div class="mb-3">
                        {{ Form::label('specification', null, ['class' => 'form-label']) }}
                        {{ Form::textarea('specification', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter specification']) }}
                    </div>
                </div>
                <div class="tab-pane fade" id="views" role="tabpanel" aria-labelledby="views-tab">
                    <x-phase-multi-image :images="@$phase->views" name="view_images" />
                </div>

                <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
                    <button type="button" class="btn btn-outline-dark add-download-row">Add Download</button>

                    @if (!empty($phase->downloads))
                        <table class="table table-striped my-3">
                            @foreach ($phase->downloads as $key => $d)
                                <tr>
                                    <td>
                                        <a href="{{ asset('storage/' . $d->file) }}" target="_blank">
                                            {{ $key + 1 }}. {{ $d->title }}
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-danger remove-btn"
                                            data-name="download" data-id="{{ $d->id }}">
                                            <i class="bx bx-minus"></i> Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    <div id="download-list"></div>
                </div>

                <div class="tab-pane fade" id="payment-plan" role="tabpanel" aria-labelledby="payment-plan-tab">
                    <button type="button" class="btn btn-outline-dark add-payment-row">Add Payment Plan</button>

                    @if (!empty($phase->payment_plans))
                        <table class="table table-striped my-3">
                            @foreach ($phase->payment_plans as $key => $d)
                                <tr>
                                    <td>
                                        <a href="{{ asset('storage/' . $d->file) }}" target="_blank">
                                            {{ $key + 1 }}. {{ $d->title }}
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-danger remove-btn"
                                            data-name="payment_plan" data-id="{{ $d->id }}">
                                            <i class="bx bx-minus"></i> Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    <div id="payment-list"></div>
                </div>

                <div class="tab-pane fade" id="price-list" role="tabpanel" aria-labelledby="price-list-tab">
                    <div class="mb-3">
                        {{ Form::label('price_list', null, ['class' => 'form-label']) }}
                        {{ Form::textarea('price_list', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter Price List Description']) }}
                    </div>
                    <x-phase-multi-image :images="@$phase->price_list_images" name="price_list_images" />
                   
                </div>
                <div class="tab-pane fade" id="new-price-list" role="tabpanel" aria-labelledby="new-price-list-tab">
                    <button type="button" class="btn btn-outline-dark add-price-row">Add New Price</button>
                    @if (!empty($phase->new_price_list))
                        <table class="table table-striped my-3">
                            <tr>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($phase->new_price_list as $new_price_list)
                                <tr>
                                    <td>{{$new_price_list->title}}</td>
                                    <td>{{$new_price_list->size}}</td>
                                    <td>{{$new_price_list->price}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-btn"
                                            data-name="new_price_list" data-id="{{ $new_price_list->id }}">
                                            <i class="bx bx-minus"></i> Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    <div id="new-price-list"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('extra_scripts')
    <script>
        // Project Multiple Images
        $(function() {
            $(document).on('click', '.multi-image-item .close', function(e) {
                let parent = $(this).closest('.multi-image-item');
                parent.remove();
            });

            $(document).on('click', '.multi-image-item .remove-phase-image', function(e) {
                let parent = $(this).closest('.multi-image-item');
                parent.remove();

                let name = $(this).data('name'),
                    id = $(this).data('id');

                $.ajax({
                    url: "{{ route('api.phase.remove') }}",
                    method: 'POST',
                    data: {
                        name,
                        id
                    },
                    success: function() {
                        // 
                    }
                });
            });

            $(document).on('click', '.remove-btn', function() {
                let parent = $(this).closest('tr');
                parent.remove();

                let name = $(this).data('name'),
                    id = $(this).data('id');

                $.ajax({
                    url: "{{ route('api.phase.remove') }}",
                    method: 'POST',
                    data: {
                        name,
                        id
                    },
                    success: function() {
                        // 
                    }
                });
            });

            $(document).on('change', '.choose-multi-image', function(e) {
                let [file] = e.target.files;
                let max_size = 1000;
                let self = this;
                let textName = $(self).data('text-name')
                if (file) {
                    // Ensure it's an image
                    if (file.type.match(/image.*/)) {
                        // console.log("An image has been loaded");

                        // Load the image
                        var reader = new FileReader();
                        reader.onload = function(readerEvent) {
                            var image = new Image();
                            image.onload = function(imageEvent) {
                                // Resize the image
                                var canvas = document.createElement("canvas"),
                                    width = image.width,
                                    height = image.height;

                                if (width > height) {
                                    if (width > max_size) {
                                        height *= max_size / width;
                                        width = max_size;
                                    }
                                } else {
                                    if (height > max_size) {
                                        width *= max_size / height;
                                        height = max_size;
                                    }
                                }

                                canvas.width = width;
                                canvas.height = height;

                                canvas
                                    .getContext("2d")
                                    .drawImage(image, 0, 0, width, height);

                                var dataUrl = canvas.toDataURL('image/webp');

                                $(self).closest('.multi-images').append(`
                                <div class="col-sm-2 mb-3 multi-image-item">
                                    <div class="choose-project-images">
                                        <button type="button" class="close">
                                            <i class="bx bx-minus-circle"></i>
                                        </button>
                                        <img src="${dataUrl}" alt="" loading="lazy">
                                        <textarea name="${textName}[]" class="d-none">${dataUrl}</textarea>
                                    </div>
                                </div>
                            `);
                            };
                            image.src = readerEvent.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

        });

        $(function() {
            $(document).on("click", ".remove-row", function() {
                $(this).closest(".list-item").remove();
            });

            // Download Lists
            $(document).on("click", ".add-download-row", function() {
                $("#download-list").append(`
                    <div class="row align-items-end list-item">
                        <div class="col-sm-4 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="download[title][]" class="form-control" required />
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label class="form-label">Select PDF File</label>
                            <input type="file" name="download_file[]" accept="application/pdf" class="form-control" required />
                        </div>

                        <div class="col-sm-4 mb-3">
                            <button type="button" class="btn btn-outline-danger remove-row">Remove</button>
                        </div>
                    </div>
                `);
            });

            // Payment Plans
            $(document).on("click", ".add-payment-row", function() {
                $("#payment-list").append(`
                    <div class="row align-items-end list-item">
                        <div class="col-sm-4 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="payment[title][]" class="form-control" required />
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label class="form-label">Select PDF File</label>
                            <input type="file" name="payment_file[]" accept="application/pdf" class="form-control" required />
                        </div>

                        <div class="col-sm-4 mb-3">
                            <button type="button" class="btn btn-outline-danger remove-row">Remove</button>
                        </div>
                    </div>
                `);
            });
            $(document).on("click", ".add-price-row", function() {
            $("#new-price-list").append(`
                <div class="row align-items-end list-item">
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="new_price[title][]" class="form-control" required placeholder="Enter Title"/>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Size</label>
                        <input type="text" name="new_price[size][]" class="form-control" required placeholder="Enter Size"/>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="new_price[price][]" class="form-control" required placeholder="Enter Price"/>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <button type="button" class="btn btn-outline-danger remove-row">Remove</button>
                    </div>
                </div>
            `);
        });
        })
        $(document).on("click", ".remove-row", function() {
            $(this).closest(".list-item").remove();
        });
    </script>
@endpush
