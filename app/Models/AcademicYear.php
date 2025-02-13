<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $table = 'academic_years';

    protected $fillable = ['year'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'academic_year_subject');
    }

}
