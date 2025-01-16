<?php

namespace App\Http\Controllers;

use App\DataTables\ContactEnquiryDataTable;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;

class ContactEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactEnquiryDataTable $dataTable)
    {
        return $dataTable->render('modules.contact-enquiry.index');
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
     * @param  \App\Models\ContactEnquiry  $contactEnquiry
     * @return \Illuminate\Http\Response
     */
    public function show(ContactEnquiry $contactEnquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactEnquiry  $contactEnquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactEnquiry $contactEnquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactEnquiry  $contactEnquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactEnquiry $contactEnquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactEnquiry  $contactEnquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactEnquiry $contactEnquiry)
    {
        $contactEnquiry->delete();

        return redirect()->back()->with("success", "Success! Data has been deleted.");
    }
}
