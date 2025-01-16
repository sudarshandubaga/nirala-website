<?php

namespace App\Http\Controllers;

use App\DataTables\ConstructionUpdateDataTable;
use App\Models\Project;
use App\Models\ConstructionUpdate;
use App\Models\ConstructionUpdateImage;
use App\Models\Flat;
use App\Models\Phase;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConstructionUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ConstructionUpdateDataTable $dataTable)
    {
        return $dataTable->render('modules.constructionUpdate.index');
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

        $phases = $towers = $flats = [];

        return view('modules.constructionUpdate.create', compact('projects', 'phases', 'towers', 'flats'));
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

        $constructionUpdate = new ConstructionUpdate();
        $constructionUpdate->title = $request->title;
        // $constructionUpdate->slug = Str::slug($request->title, '-');

        $constructionUpdate->tower_id = $request->tower_id;
        $constructionUpdate->description = $request->description;
        $constructionUpdate->save();

        // $constructionUpdate->slug .= '-' . $constructionUpdate->id;
        // $constructionUpdate->save();

        if (!empty($request->images)) {
            ConstructionUpdateImage::where('construction_update_id', $constructionUpdate->id)->delete();

            foreach ($request->images as $cuImage) {
                $constructionUpdateImage = new ConstructionUpdateImage();
                $constructionUpdateImage->construction_update_id = $constructionUpdate->id;
                $constructionUpdateImage->image = $cuImage['image'];
                $constructionUpdateImage->title = $cuImage['title'];
                $constructionUpdateImage->save();
            }
        }

        return redirect(route('admin.construction-update.index'))->with('success', 'Success! New entry has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConstructionUpdate  $constructionUpdate
     * @return \Illuminate\Http\Response
     */
    public function show(ConstructionUpdate $constructionUpdate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConstructionUpdate  $constructionUpdate
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ConstructionUpdate $constructionUpdate)
    {
        $projects = $phases = $towers = $flats = [];
        $reqData = $constructionUpdate->toArray();
        if (!empty($constructionUpdate->tower_id)) {
            $phases = Phase::where('project_id', $constructionUpdate->tower->phase->project_id)->pluck('name', 'id');
            $reqData['project_id'] = $constructionUpdate->tower->phase->project_id;

            $towers = Tower::where('phase_id', $constructionUpdate->tower->phase_id)->pluck('name', 'id');
            $reqData['phase_id'] = $constructionUpdate->tower->phase_id;

            // $flats = Flat::where('tower_id', $constructionUpdate->tower_id)->pluck('name', 'id');
            // $reqData['tower_id'] = $constructionUpdate->tower_id;
        }

        $request->replace($reqData);
        $request->flash();

        $projects = Project::whereHas('category', function ($q) {
            $q->where('name', 'Ongoing');
        })->orderBy('name')->pluck('name', 'id');


        return view('modules.constructionUpdate.edit', compact('constructionUpdate', 'projects', 'phases', 'towers', 'flats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConstructionUpdate  $constructionUpdate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConstructionUpdate $constructionUpdate)
    {
        $request->validate([
            'title' => [
                'required',
            ],
        ]);

        $constructionUpdate->title = $request->title;
        $constructionUpdate->tower_id = $request->tower_id;
        $constructionUpdate->description = $request->description;
        $constructionUpdate->save();

        if (!empty($request->images)) {
            ConstructionUpdateImage::where('construction_update_id', $constructionUpdate->id)->delete();

            foreach ($request->images as $cuImage) {
                $constructionUpdateImage = new ConstructionUpdateImage();
                $constructionUpdateImage->construction_update_id = $constructionUpdate->id;
                $constructionUpdateImage->image = $cuImage['image'];
                $constructionUpdateImage->title = $cuImage['title'];
                $constructionUpdateImage->save();
            }
        }

        return redirect(route('admin.construction-update.index'))->with('success', 'Success! A entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConstructionUpdate  $constructionUpdate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConstructionUpdate $constructionUpdate)
    {
        $constructionUpdate->delete();

        return redirect()->back()->with("success", "Success! Data has been deleted.");
    }
}
