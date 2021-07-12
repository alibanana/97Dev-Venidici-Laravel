<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCodeCounter extends Model
{
    use HasFactory;

    protected $table = 'referral_code_counters';

    protected $fillable = [
        'user_id',
        'referral_code',
        'counter'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
