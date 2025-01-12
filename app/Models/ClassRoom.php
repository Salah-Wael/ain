<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassRoom extends Model
{
    /** @use HasFactory<\Database\Factories\ClassRoomFactory> */
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot(['from', 'to']);
    }
}
