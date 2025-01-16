<?php

namespace App\Http\Controllers;

use App\DataTables\TeamDataTable;
use App\Models\Category;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TeamDataTable $dataTable)
    {
        return $dataTable->render('modules.team.index');
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
        return view('modules.team.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $team = new Team();
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->about = $request->about;


        if (!empty($request->image)) {
            $dataRes = $this->dataUriToImage($request->image);
            extract($dataRes);

            Storage::disk("public")->put("teams/" . $fileName, $data);
            $team->image = "teams/" . $fileName;
        }

        $team->save();

        return redirect(route('admin.team.index'))->with('success', 'Success! New team has been added.');
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
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        request()->replace($team->toArray());
        request()->flash();

        $categories = Category::orderBy('name')->pluck('name', 'id');

        return view('modules.team.edit', compact('team', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->about = $request->about;

        if (!empty($request->image)) {
            $dataRes = $this->dataUriToImage($request->image);
            extract($dataRes);

            Storage::disk("public")->put("teams/" . $fileName, $data);
            $team->image = "teams/" . $fileName;
        }

        $team->save();

        return redirect(route('admin.team.index'))->with('success', 'Success! Team has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }
}
