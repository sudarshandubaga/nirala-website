<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    function index()
    {
        return view('modules.blog.form');
    }
    function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);
        $image=$req->file('image');
        $ext=$image->extension();
        $file=time().'.'.$ext;
        $image->move('uploads/',$file);
        //$image=$image->storeAs('public/uploads',$file);
        $data=array(
            'title'=>$req->title,
            'slug'=>$req->slug,
            'description'=>$req->description,
            'image'=>$file,
        );
        Blog::create($data);
        return redirect()->route('admin.blog.create')->with('success','Blog Added Successfully');
    }
    function read()
    {
        $data['blogs']=Blog::latest()->get();
        return view('modules.blog.list',$data);
    }
    function delete($id)
    {
        $data=Blog::find($id);
        $destination='uploads/'.$data->image;
        if(File::exists($destination)):
            File::delete($destination);
        endif;
        $data->delete();
        return redirect()->route('admin.blog.read')->with('success','Blog Deleted Successfully');
    }
    function edit($id)
    {
        $data['blog']=Blog::find($id);
        return view('modules.blog.edit_form',$data);
    }
    function update(Request $req, $id)
    {
        $data=Blog::find($id);
        $destination='uploads/'.$data->image;
        $data->title=$req->title;
        $data->slug=$req->slug;
        $data->description=$req->description;
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
        return redirect()->route('admin.blog.read')->with('success','Blog Updated Successfully');
    }
    //ckeditor image upload 
    public function ckeditorImageUpload(Request $req)
    {
        if($req->hasFile('upload')):
            $image=$req->file('upload');
            $ext=$image->extension();
            $file=time().'.'.$ext;
            $image->move('uploads/',$file);
            $url = asset('uploads/'.$file);
            return response()->json(['fileName'=>$file,'uploaded'=>1,'url'=>$url]);
        endif;
    }
}