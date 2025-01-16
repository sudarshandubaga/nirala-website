<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.inc.contact.index');
    }

    public function store(Request $request)
    {
        $contactEnquiry = new ContactEnquiry();
        $contactEnquiry->name = $request->name;
        $contactEnquiry->email = $request->email;
        $contactEnquiry->phone = $request->phone;
        $contactEnquiry->subject = $request->subject;
        $contactEnquiry->message = $request->message;
        $contactEnquiry->save();

        return redirect()->back()->with('success', 'Success! Your request has been submitted, our team will contact you shortly');
    }
}
