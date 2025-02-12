<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentSubject extends Pivot
{
    use HasFactory;

    protected $incrementing = true;
    protected $primaryKey = 'id';
    protected $table = 'student_subject';
}
