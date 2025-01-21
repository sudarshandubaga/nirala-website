<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CareerEnquiry;
use App\Models\CareerPost;
use Illuminate\Http\Request;

class CareerPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $careerPosts = CareerPost::latest()->get();
        $posts = CareerPost::latest()->pluck('title', 'id');

        if ($request?->response == "json")
            return response()->json($posts);

        return view('web.inc.career-post.index', compact('careerPosts', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email'  => 'required|email',
            'phone'  => 'required',
            'career_post_id'  => 'required|numeric',
            'resume' => 'required|mimes:pdf,doc,docx'
        ]);

        $careerPost = new CareerEnquiry($request->except('resume'));
        if ($request->hasFile('resume')) {
            $careerPost->resume = $request->file('resume')->store('resume', 'public');
        }
        $careerPost->save();

        return redirect()->back()->with('success', 'Success! Your request has been submitted, our HR team will contact you shortly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CareerPost  $careerPost
     * @return \Illuminate\Http\Response
     */
    public function show(CareerPost $careerPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CareerPost  $careerPost
     * @return \Illuminate\Http\Response
     */
    public function edit(CareerPost $careerPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CareerPost  $careerPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CareerPost $careerPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareerPost  $careerPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareerPost $careerPost)
    {
        //
    }
}
