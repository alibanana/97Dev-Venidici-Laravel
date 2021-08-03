<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampCourseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'what_will_be_taught',
        'course_id',
        'meeting_link',
        'syllabus',
        'date_start',
        'date_end',
        'trial_date_end',
        'bootcamp_full_price',
        'bootcamp_trial_price',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
