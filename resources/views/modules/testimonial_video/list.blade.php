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
                                <th>Title</th>
                                <th>Video</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td>{{$testimonial->id}}</td>
                                    <td>{{$testimonial->title}}</td>
                                    <td>
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$testimonial->video_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </td>
                                    <td><a href="{{route('admin.testimonial.video.edit',$testimonial->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.testimonial.video.delete',$testimonial->id)}}" onclick="return confirm('Are you sure want to delete?')" class="btn btn-sm btn-danger">Delete</a>
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