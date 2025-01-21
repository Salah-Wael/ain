<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Semester;
use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Model;
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
        return $this->belongsToMany(Doctor::class);
        return $this->belongsToMany(Doctor::class, 'doctor_subject', 'subject_id', 'doctor_id');
    }

    public function classRooms()
    {
        return $this->belongsToMany(ClassRoom::class)->withPivot(['from', 'to']);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
