<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->get();
        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'features' => 'required',
            'price' => 'required|numeric',

        ]);


        Plan::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'features' => json_encode($request->features),  // Storing the array as JSON
            'price' => $request->price,
        ]);


        return redirect()->route('plans.index')->with('success', 'plan created successfully.');
    }

    public function show(Plan $plan)
    {
        return view('plans.show', compact('plan'));
    }

    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required' ,
            'features' => 'required',
            'price' => 'required|numeric',
        ]);



        $plan->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'features' => json_encode($request->features),
            'price' => $request->price,
        ]);

        return redirect()->route('plans.index')->with('success', 'plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'plan deleted successfully.');
    }
}
