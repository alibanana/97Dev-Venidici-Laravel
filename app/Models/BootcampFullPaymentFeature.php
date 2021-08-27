<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampFullPaymentFeature extends Model
{
    use HasFactory;

    protected $table = 'bootcamp_full_payment_features';

    protected $fillable = [
        'course_id',
        'feature'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
