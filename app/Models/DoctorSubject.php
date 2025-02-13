<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DoctorSubject extends Pivot
{
    use HasFactory;

    public $incrementing = true;
    public $primaryKey = 'id';

    public $table = 'doctor_subject';
}
