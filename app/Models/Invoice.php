<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no', 
        'user_id', 
        'courier', 
        'service', 
        'cost_courier', 
        'total_weight', 
        'name', 
        'phone', 
        'province', 
        'city', 
        'address', 
        'shipping_notes', 
        'status', 
        'total_order_price',
        'discounted_price', 
        'club_discount', 
        'grand_total',
        'xfers_payment_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }
}
