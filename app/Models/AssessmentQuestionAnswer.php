<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentQuestionAnswer extends Model
{
    use HasFactory;

    protected $table = 'assessment_question_answers';

    protected $fillable = [
        'assessment_question_id',
        'answer',
        'is_correct'
    ];

    public function assessmentQuestion() {
        return $this->belongsTo(AssessmentQuestion::class);
    }
}
