<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampCourseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bootcamp_application_id',
        'meeting_link',
        'syllabus'
    ];

    public function bootcampApplication() {
        return $this->belongsTo(BootcampApplication::class);
    }
}
