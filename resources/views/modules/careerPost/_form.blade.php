<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="mb-3">
                    {{ Form::label('title', null, ['class' => 'form-label']) }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => 'required']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('department', null, ['class' => 'form-label']) }}
                    {{ Form::text('department', null, ['class' => 'form-control', 'placeholder' => 'Enter department', 'required' => 'required']) }}
                </div>
                <div class="row">

                    <div class="mb-3 col-6">
                        {{ Form::label('total_posts', null, ['class' => 'form-label']) }}
                        {{ Form::number('total_posts', 1, ['class' => 'form-control', 'placeholder' => 'Enter total posts', 'required' => 'required']) }}
                    </div>
                    <div class="mb-3 col-6">
                        {{ Form::label('location', null, ['class' => 'form-label']) }}
                        {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Enter location', 'required' => 'required']) }}
                    </div>
                    <div class="mb-3 col-6">
                        {{ Form::label('qualification', null, ['class' => 'form-label']) }}
                        {{ Form::text('qualification', null, ['class' => 'form-control', 'placeholder' => 'Enter qualification', 'required' => 'required']) }}
                    </div>
                    <div class="mb-3 col-6">
                        {{ Form::label('min_exp', null, ['class' => 'form-label']) }}
                        {{ Form::text('min_exp', null, ['class' => 'form-control', 'placeholder' => 'Enter min experience', 'required' => 'required']) }}
                    </div>
                </div>
                {{-- <div class="mb-3">
                    {{ Form::label('description', null, ['class' => 'form-label']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter Description', 'rows' => '15']) }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
