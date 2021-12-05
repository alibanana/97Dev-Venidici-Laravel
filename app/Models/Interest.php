<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $table = 'interests';

    protected $fillable = [
        'candidate_detail_id',
        'title'
    ];

    public function candidateDetail() {
        return $this->belongsTo(CandidateDetail::class);
    }

    public function interestChanges() {
        return $this->hasMany(InterestChange::class);
    }
}
