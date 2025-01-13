<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Excuse extends Model
{
    protected $guarded = ['id'];

    // Each excuse belongs to one student
    public function student()
    {
        return $this->belongsTo(User::class);
    }

    // Each excuse belongs to one department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // One excuse can have many images
    public function images()
    {
        return $this->hasMany(ExcuseImage::class);
    }
}
