<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'invoice_id',
        'name', 
        'email', 
        'phone_no', 
        'bank', 
        'bank_account_number', 
        'address' 
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function bootcampDescriptions() {
        return $this->hasMany(BootcampDescription::class);
    }

    public function bootcampCourseDetails() {
        return $this->hasMany(BootcampCourseDetail::class);
    }

    public function bootcampBenefits() {
        return $this->hasMany(BootcampBenefit::class);
    }

    public function bootcampCandidates() {
        return $this->hasMany(BootcampCandidate::class);
    }

    public function bootcampFutureCareers() {
        return $this->hasMany(BootcampFutureCareer::class);
    }
}
