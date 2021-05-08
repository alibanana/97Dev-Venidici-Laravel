<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice', 
        'user_id', 
        'courier', 
        'service', 
        'cost_courier', 
        'weight', 
        'name', 
        'phone', 
        'province', 
        'city', 
        'address', 
        'status', 
        'snap_token', 
        'grand_total'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
