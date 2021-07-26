<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampCourseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'meeting_link',
        'syllabus'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
