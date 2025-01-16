<?php

namespace App\Http\Controllers;

use App\DataTables\FaqDataTable;
use App\Models\FaqCategory;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FaqDataTable $dataTable)
    {
        return $dataTable->render('modules.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->flush();

        $faqCategories = FaqCategory::orderBy('name')->pluck('name', 'id');
        return view('modules.faq.create', compact('faqCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::slug(strtolower($request->title), "-");

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->faq_category_id = $request->faq_category_id;
        $faq->save();

        return redirect(route('admin.faq.index'))->with('success', 'Success! New faq has been added.');
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
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        request()->replace($faq->toArray());
        request()->flash();

        $faqCategories = FaqCategory::orderBy('name')->pluck('name', 'id');

        return view('modules.faq.edit', compact('faq', 'faqCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->faq_category_id = $request->faq_category_id;
        $faq->save();

        return redirect(route('admin.faq.index'))->with('success', 'Success! Faq has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }
}
