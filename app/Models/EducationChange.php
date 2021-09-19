<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationChange extends Model
{
    use HasFactory;

    protected $table = 'education_changes';

    protected $fillable = [
        'candidate_detail_id',
        'education_id',
        'degree',
        'school',
        'major',
        'start_year',
        'end_year',
        'action' // create, udpate, delete
    ];

    public function candidateDetail() {
        return $this->belongsTo(CandidateDetail::class);
    }

    public function education() {
        return $this->belongsTo(Education::class);
    }
}
