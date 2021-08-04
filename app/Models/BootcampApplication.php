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
        'birth_place',
        'birth_date',
        'gender',
        'phone_no', 
        'province_id',
        'city_id',
        'address',
        'last_degree',
        'institution',
        'batch',
        'sumber_tahu_program',
        'mencari_kerja',
        'social_media',
        'konsiderasi_lanjut',
        'kenapa_memilih',
        'expectation',
        'bankShortCode',
        'bank_account_number', 
        'is_trial', 
        'is_full_registration', 
        'status', 
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

    public function province() {
        return $this->belongsTo(Province::class);
    }
    
    public function city() {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
}
