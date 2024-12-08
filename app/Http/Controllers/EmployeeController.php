<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('planss.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'position' => 'required',
            'salary' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);

        // Handle image upload
        $imagePath = $request->file('image') ? $request->file('image')->store('employees', 'public') : null;

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'salary' => $request->salary,
            'image' => $imagePath, // Save the image path
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'required',
            'salary' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload (if a new image is uploaded)
        $imagePath = $request->file('image') ? $request->file('image')->store('employees', 'public') : $employee->image;

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'salary' => $request->salary,
            'image' => $imagePath,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
