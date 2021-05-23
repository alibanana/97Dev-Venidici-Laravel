<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'telephone',
        'referral_code',
        'birthdate',
        'gender',
        'address',
        'company',
        'occupancy',
        'interest',
        'response',
        'province_id',
        'city_id',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function province() {
        return $this->belongsTo(Province::class);
    }
    public function city() {
        return $this->belongsTo(City::class);
    }
}
