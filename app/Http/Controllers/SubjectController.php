<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{


    public function index()
    {
        $subjects = Subject::with(['department', 'semester', 'academicYear'])->get();
        return view('subjects.index', compact('subjects'));
    }
    public function doctorSubject()
    {
        $doctor = Doctor::with([
            'subjects.department',
            'subjects.semester',
            'subjects.academicYear'
        ])
            ->find(auth()->guard('doctor')->id());

        $subjects = $doctor->subjects;

        return view('subjects.index', compact('subjects'));
    }

    public function studentSubject()
    {
        $student = User::with([
            'subjects.department',
            'subjects.semester',
            'subjects.academicYear',
            'subjects.doctors',
        ])
            ->find(Auth::user()->id);

        $subjects = $student->subjects;

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        $departments = Department::all();
        $semesters = Semester::all();
        $academicYears = AcademicYear::all();
        return view('subjects.create', compact('departments', 'semesters', 'academicYears'));
    }

    public function show(Subject $subject)
    {
        $subject->load([
            'department',
            'semester',
            'academicYear',
            'doctors',
            'lectures.tasks.answers.student',
        ]); // Eager load related models

        return view('subjects.show', compact('subject'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects',
            'code' => 'required|string|max:50|unique:subjects',
            'department_id' => 'required|exists:departments,id',
            'semester_id' => 'required|exists:semesters,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        Subject::create($request->only(['name', 'code', 'department_id', 'semester_id', 'academic_year_id']));

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        $departments = Department::all();
        $semesters = Semester::all();
        $academicYears = AcademicYear::all();

        return view('subjects.edit', compact('subject', 'departments', 'semesters', 'academicYears'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'department_id' => 'required|exists:departments,id',
            'semester_id' => 'required|exists:semesters,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $subject->update($request->only(['name', 'code', 'department_id', 'semester_id', 'academic_year_id']));

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
