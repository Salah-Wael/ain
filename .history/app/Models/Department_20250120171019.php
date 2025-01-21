<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Excuse;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $guarded = ['id'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function excuses()
    {
        return $this->hasMany(Excuse::class);
    }
}
