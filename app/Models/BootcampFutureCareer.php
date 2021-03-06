<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampFutureCareer extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'thumbnail',
        'title',
        'description',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
