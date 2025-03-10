<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::with('department')->get(); // Eager load department
        return view('student.crud.index', compact('students'));
    }

    public function create()
    {
        $departments = Department::all(); // Fetch all departments
        return view('student.crud.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email',
            'password' => 'nullable|string|min:8',
            'department_id' => 'required|exists:departments,id',
        ]);

        if (!$request->filled('password')) {
            $request->merge(['password' => 123456789]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encrypt the password
            'department_id' => $request->department_id,
        ]);

        $user->assignRole('Student');

        return redirect()->route('students.index')->with('success', __('messages.student_created'));
    }

    public function edit(User $student)
    {
        $departments = Department::all(); // Fetch all departments
        return view('student.crud.edit', compact('student', 'departments'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'password' => 'nullable|string|min:6',
            'department_id' => 'required|exists:departments,id',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $student->password,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('students.index')->with('success', __('messages.student_updated'));
    }

    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', __('messages.student_deleted'));
    }
}
