@extends('layouts.afterlogin')

@section('title', 'Change Password')

@section('admin_content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-alert />
        <div class="card">
            <h5 class="card-header">
                Change Password
            </h5>
            <div class="card-body">
                {{ Form::open(['url' => route('admin.password.store')]) }}
                @include('modules.change_password._form')
                <div>
                    <button class="btn btn-primary px-5">Update</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <!-- /Content -->
@endsection

@push('extra_scripts')
    <script>
        $(function() {
            $(document).on('click', '.password-toggle-btn', function() {
                let input = $(this).prev(),
                    btnIcon = $(this).find('.bx');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    btnIcon.removeClass('bx-show').addClass('bx-hide');
                } else {
                    input.attr('type', 'password');
                    btnIcon.removeClass('bx-hide').addClass('bx-show');
                }
            });
        });
    </script>
@endpush
