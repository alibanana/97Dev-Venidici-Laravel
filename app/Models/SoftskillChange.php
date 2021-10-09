<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftskillChange extends Model
{
    use HasFactory;

    protected $table = 'softskill_changes';

    protected $fillable = [
        'candidate_detail_change_id',
        'softskill_id', // nullable
        'title',
        'score',
        'action' // create, update, delete
    ];

    public function candidateDetailChange() {
        return $this->belongsTo(CandidateDetailChange::class);
    }

    public function softskill() {
        return $this->belongsTo(Softskill::class);
    }
}
