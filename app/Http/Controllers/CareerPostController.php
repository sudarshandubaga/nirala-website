<?php

namespace App\Http\Controllers;

use App\DataTables\CareerPostDataTable;
use App\Models\Project;
use App\Models\CareerPost;
use App\Models\CareerPostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CareerPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CareerPostDataTable $dataTable)
    {
        return $dataTable->render('modules.careerPost.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->flush();

        $projects = Project::whereHas('category', function ($q) {
            $q->where('name', 'Ongoing');
        })->orderBy('name')->pluck('name', 'id');

        return view('modules.careerPost.create', compact('projects'));
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
            'title' => [
                'required',
            ],
        ]);

        $careerPost = new CareerPost();
        $careerPost->title = $request->title;
        $careerPost->slug = Str::slug($request->title, '-');
        $careerPost->description = $request->description;
        $careerPost->department = $request->department;
        $careerPost->total_posts = $request->total_posts;
        $careerPost->location = $request->location;
        $careerPost->qualification = $request->qualification;
        $careerPost->min_exp = $request->min_exp;
        $careerPost->save();

        $careerPost->slug .= "-" . $careerPost->id;
        $careerPost->save();

        return redirect(route('admin.career-post.index'))->with('success', 'Success! New entry has been added.');
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
    public function edit(Request $request, CareerPost $careerPost)
    {
        $request->replace($careerPost->toArray());
        $request->flash();

        $projects = Project::whereHas('category', function ($q) {
            $q->where('name', 'Ongoing');
        })->orderBy('name')->pluck('name', 'id');


        return view('modules.careerPost.edit', compact('careerPost', 'projects'));
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
        $request->validate([
            'title' => [
                'required',
            ],
        ]);

        $careerPost->title = $request->title;
        $careerPost->description = $request->description;
        $careerPost->department = $request->department;
        $careerPost->total_posts = $request->total_posts;
        $careerPost->location = $request->location;
        $careerPost->qualification = $request->qualification;
        $careerPost->min_exp = $request->min_exp;
        $careerPost->save();

        return redirect(route('admin.career-post.index'))->with('success', 'Success! A entry has been updated.');
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
        $careerPost->delete();

        return redirect()->back()->with("success", "Success! Data has been deleted.");
    }
}
