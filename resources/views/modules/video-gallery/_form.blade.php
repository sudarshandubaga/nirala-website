<div class="mb-3">
    {{ Form::label('title', null, ['class' => 'form-label']) }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title']) }}
</div>
<div class="mb-3">
    {{ Form::label('video_id', 'Youtube Video ID', ['class' => 'form-label']) }}
    {{ Form::text('video_id', null, ['class' => 'form-control', 'placeholder' => 'Enter Youtube Video ID']) }}
</div>
