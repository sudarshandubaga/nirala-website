
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
                Add Blog
            </div>
            <div class="card-body py-2">
                <form action="{{route('admin.testimonial.update',$testimonial->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{old('name',$testimonial->name)}}" placeholder="Name">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="designation">designation</label>
                      <input type="text" name="designation" id="designation" class="form-control" value="{{old('designation',$testimonial->designation)}}" placeholder="Enter Designation">
                      @error('designation')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <center>
                        @if(!empty(asset('uploads/'.$testimonial->image)))
                          <img src="{{asset('uploads/'.$testimonial->image)}}" style="height: 100px;width:120px;border:1px dashed orange;border-radius: 5px;box-shadow: 0 5px 10px rgba(0, 0, 0,0.3);margin:10px;">
                        <?php endif; ?>
                      </center>
                    <div class="form-group mb-3">
                        <label for="image">Photo</label>
                      <input type="file" name="image" class="form-control" >
                      @error('image')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Feedback</label>
                      <textarea name="comment" class="form-control" placeholder="Feedback goes here..">{{old('comment',$testimonial->comment)}}</textarea>
                      @error('comment')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Update Testimonial" class="btn btn-success">
                    </div>
                  </form>
            </div>
        </div>
      
    </div>
@endsection

