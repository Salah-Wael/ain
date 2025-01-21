<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentSubject extends P
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'student_subject';
}
