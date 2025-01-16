<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectDataTable;
use App\Models\Category;
use App\Models\Phase;
use App\Models\Project;
// use App\Models\ProjectDownload;
// use App\Models\ProjectImage;
// use App\Models\ProjectPaymentPlan;
// use App\Models\ProjectUnitPlan;
// use App\Models\ProjectView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectDataTable $dataTable)
    {
        return $dataTable->render('modules.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->flush();

        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('modules.project.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::slug(strtolower($request->name), "-");

        $project = new Project();
        $project->name = $request->name;
        $project->slug = $slug;
        $project->category_id = $request->category_id;

        if (!empty($request->image)) {
            $dataRes = $this->dataUriToImage($request->image);
            extract($dataRes);

            Storage::disk("public")->put("projects/" . $fileName, $data);
            $project->image = "projects/" . $fileName;
        }

        if (!empty($request->bg_image)) {
            $dataRes = $this->dataUriToImage($request->bg_image);
            extract($dataRes);

            Storage::disk("public")->put("projects/" . $fileName, $data);
            $project->bg_image = "projects/" . $fileName;
        }

        $project->save();

        $project->slug .= "-" . ($project->id + 50);
        $project->save();

        return redirect(route('admin.project.index'))->with('success', 'Success! New project has been added.');
    }

    protected function dataUriToImage($dataUri)
    {
        @list($type, $image) = explode(';base64,', $dataUri);
        $extension = substr($type, 11, strlen($type));

        // $image = $imageArr[1];
        $image = str_replace(' ', '+', $image);
        $data = base64_decode($image);

        $fileName = uniqid() . "." . $extension;

        return compact('data', 'fileName');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        request()->replace($project->toArray());
        request()->flash();

        $categories = Category::orderBy('name')->pluck('name', 'id');

        return view('modules.project.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->name = $request->name;
        $project->category_id = $request->category_id;

        if (!empty($request->image)) {
            $dataRes = $this->dataUriToImage($request->image);
            extract($dataRes);

            Storage::disk("public")->put("projects/" . $fileName, $data);
            $project->image = "projects/" . $fileName;
        }

        if (!empty($request->bg_image)) {
            $dataRes = $this->dataUriToImage($request->bg_image);
            extract($dataRes);

            Storage::disk("public")->put("projects/" . $fileName, $data);
            $project->bg_image = "projects/" . $fileName;
        }

        $project->save();

        return redirect(route('admin.project.index'))->with('success', 'Success! Project has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }
}
