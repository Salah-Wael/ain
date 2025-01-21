<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Excuse;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $guarded = ['id'];

    public function headOfDepartment()
    {
        return $this->hasOne(HeadOfDepartment::class, 'department_id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function excuses()
    {
        return $this->hasMany(Excuse::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'department_id');
    }
}
