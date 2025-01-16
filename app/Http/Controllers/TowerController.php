<?php

namespace App\Http\Controllers;

use App\DataTables\TowerDataTable;
use App\Models\Category;
use App\Models\Phase;
use App\Models\Tower;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TowerDataTable $dataTable)
    {
        request()->flush();

        $categories = Category::has('projects')->orderBy('name')->pluck('name', 'id');
        $projects = $phases = [];
        foreach ($categories as $cId => $cName) {
            $projects[$cName] = Project::where('category_id', $cId)->latest()->pluck('name', 'id');
        }

        return $dataTable->render('modules.tower.index', compact('projects', 'phases'));
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
                Rule::unique('towers')->where(function ($q) use ($request) {
                    return $q->where('name', $request->name)->where('phase_id', $request->phase_id);
                })
            ],
            'project_id' => 'required|numeric',
            'phase_id' => 'required|numeric',
        ]);

        $tower = new Tower();
        $tower->phase_id = $request->phase_id;
        $tower->name = $request->name;
        $tower->save();

        return redirect()->back()->with('success', 'Success! New entry has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function show(Tower $tower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tower $tower)
    {
        $projects = $phases = [];
        $reqData = $tower->toArray();
        if (!empty($tower->phase_id)) {
            $phases = Phase::where('project_id', $tower->phase->project_id)->pluck('name', 'id');
            $reqData['project_id'] = $tower->phase->project_id;
        }

        $request->replace($reqData);
        $request->flash();

        $categories = Category::has('projects')->orderBy('name')->pluck('name', 'id');
        foreach ($categories as $cId => $cName) {
            $projects[$cName] = Project::where('category_id', $cId)->latest()->pluck('name', 'id');
        }


        return view('modules.tower.edit', compact('tower', 'projects', 'phases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tower $tower)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('towers')->where(function ($q) use ($request, $tower) {
                    return $q->where('name', $request->name)->where('phase_id', $request->phase_id)->whereNot('id', $tower->id);
                })
            ],
            'project_id' => 'required|numeric',
            'phase_id' => 'required|numeric',
        ]);

        $tower->name = $request->name;
        $tower->phase_id = $request->phase_id;
        $tower->save();

        return redirect(route('admin.tower.index'))->with('success', 'Success! A entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tower $tower)
    {
        $tower->delete();

        return redirect()->back()->with("success", "Success! A entry has been deleted.");
    }


    public function get_list(Request $request)
    {
        $phases = Tower::where('phase_id', $request->phase_id)->pluck('name', 'id');

        return response()->json($phases);
    }
}
