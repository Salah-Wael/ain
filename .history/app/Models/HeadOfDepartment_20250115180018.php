<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class HeadOfDepartment extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $guarded = [
        'id'
    ];
}
