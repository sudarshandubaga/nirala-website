<?php

namespace App\Http\Controllers;

use App\DataTables\PhaseDataTable;
use App\Models\Category;
use App\Models\Project;
use App\Models\Phase;
use App\Models\PhaseDownload;
use App\Models\PhaseImage;
use App\Models\PhaseNewPriceList;
use App\Models\PhasePaymentPlan;
use App\Models\PhasePriceList;
use App\Models\PhaseUnitPlan;
use App\Models\PhaseView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PhaseDataTable $dataTable)
    {
        request()->flush();
        return $dataTable->render('modules.phase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->flush();
        $projects = Project::orderBy('name')->pluck('name', 'id');
        return view('modules.phase.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::slug(strtolower($request->name), "-");
        $phase = new Phase();
        $phase->name = $request->name;
        $phase->slug = $slug;
        $phase->project_id = $request->project_id;
        $phase->overview = $request->overview;
        $phase->location_advantages = $request->location_advantages;
        $phase->specification = $request->specification;
        $phase->price_list = $request->price_list;


        if (!empty($request->image)) {
            $dataRes = $this->dataUriToImage($request->image);
            extract($dataRes);

            Storage::disk("public")->put("phases/" . $fileName, $data);
            $phase->image = "phases/" . $fileName;
        }

        if (!empty($request->location_image)) {
            $dataRes = $this->dataUriToImage($request->location_image);
            extract($dataRes);

            Storage::disk("public")->put("phases-location/" . $fileName, $data);

            $phase->location_image = "phases-location/" . $fileName;
        }

        $phase->save();

        $phase->slug .= "-" . ($phase->id + 50);
        $phase->save();

        if (!empty($request->images)) :
            foreach ($request->images as $image) {
                if (!empty($image)) {
                    $dataRes = $this->dataUriToImage($image);
                    extract($dataRes);

                    $phaseImage = new PhaseImage();
                    $phaseImage->phase_id = $phase->id;
                    Storage::disk("public")->put("product-images/" . $fileName, $data);
                    $phaseImage->image = "product-images/" . $fileName;
                    $phaseImage->save();
                }
            }
        endif;

        if (!empty($request->unit_images)) :
            foreach ($request->unit_images as $image) {
                if (!empty($image)) {
                    $dataRes = $this->dataUriToImage($image);
                    extract($dataRes);

                    $unitImage = new PhaseUnitPlan();
                    $unitImage->phase_id = $phase->id;
                    Storage::disk("public")->put("phase-units/" . $fileName, $data);
                    $unitImage->image = "phase-units/" . $fileName;
                    $unitImage->save();
                }
            }
        endif;

        if (!empty($request->view_images)) :
            foreach ($request->view_images as $image) {
                if (!empty($image)) {
                    $dataRes = $this->dataUriToImage($image);
                    extract($dataRes);

                    $phaseView = new PhaseView();
                    $phaseView->phase_id = $phase->id;
                    Storage::disk("public")->put("phase-views/" . $fileName, $data);
                    $phaseView->image = "phase-views/" . $fileName;
                    $phaseView->save();
                }
            }
        endif;

        if (!empty($request->price_list_images)) :
            foreach ($request->price_list_images as $image) {
                if (!empty($image)) {
                    $dataRes = $this->dataUriToImage($image);
                    extract($dataRes);

                    $phasePriceList = new PhasePriceList();
                    $phasePriceList->phase_id = $phase->id;
                    Storage::disk("public")->put("phase_price_lists/" . $fileName, $data);
                    $phasePriceList->image = "phase_price_lists/" . $fileName;
                    $phasePriceList->save();
                }
            }
        endif;

        if (!empty($request->download['title'])) :
            $files = $request->file('download_file');
            foreach ($files as $index => $file) {
                $phaseDownload = new PhaseDownload();
                $phaseDownload->phase_id = $phase->id;
                $phaseDownload->title = $request->download['title'][$index];
                $phaseDownload->file = $file->store("downloads", "public");
                $phaseDownload->save();
            }
        endif;

        if (!empty($request->payment['title'])) :
            $files = $request->file('payment_file');
            foreach ($files as $index => $file) {
                $phasePaymentPlan = new PhasePaymentPlan();
                $phasePaymentPlan->phase_id = $phase->id;
                $phasePaymentPlan->title = $request->payment['title'][$index];
                $phasePaymentPlan->file = $file->store("payments", "public");
                $phasePaymentPlan->save();
            }
        endif;

        return redirect(route('admin.phase.index'))->with('success', 'Success! New phase has been added.');
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
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function show(Phase $phase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function edit(Phase $phase)
    {
        request()->replace($phase->toArray());
        request()->flash();

        $projects = Project::orderBy('name')->pluck('name', 'id');

        return view('modules.phase.edit', compact('phase', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phase $phase)
    {
        $phase->name = $request->name;
        $phase->project_id = $request->project_id;
        $phase->overview = $request->overview;
        $phase->location_advantages = $request->location_advantages;
        $phase->specification = $request->specification;
        $phase->price_list = $request->price_list;

        if (!empty($request->image)) {
            $dataRes = $this->dataUriToImage($request->image);
            extract($dataRes);

            Storage::disk("public")->put("phases/" . $fileName, $data);
            $phase->image = "phases/" . $fileName;
        }

        if (!empty($request->location_image)) {
            $dataRes = $this->dataUriToImage($request->location_image);
            extract($dataRes);

            Storage::disk("public")->put("phases-location/" . $fileName, $data);

            $phase->location_image = "phases-location/" . $fileName;
        }

        if (!empty($request->price_list_image)) {
            $dataRes = $this->dataUriToImage($request->price_list_image);
            extract($dataRes);

            Storage::disk("public")->put("phases-pricelist/" . $fileName, $data);

            $phase->price_list_image = "phases-pricelist/" . $fileName;
        }

        $phase->save();

        if (!empty($request->images)) :
            foreach ($request->images as $image) {
                if (!empty($image)) {
                    $dataRes = $this->dataUriToImage($image);
                    extract($dataRes);

                    $phaseImage = new PhaseImage();
                    $phaseImage->phase_id = $phase->id;
                    Storage::disk("public")->put("phase-images/" . $fileName, $data);
                    $phaseImage->image = "phase-images/" . $fileName;
                    $phaseImage->save();
                }
            }
        endif;

        if (!empty($request->unit_images)) :
            foreach ($request->unit_images as $image) {
                if (!empty($image)) {
                    $dataRes = $this->dataUriToImage($image);
                    extract($dataRes);

                    $unitImage = new PhaseUnitPlan();
                    $unitImage->phase_id = $phase->id;
                    Storage::disk("public")->put("phase-units/" . $fileName, $data);
                    $unitImage->image = "phase-units/" . $fileName;
                    $unitImage->save();
                }
            }
        endif;

        if (!empty($request->view_images)) :
            foreach ($request->view_images as $image) {
                if (!empty($image)) {
                    $dataRes = $this->dataUriToImage($image);
                    extract($dataRes);

                    $phaseView = new PhaseView();
                    $phaseView->phase_id = $phase->id;
                    Storage::disk("public")->put("phase-views/" . $fileName, $data);
                    $phaseView->image = "phase-views/" . $fileName;
                    $phaseView->save();
                }
            }
        endif;


        if (!empty($request->price_list_images)) :
            foreach ($request->price_list_images as $image) {
                if (!empty($image)) {
                    $dataRes = $this->dataUriToImage($image);
                    extract($dataRes);

                    $phasePriceList = new PhasePriceList();
                    $phasePriceList->phase_id = $phase->id;
                    Storage::disk("public")->put("phase_price_lists/" . $fileName, $data);
                    $phasePriceList->image = "phase_price_lists/" . $fileName;
                    $phasePriceList->save();
                }
            }
        endif;

        if (!empty($request->download['title'])) :
            $files = $request->file('download_file');
            foreach ($files as $index => $file) {
                $phaseDownload = new PhaseDownload();
                $phaseDownload->phase_id = $phase->id;
                $phaseDownload->title = $request->download['title'][$index];
                $phaseDownload->file = $file->store("downloads", "public");
                $phaseDownload->save();
            }
        endif;

        if (!empty($request->payment['title'])) :
            $files = $request->file('payment_file');
            foreach ($files as $index => $file) {
                $phasePaymentPlan = new PhasePaymentPlan();
                $phasePaymentPlan->phase_id = $phase->id;
                $phasePaymentPlan->title = $request->payment['title'][$index];
                $phasePaymentPlan->file = $file->store("payments", "public");
                $phasePaymentPlan->save();
            }
        endif;
        // dd($request->new_price);
        if (!empty($request->new_price)) {
            $insertData = [];
            foreach ($request->new_price["title"] as $index => $title) {
                $insertData[] = [
                    'phase_id' => $phase->id,
                    'title' => $title,
                    'size' => $request->new_price["size"][$index] ?? null,
                    'price' => $request->new_price["price"][$index] ?? 0 // Default to 0 if price is missing
                ];
            }
            // Check if there's data to insert
            if (!empty($insertData)) {
                PhaseNewPriceList::insert($insertData);
            }
        }
        return redirect(route('admin.phase.index'))->with('success', 'Success! Phase has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phase $phase)
    {
        $phase->delete();
        return redirect()->back()->with("success", "Success! Record has been deleted.");
    }

    public function get_list(Request $request)
    {
        $phases = Phase::where('project_id', $request->project_id)->pluck('name', 'id');

        return response()->json($phases);
    }

    public function removeImage(Request $request)
    {
        switch ($request->name) {
            case 'images':
                $image = PhaseImage::find($request->id);
                break;

            case 'unit_images':
                $image = PhaseUnitPlan::find($request->id);
                break;

            case 'view_images':
                $image = PhaseView::find($request->id);
                break;

            case 'price_list_images':
                $image = PhasePriceList::find($request->id);
                break;

            case 'download':
                $file = PhaseDownload::find($request->id);
                break;

            case 'payment_plan':
                $file = PhasePaymentPlan::find($request->id);
                break;

            case 'new_price_list': // Handling for new_price_list
                $file = PhaseNewPriceList::find($request->id);
                break;

            default:
                return response()->json(['message' => 'Invalid type.'], 400);
        }

        if (!empty($image)) {
            // For images: check and remove the file, then delete the record
            if (file_exists(public_path() . "/storage/" . $image->image)) {
                unlink(public_path() . "/storage/" . $image->image);
            }
            $image->delete();
        } elseif (!empty($file)) {
            // For files (including new_price_list): delete the record
            if (!empty($file->file) && file_exists(public_path() . "/storage/" . $file->file)) {
                unlink(public_path() . "/storage/" . $file->file);
            }
            $file->delete();
        } else {
            return response()->json(['message' => 'Record not found.'], 404);
        }

        return response()->json(['message' => 'Record deleted successfully.']);
    }
}
