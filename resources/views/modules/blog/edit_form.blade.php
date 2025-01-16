@extends('layouts.afterlogin')


@section('admin_content')
    <style>
        .ck-widget img {
            height: 300px !important;
            width: 100% !important;
        }

        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* Block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4 position-sticky top-0" style="z-index: 1;">
            <x-alert />
            <div class="card-header">
                Add Blog
            </div>
            <div class="card-body py-2">
                <form action="{{ route('admin.blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Blog Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title', $blog->title) }}" placeholder="Blog Title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="{{ old('slug', $blog->slug) }}" placeholder="Write Slug">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div style="text-center">
                        @if (!empty(asset('uploads/' . $blog->image)))
                            <img src="{{ asset('uploads/' . $blog->image) }}"
                                style="height: 100px;width:120px;border:1px dashed orange;border-radius: 5px;box-shadow: 0 5px 10px rgba(0, 0, 0,0.3);margin:10px;">
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Blog Image</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Blog Description</label>
                        <textarea name="description" id="ckeditor" class="form-control" placeholder="Description goes here..">{{ old('description', $blog->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update Blog" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $('#title').change(function() {
            element = $(this);
            $.ajax({
                url: '{{ route('getSlug') }}',
                type: 'get',
                data: {
                    title: element.val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status']) {
                        $('#slug').val(response['slug'])
                    }
                }
            })
        });
    </script>
    <!-- /Content -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                },
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
