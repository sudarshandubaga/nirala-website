<?php

namespace App\Http\Controllers;

use App\DataTables\MediaCategoryDataTable;
use App\Models\MediaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MediaCategoryDataTable $dataTable)
    {
        request()->flush();
        return $dataTable->render('modules.media-category.index');
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
                'unique:media_categories,name'
            ],
        ]);

        $mediaCategory = new MediaCategory();
        $mediaCategory->name = $request->name;
        $mediaCategory->slug = Str::slug($request->name, '-');
        $mediaCategory->save();

        $mediaCategory->slug .= "-" . base64_encode($mediaCategory->id);
        $mediaCategory->save();

        return redirect()->back()->with('success', 'Success! New entry has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MediaCategory  $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MediaCategory $mediaCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MediaCategory  $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MediaCategory $mediaCategory)
    {
        $request->replace($mediaCategory->toArray());
        $request->flash();

        return view('modules.media-category.edit', compact('mediaCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MediaCategory  $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaCategory $mediaCategory)
    {
        $request->validate([
            'name' => [
                'required',
                'unique:media_categories,name,' . $mediaCategory->id . ',id'
            ],
        ]);

        $mediaCategory->name = $request->name;
        $mediaCategory->slug = Str::slug($request->name, '-');
        $mediaCategory->save();

        $mediaCategory->slug .= "-" . base64_encode($mediaCategory->id);
        $mediaCategory->save();

        return redirect(route('admin.media-category.index'))->with('success', 'Success! A entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MediaCategory  $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaCategory $mediaCategory)
    {
        $mediaCategory->delete();

        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }
}
