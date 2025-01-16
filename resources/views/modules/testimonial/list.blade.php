@extends('layouts.afterlogin')
@section('admin_content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4 position-sticky top-0" style="z-index: 1;">
            <x-alert />
            <div class="card-header">
                 Testimonial List
            </div>
            <div class="card-body py-2">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Feedback</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td>{{$testimonial->id}}</td>
                                    <td><img src="{{asset('uploads/'.$testimonial->image)}}" style="height:100px;width:120px;border-radius:10px;"></td>
                                    <td>{{$testimonial->name}}</td>
                                    <td>{{$testimonial->designation}}</td>
                                    <td>{{$testimonial->comment}}</td>
                                    <td><a href="{{route('admin.testimonial.edit',$testimonial->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.testimonial.delete',$testimonial->id)}}" onclick="return confirm('Are you sure want to delete?')" class="btn btn-sm btn-danger">Delete</a>
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

