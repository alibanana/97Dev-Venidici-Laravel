<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFeature extends Model
{
    use HasFactory;

    protected $table = 'course_features';

    protected $fillable = [
        'course_id',
        'requirement'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
