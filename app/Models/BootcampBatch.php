<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id','date',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
