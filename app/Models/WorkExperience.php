<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $table = 'work_experiences';

    protected $fillable = [
        'candidate_detail_id',
        'company',
        'job_position',
        'start_date',
        'end_date',
        'location'
    ];

    public function candidateDetail() {
        return $this->belongsTo(CandidateDetail::class);
    }

    public function workExperienceChanges() {
        return $this->hasMany(WorkExperienceChange::class);
    }
}
