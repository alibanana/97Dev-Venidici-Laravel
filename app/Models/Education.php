<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'candidate_detail_id',
        'degree',
        'school',
        'major',
        'start_year',
        'end_year'
    ];

    public function candidateDetail() {
        return $this->belongsTo(CandidateDetail::class);
    }

    public function educationChanges() {
        return $this->hasMany(EducationChange::class);
    }
}
