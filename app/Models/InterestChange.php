<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestChange extends Model
{
    use HasFactory;

    protected $table = 'interest_changes';

    protected $fillable = [
        'candidate_detail_change_id',
        'interest_id', // nullable
        'title',
        'action' // create, update, delete
    ];

    public function candidateDetailChange() {
        return $this->belongsTo(CandidateDetailChange::class);
    }

    public function interest() {
        return $this->belongsTo(Interest::class);
    }
}
