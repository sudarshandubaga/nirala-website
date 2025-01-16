@extends('layouts.afterlogin')

@section('title', 'Team » Add New')

@section('admin_content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        {{ Form::open(['url' => route('admin.team.store'), 'files' => true]) }}
        <div class="card mb-4 position-sticky top-0" style="z-index: 1;">
            <div class="card-body py-2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="m-0">Add New Team</h3>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary px-5">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <x-alert />
        @include('modules.team._form')
        {{ Form::close() }}
    </div>
    <!-- /Content -->
@endsection
