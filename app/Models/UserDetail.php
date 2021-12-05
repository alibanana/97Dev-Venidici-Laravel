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
        'display_picture',
        'telephone',
        'referral_code',
        'referred_by_code',
        'response',
        'birthdate',
        'gender',
        'address',
        'company',
        'occupancy',
        'total_stars',
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
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
}
