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
        'about_me_description',
        'experience_year',
        'industry',
        'cv_file'
    ];

    // Method to check if column exists.
    public function hasAttribute($attr) {
        return array_key_exists($attr, $this->attributes);
    }

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

    public function achievements() {
        return $this->hasMany(Achievement::class);
    }

    public function hardskills() {
        return $this->hasMany(Hardskill::class);
    }

    public function softskills() {
        return $this->hasMany(Softskill::class);
    }

    public function interests() {
        return $this->hasMany(Interest::class);
    }
}
