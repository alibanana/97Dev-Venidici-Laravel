<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampFutureCareer extends Model
{
    use HasFactory;

    protected $fillable = [
        'bootcamp_application_id',
        'title',
        'description',
    ];

    public function bootcampApplication() {
        return $this->belongsTo(BootcampApplcation::class);
    }
}
