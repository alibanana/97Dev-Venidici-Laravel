<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardskillChange extends Model
{
    use HasFactory;

    protected $table = 'hardskill_changes';

    protected $fillable = [
        'candidate_detail_change_id',
        'hardskill_id',
        'title',
        'score',
        'action' // create, update, delete
    ];

    public function candidateDetailChange() {
        return $this->belongsTo(CandidateDetailChange::class);
    }

    public function hardskill() {
        return $this->belongsTo(Hardskill::class);
    }
}
