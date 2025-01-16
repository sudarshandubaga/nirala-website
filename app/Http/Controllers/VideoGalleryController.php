<?php

namespace App\Http\Controllers;

use App\DataTables\VideoGalleryDataTable;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VideoGalleryDataTable $dataTable)
    {
        request()->flush();
        return $dataTable->render('modules.video-gallery.index');
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
            'title' => [
                'required',
                'unique:video_galleries,title'
            ],
            'video_id' => 'required'
        ]);

        $videoGallery = new VideoGallery();
        $videoGallery->title = $request->title;
        $videoGallery->video_id = $request->video_id;

        $videoGallery->save();

        return redirect()->back()->with('success', 'Success! New entry has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoGallery  $videoGallery
     * @return \Illuminate\Http\Response
     */
    public function show(VideoGallery $videoGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoGallery  $videoGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, VideoGallery $videoGallery)
    {
        $request->replace($videoGallery->toArray());
        $request->flash();

        return view('modules.video-gallery.edit', compact('video-gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoGallery  $videoGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoGallery $videoGallery)
    {
        $request->validate([
            'title' => [
                'required',
                'unique:video_galleries,title,' . $videoGallery->id . ',id'
            ],
            'video_id' => 'required'
        ]);

        $videoGallery->title = $request->title;
        $videoGallery->video_id = $request->video_id;
        $videoGallery->save();

        return redirect(route('admin.video-gallery.index'))->with('success', 'Success! A entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoGallery  $videoGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoGallery $videoGallery)
    {
        $videoGallery->delete();

        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }
}
