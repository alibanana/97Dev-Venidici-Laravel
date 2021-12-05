<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Softskill extends Model
{
    use HasFactory;

    protected $table = 'softskills';

    protected $fillable = [
        'candidate_detail_id',
        'title',
        'score'
    ];

    public function candidateDetail() {
        return $this->belongsTo(CandidateDetail::class);
    }

    public function softskillChanges() {
        return $this->hasMany(SoftskillChange::class);
    }
}
