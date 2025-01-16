<?php

namespace App\Http\Controllers;

use App\DataTables\FlatDataTable;
use App\Models\Category;
use App\Models\Flat;
use App\Models\Phase;
use App\Models\Project;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FlatDataTable $dataTable)
    {
        request()->flush();

        $categories = Category::has('projects')->orderBy('name')->pluck('name', 'id');
        $projects = $phases = $towers = [];
        foreach ($categories as $cId => $cName) {
            $projects[$cName] = Project::where('category_id', $cId)->latest()->pluck('name', 'id');
        }

        return $dataTable->render('modules.flat.index', compact('projects', 'phases', 'towers'));
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
            'name' => [
                'required',
                Rule::unique('flats')->where(function ($q) use ($request) {
                    return $q->where('name', $request->name)
                        ->where('tower_id', $request->tower_id);
                })
            ],
            'project_id' => 'required|numeric',
            'phase_id' => 'required|numeric',
            'tower_id' => 'required|numeric',
        ]);

        $flat = new Flat();
        $flat->tower_id = $request->tower_id;
        $flat->name = $request->name;
        $flat->save();

        return redirect()->back()->with('success', 'Success! New entry has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Flat $flat)
    {
        $projects = $phases = [];
        $reqData = $flat->toArray();
        if (!empty($flat->tower_id)) {
            $phases = Phase::where('project_id', $flat->tower->phase->project_id)->pluck('name', 'id');
            $reqData['project_id'] = $flat->tower->phase->project_id;

            $towers = Tower::where('phase_id', $flat->tower->phase_id)->pluck('name', 'id');
            $reqData['phase_id'] = $flat->tower->phase_id;
        }

        $request->replace($reqData);
        $request->flash();

        $categories = Category::has('projects')->orderBy('name')->pluck('name', 'id');
        $projects =  [];
        foreach ($categories as $cId => $cName) {
            $projects[$cName] = Project::where('category_id', $cId)->latest()->pluck('name', 'id');
        }

        return view('modules.flat.edit', compact('flat', 'projects', 'phases', 'towers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('flats')->where(function ($q) use ($request, $flat) {
                    return $q->where('name', $request->name)->where('tower_id', $request->tower_id)->whereNot('id', $flat->id);
                })
            ],
            'project_id' => 'required|numeric',
            'phase_id' => 'required|numeric',
            'tower_id' => 'required|numeric',
        ]);

        $flat->name = $request->name;
        $flat->tower_id = $request->tower_id;
        $flat->save();

        return redirect(route('admin.flat.index'))->with('success', 'Success! A entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        $flat->delete();

        return redirect()->back()->with("success", "Success! A entry has been deleted.");
    }

    public function get_list(Request $request)
    {
        $phases = Flat::where('tower_id', $request->tower_id)->pluck('name', 'id');

        return response()->json($phases);
    }
}
