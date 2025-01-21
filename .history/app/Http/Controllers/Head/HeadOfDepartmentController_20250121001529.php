<?php

namespace App\Http\Controllers\Head;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\HeadOfDepartment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class HeadOfDepartmentController extends Controller
{
    public function index()
    {
        $headsOfDepartments = HeadOfDepartment::with('department')->get();
        return view('head.c.index', compact('headsOfDepartments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('head_of_departments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:head_of_departments',
            'password' => 'required|string|min:8',
            'department_id' => 'required|exists:departments,id',
        ]);

        HeadOfDepartment::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('head_of_departments.index')->with('success', 'Head of Department added successfully.');
    }

    public function edit(HeadOfDepartment $headOfDepartment)
    {
        $departments = Department::all();
        return view('head_of_departments.edit', compact('headOfDepartment', 'departments'));
    }

    public function update(Request $request, HeadOfDepartment $headOfDepartment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:head_of_departments,email,' . $headOfDepartment->id,
            'password' => 'nullable|string|min:8',
            'department_id' => 'required|exists:departments,id',
        ]);

        $headOfDepartment->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $headOfDepartment->password,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('head_of_departments.index')->with('success', 'Head of Department updated successfully.');
    }

    public function destroy(HeadOfDepartment $headOfDepartment)
    {
        $headOfDepartment->delete();
        return redirect()->route('head_of_departments.index')->with('success', 'Head of Department deleted successfully.');
    }
}
