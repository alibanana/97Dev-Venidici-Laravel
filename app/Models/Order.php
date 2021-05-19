<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 
        'order_item_id', 
        'qty', 
        'price'
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
