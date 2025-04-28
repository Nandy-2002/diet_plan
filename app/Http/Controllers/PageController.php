<?php

namespace App\Http\Controllers;

use App\Models\Event;

class PageController extends Controller
{
    public function index()
    {
        return view('landing_page.homepage');
    }
}