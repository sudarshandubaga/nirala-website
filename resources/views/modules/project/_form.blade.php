<div class="card">
    <div class="card-body">
        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <div class="row">
                <div class="col-sm-9">
                    <div class="mb-3">
                        {{ Form::label('category_id', 'Select Category', ['class' => 'form-label']) }}
                        {{ Form::select('category_id', $categories, null, ['class' => 'form-select', 'placeholder' => 'Select Category', 'required' => 'required']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('name', null, ['class' => 'form-label']) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => 'required']) }}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        {{ Form::label('image', 'Choose Logo (size: 500x500)', ['class' => 'form-label']) }}
                        <label for="image_file" class="d-block upload-image">
                            <img src="{{ !empty($project->image) ? asset('storage/' . $project->image) : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                                alt="" id="img-preview" loading="lazy">
                            {{ Form::file('image_file', ['class' => 'd-none', 'data-target' => '#img-preview', 'data-text-target' => '#image', 'id' => 'image_file']) }}
                        </label>
                        @if (!empty($project->image))
                            {{-- <div class="text-center">
                                <a href="">Remove Image</a>
                            </div> --}}
                        @endif
                        <textarea name="image" id="image" class="d-none"></textarea>
                    </div>

                    <div class="mb-3">
                        {{ Form::label('bg_image', 'Choose Bg Image', ['class' => 'form-label']) }}
                        <label for="bg_image_file" class="d-block upload-image">
                            <img src="{{ !empty($project->bg_image) ? asset('storage/' . $project->bg_image) : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                                alt="" id="bg_img-preview" loading="lazy">
                            {{ Form::file('bg_image_file', ['class' => 'd-none', 'data-target' => '#bg_img-preview', 'data-text-target' => '#bg_image', 'id' => 'bg_image_file']) }}
                        </label>
                        {{-- @if (!empty($project->bg_image))
                            <div class="text-center">
                                <a href="">Remove Image</a>
                            </div>
                        @endif --}}
                        <textarea name="bg_image" id="bg_image" class="d-none"></textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- </div>
        </div> --}}
    </div>
</div>

@push('extra_scripts')
    <script>
        // Project Multiple Images
        $(function() {
            $(document).on('click', '.p-image .close', function(e) {
                let parent = $(this).closest('.p-image');
                parent.remove();
            });
            $(document).on('change', '#project-image', function(e) {
                let [file] = e.target.files;
                let max_size = 500;
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
                                    // max_size = 500, // TODO : pull max size from a site config
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

                                var dataUrl = canvas.toDataURL(file.type);

                                $('#project-images').append(`
                                <div class="col-sm-2 mb-3 p-image multi-image-item">
                                    <div class="choose-project-images">
                                        <button type="button" class="close">
                                            <i class="bx bx-minus-circle"></i>
                                        </button>
                                        <img src="${dataUrl}" alt="" loading="lazy">
                                        <textarea name="images[]" class="d-none">${dataUrl}</textarea>
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


        // Project Unit Images
        $(function() {
            $(document).on('click', '.punit-image .close', function(e) {
                let parent = $(this).closest('.punit-image');
                parent.remove();
            });
            $(document).on('change', '#project-unit-image', function(e) {
                let [file] = e.target.files;
                let max_size = 500;
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
                                    // max_size = 500, // TODO : pull max size from a site config
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

                                var dataUrl = canvas.toDataURL(file.type);

                                $('#project-unit-images').append(`
                                <div class="col-sm-2 mb-3 punit-image multi-image-item">
                                    <div class="choose-project-unit-images">
                                        <button type="button" class="close">
                                            <i class="bx bx-minus-circle"></i>
                                        </button>
                                        <img src="${dataUrl}" alt="" loading="lazy">
                                        <textarea name="unit_images[]" class="d-none">${dataUrl}</textarea>
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

        // Project View Images
        $(function() {
            $(document).on('click', '.pview-image .close', function(e) {
                let parent = $(this).closest('.pview-image');
                parent.remove();
            });
            $(document).on('change', '#project-views-image', function(e) {
                let [file] = e.target.files;
                let max_size = 500;
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
                                    // max_size = 500, // TODO : pull max size from a site config
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

                                var dataUrl = canvas.toDataURL(file.type);

                                $('#project-views-images').append(`
                                <div class="col-sm-2 mb-3 pview-image multi-image-item">
                                    <div class="choose-project-views-images">
                                        <button type="button" class="close">
                                            <i class="bx bx-minus-circle"></i>
                                        </button>
                                        <img src="${dataUrl}" alt="" loading="lazy">
                                        <textarea name="view_images[]" class="d-none">${dataUrl}</textarea>
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
        })
    </script>
@endpush
