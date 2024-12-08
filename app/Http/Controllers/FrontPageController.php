<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {
        $plans = Plan::all(); // Fetch all plans
        return view('welcome', compact('plans'));
    }
}

