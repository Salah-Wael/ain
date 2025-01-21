<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('department', 'subjects')->get();
        return view('doctor.doctor-crud.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::all();
        $subjects = Subject::all();
        return view('doctor.doctor-crud.create', compact('departments', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:6|confirmed',
            'department_id' => 'required|exists:departments,id',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        $doctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'department_id' => $request->department_id,
        ]);

        $doctor->subjects()->attach($request->subjects);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function edit($id)
    {
        $doctor = Doctor::with('subjects')->findOrFail($id);
        $departments = Department::all();
        $subjects = Subject::all();
        return view('doctor.doctor-crud.edit', compact('doctor', 'departments', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $id,
            'department_id' => 'required|exists:departments,id',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
        ]);

        $doctor->subjects()->sync($request->subjects);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
