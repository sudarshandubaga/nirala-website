<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ConstructionUpdate;
use App\Models\Flat;
use App\Models\Phase;
use App\Models\Project;
use App\Models\Tower;
use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    public function projects()
    {
        $projects = Project::whereHas('category', function ($q) {
            return $q->where('slug', 'ongoing');
        })->latest()->get();

        return view('web.inc.construction-update.projects', compact('projects'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Project $project)
    {

        $phases = Phase::where('project_id', $project->id)->pluck('name', 'id');

        $constructionUpdates = null;

        $towers = $flats = [];
        if (!empty($request->tower_id)) {

            $towers = Tower::where('phase_id', $request->phase_id)->pluck('name', 'id');
            // $flats = Flat::where('tower_id', $request->tower_id)->pluck('name', 'id');

            $request->replace($request->all());
            $request->flash();

            $constructionUpdates = ConstructionUpdate::where('tower_id', $request->tower_id)->latest()->get();
        } else {
            $request->flush();
        }

        return view('web.inc.construction-update.index', compact('project', 'phases', 'constructionUpdates', 'towers', 'flats'));
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
        //
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
    public function edit(ConstructionUpdate $constructionUpdate)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConstructionUpdate  $constructionUpdate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConstructionUpdate $constructionUpdate)
    {
        //
    }
}
