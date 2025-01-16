<div class="mb-3">
    {{ Form::label('name', null, ['class' => 'form-label']) }}
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name']) }}
</div>
<div class="mb-3">
    {{ Form::label('description', null, ['class' => 'form-label']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter description']) }}
</div>
