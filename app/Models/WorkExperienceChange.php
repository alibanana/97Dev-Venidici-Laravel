<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperienceChange extends Model
{
    use HasFactory;

    protected $table = 'work_experience_changes';

    protected $fillable = [
        'candidate_detail_change_id',
        'work_experience_id', // nullable
        'company',
        'job_position',
        'start_date',
        'end_date',
        'location',
        'action' // create, update, delete
    ];

    public function candidateDetailChange() {
        return $this->belongsTo(CandidateDetailChange::class);
    }

    public function workExperience() {
        return $this->belongsTo(WorkExperience::class);
    }
}
