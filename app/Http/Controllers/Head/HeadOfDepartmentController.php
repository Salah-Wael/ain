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
        return view('head.crud.index', compact('headsOfDepartments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('head.crud.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:head_of_departments',
            'password' => 'nullable|string|min:8',
            'department_id' => 'required|exists:departments,id',
        ]);

        if (!$request->filled('password')) {
            $request->merge(['password' => 123456789]);
        }

        $head = HeadOfDepartment::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
        ]);

        $head->assignRole('Head-Of-Department');

        return redirect()->route('head_of_departments.index')->with('success', 'Head of Department added successfully.');
    }

    public function edit(HeadOfDepartment $headOfDepartment)
    {
        $departments = Department::all();
        return view('head.crud.edit', compact('headOfDepartment', 'departments'));
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
