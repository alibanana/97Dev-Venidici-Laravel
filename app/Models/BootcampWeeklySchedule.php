<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampWeeklySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'bootcamp_schedule_id',
        'description'
    ];

    public function bootcampSchedule() {
        return $this->belongsTo(BootcampSchedule::class);
    }
}
