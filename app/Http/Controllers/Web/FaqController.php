<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FaqCategory $faqCategory)
    {
        $faqs = Faq::where('faq_category_id', $faqCategory->id)->latest()->get();
        return view('web.inc.faq.index', compact('faqs', 'faqCategory'));
    }
}
