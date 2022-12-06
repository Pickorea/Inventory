<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pdd.index');
    }

    public function about()
    {
        return view('pdd.about.index');
    }

}
