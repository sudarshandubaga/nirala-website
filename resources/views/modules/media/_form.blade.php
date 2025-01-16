<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-9">
                <div class="mb-3">
                    {{ Form::label('media_category_id', 'Select Category', ['class' => 'form-label']) }}
                    {{ Form::select('media_category_id', $mediaCategories, null, ['class' => 'form-select', 'placeholder' => 'Select Category', 'required' => 'required']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('title', null, ['class' => 'form-label']) }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => 'required']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('description', null, ['class' => 'form-label']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter description']) }}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    {{ Form::label('image', 'Choose Image', ['class' => 'form-label']) }}
                    <label for="image_file" class="d-block upload-image">
                        <img src="{{ !empty($project->image) ? asset('storage/' . $project->image) : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                            alt="" id="img-preview" loading="lazy">
                        {{ Form::file('image_file', ['class' => 'd-none', 'data-target' => '#img-preview', 'data-text-target' => '#image', 'id' => 'image_file', 'data-size' => 1000]) }}
                    </label>
                    @if (!empty($project->image))
                        <div class="text-center">
                            <a href="">Remove Image</a>
                        </div>
                    @endif
                    <textarea name="image" id="image" class="d-none"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

@push('extra_scripts')
    <script></script>
@endpush
