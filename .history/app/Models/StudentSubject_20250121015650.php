<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $table = 'student_subject';
}
