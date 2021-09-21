<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementChange extends Model
{
    use HasFactory;

    protected $table = 'achievement_changes';

    protected $fillable = [
        'candidate_detail_change_id',
        'achievement_id',
        'title',
        'location_of_event',
        'year',
        'action' // created, update, delete
    ];

    public function candidateDetailChange() {
        return $this->belongsTo(CandidateDetailChange::class);
    }

    public function achievement() {
        return $this->belongsTo(Achievement::class);
    }
}
