<?php

namespace App\Http\Controllers;

use App\Models\TestimonialVideo;
use Illuminate\Http\Request;

class TestimonialVideoController extends Controller
{
    function index()
    {
        return view('modules.testimonial_video.form');
    }
    function store(Request $req)
    {
        $req->validate([
            'video_id' => 'required',
            'title' => 'required'
        ]);
        $data=array(
            'video_id'=>$req->video_id,
            'title'=>$req->title
        );
        TestimonialVideo::create($data);
        return redirect()->route('admin.testimonial.video.create')->with('success','Testimonial Video Added Successfully');
    }
    function read()
    {
        $data['testimonials']=TestimonialVideo::latest()->get();
        return view('modules.testimonial_video.list',$data);
    }
    function delete($id)
    {
        $data=TestimonialVideo::find($id);
        $data->delete();
        return redirect()->route('admin.testimonial.video.read')->with('success','Testimonial Video Deleted Successfully');
    }
    function edit($id)
    {
        $data['testimonial']=TestimonialVideo::find($id);
        return view('modules.testimonial_video.edit_form',$data);
    }
    function update(Request $req, $id)
    {
        $data=TestimonialVideo::find($id);
        $data->video_id=$req->video_id;
        $data->title=$req->title;
        $data->update();
        return redirect()->route('admin.testimonial.video.read')->with('success','Testimonial Video Updated Successfully');
    }
}
