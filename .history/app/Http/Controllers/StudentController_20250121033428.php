<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('subjects')->get();
        return view('student_subjects.index', compact('students'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('student_subjects.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        $student->subjects()->sync($request->subject_ids);

        return redirect()->route('student_subjects.index')->with('success', 'Subjects assigned successfully.');
    }

    public function edit(Student $student)
    {
        $subjects = Subject::all();
        $assignedSubjects = $student->subjects->pluck('id')->toArray();

        return view('student_subjects.edit', compact('student', 'subjects', 'assignedSubjects'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $student->subjects()->sync($request->subject_ids);

        return redirect()->route('student_subjects.index')->with('success', 'Subjects updated successfully.');
    }
}
