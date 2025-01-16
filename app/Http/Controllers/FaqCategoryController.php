<?php

namespace App\Http\Controllers;

use App\DataTables\FaqCategoryDataTable;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FaqCategoryDataTable $dataTable)
    {
        request()->flush();
        return $dataTable->render('modules.faq-category.index');
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
                'unique:faq_categories,name'
            ],
        ]);

        $faqCategory = new FaqCategory();
        $faqCategory->name = $request->name;
        $faqCategory->slug = Str::slug($request->name, '-');
        $faqCategory->description = $request->description;
        $faqCategory->save();

        $faqCategory->slug .= "-" . base64_encode($faqCategory->id);
        $faqCategory->save();

        return redirect()->back()->with('success', 'Success! New entry has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, FaqCategory $faqCategory)
    {
        $request->replace($faqCategory->toArray());
        $request->flash();

        return view('modules.faq-category.edit', compact('faqCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FaqCategory $faqCategory)
    {
        $request->validate([
            'name' => [
                'required',
                'unique:faq_categories,name,' . $faqCategory->id . ',id'
            ],
        ]);

        $faqCategory->name = $request->name;
        $faqCategory->slug = Str::slug($request->name, '-');
        $faqCategory->description = $request->description;
        $faqCategory->save();

        $faqCategory->slug .= "-" . base64_encode($faqCategory->id);
        $faqCategory->save();

        return redirect(route('admin.faq-category.index'))->with('success', 'Success! A entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }
}
