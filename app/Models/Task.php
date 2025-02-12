<?php

namespace App\Models;

use App\Models\Lecture;
use App\Models\TaskAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $guarded = [];

    public function lecture(){
        return $this->belongsTo(Lecture::class);
    }

    public function answers(){
        return $this->hasMany(TaskAnswer::class);
    }
}
