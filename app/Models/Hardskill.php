<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardskill extends Model
{
    use HasFactory;

    protected $table = 'hardskills';

    protected $fillable = [
        'candidate_detail_id',
        'title',
        'score'
    ];

    public function candidateDetail() {
        return $this->belongsTo(CandidateDetail::class);
    }

    public function hardskillChanges() {
        return $this->hasMany(HardskillChange::class);
    }
}
