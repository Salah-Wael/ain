<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TaskAnswer extends Model
{
    protected $guarded = [];

    public $incrementing = false;

    protected $keyType = 'array';
    protected $primaryKey = ['task_id', 'student_id'];

    public function setKeysForSaveQuery($query)
    {
        foreach ($this->primaryKey as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }

        return $query;
    }


    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    
    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
