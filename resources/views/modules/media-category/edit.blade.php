@extends('layouts.afterlogin')

@section('title', 'Edit Media Category')

@section('admin_content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-alert />
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <h5 class="card-header">
                        Edit Media Category
                    </h5>
                    <div class="card-body">
                        {{ Form::open(['url' => route('admin.media-category.update', $mediaCategory), 'method' => 'PUT']) }}
                        @include('modules.media-category._form')
                        <div class="d-grid">
                            <button class="btn btn-primary">Update</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content -->
@endsection
