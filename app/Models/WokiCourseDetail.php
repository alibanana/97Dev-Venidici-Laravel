<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WokiCourseDetail extends Model
{
    use HasFactory;

    protected $table = 'woki_course_details';

    protected $fillabel = [
        'course_id',
        'zoom_link',
        'event_date',
        'start_time',
        'end_time',
        'event_duration'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
