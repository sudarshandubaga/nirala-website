
@extends('layouts.afterlogin')


@section('admin_content')
<style>
    .ck-widget img{
      height: 300px!important;
      width:100%!important;
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
                Add Testimonial
            </div>
            <div class="card-body py-2">
                <form action="{{route('admin.testimonial.video.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                      <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" placeholder="Enter Title">
                      @error('title')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="video_id">Video ID</label>
                      <input type="text" name="video_id" id="video_id" class="form-control" value="{{old('video_id')}}" placeholder="Enter video_id">
                      @error('video_id')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Add Testimonial" class="btn btn-success">
                    </div>
                  </form>
            </div>
        </div>
      
    </div>
@endsection

