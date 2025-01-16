<?php

namespace App\Http\Controllers;

use App\DataTables\MediaDataTable;
use App\Models\MediaCategory;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MediaDataTable $dataTable)
    {
        return $dataTable->render('modules.media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->flush();

        $mediaCategories = MediaCategory::orderBy('name')->pluck('name', 'id');
        return view('modules.media.create', compact('mediaCategories'));
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

        $media = new Media();
        $media->title = $request->title;
        $media->slug = $slug;
        $media->description = $request->description;
        $media->media_category_id = $request->media_category_id;

        if (!empty($request->image)) {
            $dataRes = $this->dataUriToImage($request->image);
            extract($dataRes);

            Storage::disk("public")->put("medias/" . $fileName, $data);
            $media->image = "medias/" . $fileName;
        }

        $media->save();

        $media->slug .= "-" . base64_encode($media->id);
        $media->save();

        return redirect(route('admin.media.index'))->with('success', 'Success! New media has been added.');
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
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        request()->replace($media->toArray());
        request()->flash();

        $mediaCategories = MediaCategory::orderBy('name')->pluck('name', 'id');

        return view('modules.media.edit', compact('media', 'mediaCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        $slug = Str::slug(strtolower($request->title), "-");

        $media->title = $request->title;
        $media->slug = $slug;
        $media->description = $request->description;
        $media->media_category_id = $request->media_category_id;

        if (!empty($request->image)) {

            if (!empty($media->image)) {
                unlink(public_path() . "/storage/" . $media->getRawOriginal('image'));
            }

            $dataRes = $this->dataUriToImage($request->image);
            extract($dataRes);

            Storage::disk("public")->put("medias/" . $fileName, $data);
            $media->image = "medias/" . $fileName;
        }

        $media->save();

        $media->slug .= "-" . base64_encode($media->id);
        $media->save();

        return redirect(route('admin.media.index'))->with('success', 'Success! Media has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy( $mediaSlug)
    {
        $media = Media::where('slug', $mediaSlug)->firstOrFail();
        
        if (!empty($media->image) && file_exists(public_path() . "/storage/" . $media->getRawOriginal('image'))) {
            unlink(public_path() . "/storage/" . $media->getRawOriginal('image'));
        }

        $media->delete();
        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }
}
