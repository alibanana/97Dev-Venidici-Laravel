<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'title',
        'detail',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}