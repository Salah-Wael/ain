<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
    public $currentYear;

    public function __construct()
    {
        $this->currentYear = Carbon::now()->year;
    }

    public function index()
    {
        $subjects = Subject::with(['department', 'semesters', 'academicYears', 'doctors'])->get();
        return view('subjects.index', compact('subjects'));
    }

    public function doctorSubject()
    {
        $doctor = Doctor::with([
            'subjects.department',
            'subjects.semesters',
            'subjects.doctors',
            'subjects.academicYears'
        ])
            ->find(auth()->guard('doctor')->id());

        $subjects = $doctor->subjects;

        return view('subjects.index', compact('subjects'));
    }

    public function studentSubject()
    {
        $student = User::with([
            'subjects.department',
            'subjects.semesters',
            'subjects.academicYears',
            'subjects.doctors',
        ])
            ->find(Auth::user()->id);

        $subjects = $student->subjects;

        return view('subjects.index', compact('subjects'));
    }

    public function subjectsStudentMayRegister()
    {
        $subjects = Subject::with(['department', 'doctors', 'semesters'])
        ->currentAcademicYear()
            ->where(function ($query) {
                $query->whereHas('students', function ($q) {
                    $q->where('student_id', Auth::id())->where('status', 'fail'); // الطالب كان راسبا
                })
                    ->orWhereDoesntHave('students', function ($q) {
                        $q->where('student_id', Auth::id()); // الطالب غير مسجل هذه المادة من قبل
                    });
            })
            ->get();

        return view('subjects.register', compact('subjects'));
    }

    public function storeStudentRegisterSubjects(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subjects,id',
        ]);

        $student = User::find(Auth::user()->id);
        $student->subjects()->sync($request->subject_id);

        return redirect()->route('subjects.student')->with('success', __('messages.subjects_registered_successfully'));
    }

    public function create()
    {
        $departments = Department::get();
        $semesters = Semester::get();
        $academicYears = AcademicYear::where('year', 'LIKE', "%$this->currentYear%")->get();
        $doctors = Doctor::get();
        return view('subjects.create', get_defined_vars());
    }

    public function show(Subject $subject)
    {
        $subject->load([
            'department',
            'semesters',
            'academicYears',
            'doctors',
            'lectures.tasks.answers.student',
        ]); // Eager load related models

        return view('subjects.show', compact('subject'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255|unique:subjects',
    //         'code' => 'required|string|max:50|unique:subjects',
    //         'department_id' => 'required|exists:departments,id',
    //         'semester_id' => 'required|exists:semesters,id',
    //         'academic_year_id' => 'required|exists:academic_years,id',
    //     ]);

    //     Subject::create($request->only(['name', 'code', 'department_id', 'semester_id', 'academic_year_id']));

    //     return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    // }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects',
            'code' => 'required|string|max:50|unique:subjects',
            'department_id' => 'required|exists:departments,id',
            'semester_id' => 'required|array',
            'semester_id.*' => 'exists:semesters,id',
            'academic_year_id' => 'required|array',
            'academic_year_id.*' => 'exists:academic_years,id',
            'doctor_id' => 'nullable|array',
            'doctor_id.*' => 'exists:doctors,id',
        ]);

        // ✅ إنشاء المادة
        $subject = Subject::create([
            'name' => $request->name,
            'code' => $request->code,
            'department_id' => $request->department_id,
        ]);

        // ✅ ربط المادة بالفصول الدراسية
        if ($request->has('semester_id')) {
            $subject->semesters()->sync($request->semester_id);
        }

        // ✅ ربط المادة بالسنوات الأكاديمية
        if ($request->has('academic_year_id')) {
            $subject->academicYears()->sync($request->academic_year_id);
        }

        // ✅ ربط المادة بالدكاترة (إذا تم تحديدهم)
        if ($request->has('doctor_id')) {
            $subject->doctors()->sync($request->doctor_id);
        }

        return redirect()->route('subjects.index')->with('success', __('messages.subject_created_successfully'));
    }


    public function edit(Subject $subject)
    {
        $departments = Department::get();
        $semesters = Semester::get();
        $academicYears = AcademicYear::where('year', 'LIKE', "%$this->currentYear%")->get();
        $doctors = Doctor::get();

        return view('subjects.edit', get_defined_vars());
    }

    // public function update(Request $request, Subject $subject)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
    //         'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
    //         'department_id' => 'required|exists:departments,id',
    //         'semester_id' => 'required|exists:semesters,id',
    //         'academic_year_id' => 'required|exists:academic_years,id',
    //     ]);

    //     $subject->update($request->only(['name', 'code', 'department_id', 'semester_id', 'academic_year_id']));

    //     return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    // }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'department_id' => 'required|exists:departments,id',
            'semester_id' => 'required|array',
            'semester_id.*' => 'exists:semesters,id',
            'academic_year_id' => 'required|array',
            'academic_year_id.*' => 'exists:academic_years,id',
            'doctor_id' => 'nullable|array',
            'doctor_id.*' => 'exists:doctors,id',
        ]);

        // Update basic subject data
        $subject->update($request->only(['name', 'code', 'department_id']));

        // Sync relationships (detach previous and attach new)
        $subject->semesters()->sync($request->semester_id);
        $subject->academicYears()->sync($request->academic_year_id);
        $subject->doctors()->sync($request->doctor_id);

        return redirect()->route('subjects.index')->with('success', __('messages.subject_updated_successfully'));
    }



    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', __('messages.subject_deleted_successfully'));
    }
}
