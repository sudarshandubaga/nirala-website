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
        $request->validate([
            'email' => 'required|email|unique:applicants,email',
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Save the data
        $data = $request->except([
            // Storage Files
            'resume_file',
            'image',
            'sign',
            // Array Fields
            'records',
            'employment_history',
            'references',
            'professional_memberships',
            'particulars',
        ]);
        if ($request->hasFile('resume_file')) {
            $data['resume_file'] = $request->file('resume_file')->store('resumes', 'public');
        }
        if (!empty($request->image)) {
            $data['image'] = dataUriToImage($request->image, "applicants");
        }
        if (!empty($request->sign)) {
            $data['sign'] = dataUriToImage($request->sign, "applicants");
        }

        $arrayFields = [
            'records',
            'employment_history',
            'references',
            'professional_membership',
            'particulars',
        ];
        foreach ($arrayFields as $arrField) {
            if (!empty($request->get($arrField)))
                $data[$arrField] = json_decode($request->get($arrField));
        }

        $applicant = Applicant::create($data);

        // Generate PDF
        $pdf = Pdf::loadView('emails.application_form', ['form' => $applicant->toArray()]);
        $application_form = 'applicants/application_form_' . time() . '.pdf';
        $pdfPath = storage_path('app/public/' . $application_form);
        $pdf->save($pdfPath);

        $applicant->application_form = $application_form;
        $applicant->save();

        // Send Email
        Mail::send('emails.application_form', ['form' => $applicant->toArray()], function ($message) use ($applicant, $pdfPath) {
            $resumePath = storage_path('app/public/' . $applicant->resume_file);

            $message->to("careers@niralaworld.com")
                ->subject('Application Submission')
                ->attach($pdfPath, [
                    'as' => 'ApplicationForm.pdf',
                    'mime' => 'application/pdf',
                ])
                ->attach($resumePath, [
                    'as' => 'Resume.' . pathinfo($applicant->resume_file, PATHINFO_EXTENSION),
                    'mime' => mime_content_type($resumePath),
                ]);
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
        // dd($applicant->toArray());
        return view('emails.application_form', ['form' => $applicant->toArray()]);
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
