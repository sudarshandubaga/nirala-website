<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $validated = $request->validate([
            'email' => 'required|email|unique:applicants,email',
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Save the data
        $data = $request->except('resume_file');
        if ($request->hasFile('resume_file')) {
            $data['resume_file'] = $request->file('resume_file')->store('resumes');
        }
        $applicant = Applicant::create($data);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.applicant-details', compact('applicant'));
        $pdfPath = storage_path('app/public/application_form.pdf');
        $pdf->save($pdfPath);

        // Send Email
        Mail::send([], [], function ($message) use ($applicant, $pdfPath) {
            $message->to($applicant->email)
                ->subject('Application Submission')
                ->attach($pdfPath, [
                    'as' => 'ApplicationForm.pdf',
                    'mime' => 'application/pdf',
                ])
                ->attach(storage_path('app/' . $applicant->resume_file), [
                    'as' => 'Resume.' . pathinfo($applicant->resume_file, PATHINFO_EXTENSION),
                    'mime' => mime_content_type(storage_path('app/' . $applicant->resume_file)),
                ])
                ->setBody('Your application has been submitted successfully.');
        });

        return response()->json(['message' => 'Application submitted successfully.'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
