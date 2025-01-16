<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        request()->flush();
        return $dataTable->render('modules.category.index');
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
                'unique:categories,name'
            ],
            'slug' => [
                'required',
                'regex:/^[a-z0-9\-]+/',
                'unique:categories,slug'
            ],
            // 'image' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;

        if (!empty($request->image)) {
            $category->image = dataUriToImage($request->image, "categories");
        }

        $category->save();
        return redirect()->back()->with('success', 'Success! New entry has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        $request->replace($category->toArray());
        $request->flash();

        return view('modules.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'required',
                'unique:categories,name,' . $category->id . ',id'
            ],
            'image' => 'required',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug;
        if (!empty($request->image)) {
            if (!empty($category->image))
                Storage::delete($category->getRawOriginal('image'));

            $category->image = dataUriToImage($request->image, "categories");
        }
        $category->save();

        return redirect(route('admin.category.index'))->with('success', 'Success! A entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }
}
