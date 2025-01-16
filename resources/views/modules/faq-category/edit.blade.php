@extends('layouts.afterlogin')

@section('title', 'Edit Faq Category')

@section('admin_content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-alert />
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <h5 class="card-header">
                        Edit Faq Category
                    </h5>
                    <div class="card-body">
                        {{ Form::open(['url' => route('admin.faq-category.update', $faqCategory), 'method' => 'PUT']) }}
                        @include('modules.faq-category._form')
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
