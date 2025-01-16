
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
                <form action="{{route('admin.testimonial.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Name">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="designation">Designation</label>
                      <input type="text" name="designation" id="designation" class="form-control" value="{{old('designation')}}" placeholder="Enter Designation">
                      @error('designation')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="photo">Photo</label>
                      <input type="file" name="image" class="form-control" >
                      @error('image')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="feedback">Feedback</label>
                      <textarea name="comment"  class="form-control" placeholder="Feedback goes here..">{{old('comment')}}</textarea>
                      @error('comment')
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

