<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardIndexController extends Controller
{
    public function index()
    {
        return view('dashboard.index'); 
    }
}
