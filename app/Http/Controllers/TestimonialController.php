<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    function index()
    {
        return view('modules.testimonial.form');
    }
    function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);
        $image=$req->file('image');
        $ext=$image->extension();
        $file=time().'.'.$ext;
        $image->move('uploads/',$file);
        //$image=$image->storeAs('public/uploads',$file);
        $data=array(
            'name'=>$req->name,
            'designation'=>$req->designation,
            'comment'=>$req->comment,
            'image'=>$file,
        );
        Testimonial::create($data);
        return redirect()->route('admin.testimonial.create')->with('success','Testimonial Added Successfully');
    }
    function read()
    {
        $data['testimonials']=Testimonial::latest()->get();
        return view('modules.testimonial.list',$data);
    }
    function delete($id)
    {
        $data=Testimonial::find($id);
        $destination='uploads/'.$data->image;
        if(File::exists($destination)):
            File::delete($destination);
        endif;
        $data->delete();
        return redirect()->route('admin.testimonial.read')->with('success','Testimonial Deleted Successfully');
    }
    function edit($id)
    {
        $data['testimonial']=Testimonial::find($id);
        return view('modules.testimonial.edit_form',$data);
    }
    function update(Request $req, $id)
    {
        $data=Testimonial::find($id);
        $destination='uploads/'.$data->image;
        $data->name=$req->name;
        $data->designation=$req->designation;
        $data->comment=$req->comment;
        if($req->hasFile('image')):
            if(File::exists($destination)):
                File::delete($destination);
            endif;
            $image=$req->file('image');
            $ext=$image->extension();
            $file=time().'.'.$ext;
            $image->move('uploads/',$file);
            $data->image=$file;
        endif;
        $data->update();
        return redirect()->route('admin.testimonial.read')->with('success','Testimonial Updated Successfully');
    }
    
}
