<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('public.about');
    }

    public function faq()
    {
        return view('public.faq');
    }
}
