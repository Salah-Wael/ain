<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassRoomSubject extends Pivot
{
    public $incrementing = true;

    protected $primaryKey = 'id';

    protected $table = 'class_room_subject';
}
