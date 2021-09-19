<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDetail extends Model
{
    use HasFactory;

    protected $table = 'candidate_details';

    protected $fillable = [
        'user_id',
        'preferred_working_location',
        'linkedin_link',
        'whatsapp_number',
        'about_me_description'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function candidateDetailChanges() {
        return $this->hasMany(CandidateDetailChange::class);
    }

    public function workExperiences() {
        return $this->hasMany(WorkExperience::class);
    }

    public function educations() {
        return $this->hasMany(Education::class);
    }
}
