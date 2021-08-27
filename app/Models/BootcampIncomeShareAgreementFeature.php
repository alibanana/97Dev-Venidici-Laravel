<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampIncomeShareAgreementFeature extends Model
{
    protected $table = 'bootcamp_income_share_agreement_features';

    protected $fillable = [
        'course_id',
        'feature'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
