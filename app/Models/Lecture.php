<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecture extends Model
{
    /** @use HasFactory<\Database\Factories\LectureFactory> */
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function tasks(){
        return $this->hasMany(related: Task::class);
    }
}
