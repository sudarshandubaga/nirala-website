
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
                 Blog List
            </div>
            <div class="card-body py-2">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{$blog->id}}</td>
                                    <td><img src="{{asset('uploads/'.$blog->image)}}" style="height:100px;width:120px;border-radius:10px;"></td>
                                    <td>{{$blog->title}}</td>
                                    <td>{{$blog->slug}}</td>
                                    <td><a href="{{route('admin.blog.edit',$blog->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.blog.delete',$blog->id)}}" onclick="return confirm('Are you sure want to delete?ss')" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
    </div>
@endsection

