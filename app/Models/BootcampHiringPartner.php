<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampHiringPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'image',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
