<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDetailChange extends Model
{
    use HasFactory;

    protected $table = 'candidate_detail_changes';

    protected $fillable = [
        'candidate_id',
        'preferred_working_location',
        'linkedin_link',
        'whatsapp_number',
        'about_me_description',
        'status' // pending, approved, cancelled
    ];

    public function candidateDetail() {
        return $this->belongsTo(CandidateDetail::class);
    }

    public function workExperienceChanges() {
        return $this->hasMany(WorkExperienceChange::class);
    }

    public function educationChanges() {
        return $this->hasMany(EducationChange::class);
    }
}
