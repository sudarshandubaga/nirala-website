<?php

namespace App\Http\Controllers;

use App\DataTables\CareerEnquiryDataTable;
use App\Models\CareerEnquiry;
use Illuminate\Http\Request;

class CareerEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CareerEnquiryDataTable $dataTable)
    {
        return $dataTable->render('modules.career-enquiry.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CareerEnquiry  $careerEnquiry
     * @return \Illuminate\Http\Response
     */
    public function show(CareerEnquiry $careerEnquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CareerEnquiry  $careerEnquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(CareerEnquiry $careerEnquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CareerEnquiry  $careerEnquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CareerEnquiry $careerEnquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareerEnquiry  $careerEnquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareerEnquiry $careerEnquiry)
    {
        $careerEnquiry->delete();

        return redirect()->back()->with("success", "Success! Data has been deleted.");
    }
}
