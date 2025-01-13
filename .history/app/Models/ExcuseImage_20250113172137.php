<?php

namespace App\Models;

use App\Models\Excuse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExcuseImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'excuse_id'];

    // Each image belongs to one excuse
    public function excuse()
    {
        return $this->belongsTo(Excuse::class);
    }
}
