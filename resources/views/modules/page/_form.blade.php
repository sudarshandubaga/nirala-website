<div class="row">
    <div class="mb-3 col-sm-4 col-lg-3">
        {{ Form::label('image_file', 'Choose Image', ['class' => 'form-label']) }}
        <label for="image_file" class="d-block upload-image">
            <img src="{{ $page->image ?: 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                alt="" id="img-preview" loading="lazy">
            {{ Form::file('image_file', ['class' => 'd-none', 'data-target' => '#img-preview', 'data-text-target' => '#image', 'data-size' => 500]) }}
        </label>
        <textarea name="image" id="image" class="d-none"></textarea>
    </div>
    <div class="mb-3 col-sm-4 col-lg-3">
        {{ Form::label('bg_image_file', 'Choose Background Image', ['class' => 'form-label']) }}
        <label for="bg_image_file" class="d-block upload-image">
            <img src="{{ $page->bg_image ?: 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                alt="" id="bg_img-preview" loading="lazy">
            {{ Form::file('bg_image_file', ['class' => 'd-none', 'data-target' => '#bg_img-preview', 'data-text-target' => '#bg_image', 'data-size' => 2000]) }}
        </label>
        <textarea name="bg_image" id="bg_image" class="d-none"></textarea>
    </div>
</div>
<div class="mb-3">
    {{ Form::label('description', null, ['class' => 'form-label']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter description']) }}
</div>
