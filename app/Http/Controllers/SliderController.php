<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SliderDataTable $dataTable)
    {
        request()->flush();
        return $dataTable->render('modules.slider.index');
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
            // 'title' => [
            //     'required',
            // ],
            'image' => 'required'
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        if (!empty($request->image)) {
            $slider->image = dataUriToImage($request->image, "sliders");
        }
        $slider->save();

        return redirect()->back()->with('success', 'Success! New entry has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Slider $slider)
    {
        $request->replace($slider->toArray());
        $request->flash();

        return view('modules.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        // $request->validate([
        //     'title' => [
        //         'required',
        //         'unique:sliders,title,' . $slider->id . ',id'
        //     ],
        // ]);

        $slider->title = $request->title;
        if (!empty($request->image)) {
            Storage::delete($slider->image);

            $slider->image = dataUriToImage($request->image, "sliders");
        }
        $slider->save();

        return redirect(route('admin.slider.index'))->with('success', 'Success! A entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->back()->with("success", "Success! A entry has been deleted.");
    }
}
