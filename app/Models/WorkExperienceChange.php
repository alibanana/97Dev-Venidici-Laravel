<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperienceChange extends Model
{
    use HasFactory;

    protected $table = 'work_experience_changes';

    protected $fillable = [
        'candidate_detail_id',
        'work_experience_id',
        'company',
        'job_position',
        'start_date',
        'end_date',
        'location',
        'action' // create, update, delete
    ];

    public function candidateDetail() {
        return $this->belongsTo(CandidateDetail::class);
    }

    public function workExperienceChange() {
        return $this->belongsTo(WorkExperience::class);
    }
}
