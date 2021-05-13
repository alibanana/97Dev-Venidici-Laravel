<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', // nullable
        'title',
        'duration',
        'description'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function assessmentRequirements() {
        return $this->hasMany(AssessmentRequirement::class);
    }

    public function assessmentQuestions() {
        return $this->hasMany(AssessmentQuestion::class);
    }
}
