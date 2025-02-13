<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $guarded = [
        'id',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'semester_subject');
    }
}
