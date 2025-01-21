<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::with('subjects')->get();
        return view('Student.crud.index', compact('students'));
    }

    public function create()
    {
        $students = User::all();
        $subjects = Subject::all();

        return view('Student.crud.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subjects,id',
        ]);

        $student = User::findOrFail($request->student_id);
        $student->subjects()->sync($request->subject_ids);

        return redirect()->route('student.index')->with('success', 'Subjects assigned successfully.');
    }

    public function edit(User $student)
    {
        $subjects = Subject::all();
        $assignedSubjects = $student->subjects->pluck('id')->toArray();

        return view('Student.crud.edit', compact('student', 'subjects', 'assignedSubjects'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subjects,id',
        ]);

        $student->subjects()->sync($request->subject_ids);

        return redirect()->route('student_subjects.index')->with('success', 'Subjects updated successfully.');
    }
}
