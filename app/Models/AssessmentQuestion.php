<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    use HasFactory;

    protected $table = 'assessment_questions';

    protected $fillable = [
        'assessment_id',
        'question'
    ];

    public function assessment() {
        return $this->belongsTo(Assessment::class);
    }

    public function assessmentQuestionAnswers() {
        return $this->hasMany(AssessmentQuestionAnswer::class);
    }
}
