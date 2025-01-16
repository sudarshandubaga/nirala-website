<div class="mb-3">
    {{ Form::label('project_id', 'Select Project', ['class' => 'form-label']) }}
    {{ Form::select('project_id', $projects, null, ['class' => 'form-select', 'placeholder' => 'Select Project', 'required' => 'required']) }}
</div>
<div class="mb-3">
    {{ Form::label('phase_id', 'Select Phase', ['class' => 'form-label']) }}
    {{ Form::select('phase_id', $phases, null, ['class' => 'form-select', 'placeholder' => 'Select Phase', 'required' => 'required']) }}
</div>
<div class="mb-3">
    {{ Form::label('tower_id', 'Select Tower', ['class' => 'form-label']) }}
    {{ Form::select('tower_id', $towers, null, ['class' => 'form-select', 'placeholder' => 'Select Tower', 'required' => 'required']) }}
</div>
<div class="mb-3">
    {{ Form::label('name', null, ['class' => 'form-label']) }}
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => 'required']) }}
</div>

@push('extra_scripts')
    <script>
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
        });
    </script>
@endpush
