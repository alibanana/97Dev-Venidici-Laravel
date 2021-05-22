<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentRequirement extends Model
{
    use HasFactory;

    protected $table = 'assessment_requirements';

    protected $fillable = [
        'assessment_id',
        'requirement'
    ];

    public function assessment() {
        return $this->belongsTo(Assessment::class);
    }
}
