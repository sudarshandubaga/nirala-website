<div class="card">
    <div class="card-body">
        <div>
            <div>
                <div class="row">

                    <div class="mb-3 col-lg-4">
                        {{ Form::label('project_id', 'Select Project', ['class' => 'form-label']) }}
                        {{ Form::select('project_id', $projects, null, ['class' => 'form-select', 'placeholder' => 'Select Project', 'required' => 'required']) }}
                    </div>
                    <div class="mb-3 col-lg-4">
                        {{ Form::label('phase_id', 'Select Phase', ['class' => 'form-label']) }}
                        {{ Form::select('phase_id', $phases, null, ['class' => 'form-select', 'placeholder' => 'Select Phase', 'required' => 'required']) }}
                    </div>
                    <div class="mb-3 col-lg-4">
                        {{ Form::label('tower_id', 'Select Tower', ['class' => 'form-label']) }}
                        {{ Form::select('tower_id', $towers, null, ['class' => 'form-select', 'placeholder' => 'Select Tower', 'required' => 'required']) }}
                    </div>
                </div>
                {{-- <div class="mb-3">
                    {{ Form::label('flat_id', 'Select Flat', ['class' => 'form-label']) }}
                    {{ Form::select('flat_id', $flats, null, ['class' => 'form-select', 'placeholder' => 'Select Flat', 'required' => 'required']) }}
                </div> --}}
                <div class="mb-3">
                    {{ Form::label('title', null, ['class' => 'form-label']) }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => 'required']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('description', null, ['class' => 'form-label']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter Description']) }}
                </div>
            </div>
            <div>
                <h3>Images</h3>
                <div id="product-images" class="row">
                    <div class="col-lg-12">
                        <label for="product-image" class="d-block choose-product-images">
                            <img src="https://icons.veryicon.com/png/o/miscellaneous/o2o-middle-school-project/plus-104.png"
                                alt="" loading="lazy" class="img img-fluid border rounded">
                            <input type="file" name="" id="product-image" class="d-none">
                        </label>
                    </div>

                    @if (!empty($constructionUpdate->images))

                        @foreach ($constructionUpdate->images as $index => $pimg)
                            <div class="col-lg-6 mt-3 p-image row align-items-center p-image-row">
                                <div class="col-4">
                                    <div class="choose-product-images">
                                        <button type="button" class="close">
                                            <i class="bx bx-minus-circle"></i>
                                        </button>
                                        <img src="{{ $pimg->image }}" alt="" loading="lazy"
                                            class="img-fluid border rounded">
                                        <textarea name="images[{{ $index }}][image]" class="d-none cu-image">{{ $pimg->image }}</textarea>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control cu-title"
                                        name="images[{{ $index }}][title]" placeholder="Title"
                                        value="{{ $pimg->title }}" />

                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@push('extra_scripts')
    <script>
        $(function() {
            $(document).on('click', '.p-image .close', function(e) {
                let parent = $(this).closest('.p-image');
                parent.remove();
            });

            function adjustIndexing() {
                let i = 0;
                $('.p-image-row').each(function() {
                    $(this).find('.cu-image').attr('name', `images[${i}][image]`);
                    $(this).find('.cu-title').attr('name', `images[${i}][title]`);
                    i++;
                });
                i++;
            }

            $(document).on('change', '#product-image', function(e) {
                let [file] = e.target.files;
                let max_size = 2000;
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

                                $('#product-images').append(`
                            <div class="row align-items-center mt-3 p-image col-lg-6 p-image-row">
                                <div class="col-4">
                                    <div class="choose-product-images">
                                        <button type="button" class="close">
                                            <i class="bx bx-minus-circle"></i>
                                        </button>
                                        <img src="${dataUrl}" alt="" loading="lazy" class="img-fluid border rounded">
                                        <textarea name="images[]" class="d-none cu-image">${dataUrl}</textarea>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="title[]" placeholder="Title" class="form-control cu-title" required />
                                </div>
                            </div>
                        `);

                                adjustIndexing()
                            };
                            image.src = readerEvent.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        });

        $(function() {
            $(document).on("change", "#project_id", function() {
                $("#phase_id")
                    .html('<option value>Loading</option>')
                    .attr("disabled", "disabled");

                $.ajax({
                    url: "{{ route('api.phase.index') }}",
                    data: {
                        project_id: $(this).val()
                    },
                    success: function(res) {
                        $("#phase_id")
                            .html('<option value>Select Phase</option>')
                            .removeAttr("disabled");

                        for (const id in res) {
                            $("#phase_id").append(`<option value=${id}>${res[id]}</option>`);
                        }
                    }
                });
            });

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
                $("#flat_id")
                    .html('<option value>Loading</option>')
                    .attr("disabled", "disabled");

                $.ajax({
                    url: "{{ route('api.flat.index') }}",
                    data: {
                        tower_id: $(this).val()
                    },
                    success: function(res) {
                        $("#flat_id")
                            .html('<option value>Select Flat</option>')
                            .removeAttr("disabled");

                        for (const id in res) {
                            $("#flat_id").append(`<option value=${id}>${res[id]}</option>`);
                        }
                    }
                });
            });
        });
    </script>
@endpush
