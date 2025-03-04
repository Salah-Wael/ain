<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Lecture;
use App\Models\Semester;
use App\Models\ClassRoom;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_subject', 'subject_id', 'doctor_id');
    }

    public function classRooms()
    {
        return $this->belongsToMany(ClassRoom::class)->withPivot(['from', 'to']);
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'semester_subject', 'subject_id', 'semester_id');
    }
    // public function semester()
    // {
    //     return $this->belongsTo(Semester::class);
    // }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // Scope to filter subjects by the current academic year
    public function scopeCurrentAcademicYear(Builder $query)
    {
        $currentYear = Carbon::now()->year;
        return $query->whereHas('academicYears', function ($query) use ($currentYear) {
            $query->where('year', 'LIKE', "%$currentYear%");
        });
    }
    public function academicYears()
    {
        return $this->belongsToMany(AcademicYear::class, 'academic_year_subject','subject_id', 'academic_year_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_subject', 'subject_id', 'student_id');
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
}
