<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'image',
        'description', 
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
