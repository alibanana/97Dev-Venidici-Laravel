<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'date_start',
        'date_end',
        'title',
        'subtitle',
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function bootcampWeeklySchedules() {
        return $this->hasMany(BootcampWeeklySchedules::class);
    }
}
