<div class="card">
    <div class="card-body">
        <div class="">
            <div class="row">
                <div class="col-sm-9">
                    <div class="mb-3">
                        {{ Form::label('name', null, ['class' => 'form-label']) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => 'required']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('designation', null, ['class' => 'form-label']) }}
                        {{ Form::text('designation', null, ['class' => 'form-control', 'placeholder' => 'Enter Designation', 'required' => 'required']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('about', null, ['class' => 'form-label']) }}
                        {{ Form::textarea('about', null, ['class' => 'form-control', 'placeholder' => 'Enter About', 'required' => 'required']) }}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        {{ Form::label('image', 'Choose Image (size: 500x500)', ['class' => 'form-label']) }}
                        <label for="image_file" class="d-block upload-image">
                            <img src="{{ !empty($team->image) ? $team->image : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                                alt="" id="img-preview" loading="lazy">
                            {{ Form::file('image_file', ['class' => 'd-none', 'data-target' => '#img-preview', 'data-text-target' => '#image', 'id' => 'image_file']) }}
                        </label>
                        <textarea name="image" id="image" class="d-none"></textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- </div>
        </div> --}}
    </div>
</div>
