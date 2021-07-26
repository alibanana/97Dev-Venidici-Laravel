<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampBenefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'course_id',
    ];

    public function bootcampApplication() {
        return $this->belongsTo(BootcampApplcation::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
