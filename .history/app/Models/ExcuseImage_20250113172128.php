<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
