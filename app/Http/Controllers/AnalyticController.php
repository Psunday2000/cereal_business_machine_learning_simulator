<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    public function analytics()
    {
        return view('analytics');
    }
}
