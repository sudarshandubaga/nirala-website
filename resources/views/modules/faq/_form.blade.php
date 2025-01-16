<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="mb-3">
                    {{ Form::label('faq_category_id', 'Select Category', ['class' => 'form-label']) }}
                    {{ Form::select('faq_category_id', $faqCategories, null, ['class' => 'form-select', 'placeholder' => 'Select Category', 'required' => 'required']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('question', null, ['class' => 'form-label']) }}
                    {{ Form::text('question', null, ['class' => 'form-control', 'placeholder' => 'Enter question', 'required' => 'required']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('answer', null, ['class' => 'form-label']) }}
                    {{ Form::textarea('answer', null, ['class' => 'form-control text-editor', 'placeholder' => 'Enter answer']) }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('extra_scripts')
    <script></script>
@endpush
