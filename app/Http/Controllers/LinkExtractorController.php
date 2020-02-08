<?php

namespace App\Http\Controllers;

class LinkExtractorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('link-extractor.index');
    }
}
