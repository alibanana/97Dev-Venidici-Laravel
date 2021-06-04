<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'type',
        'promo_for',
        'discount',
        'isActive',
        'start_date',
        'finish_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
