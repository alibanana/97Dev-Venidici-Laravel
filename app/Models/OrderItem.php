<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'type', 
        'category', 
        'image', 
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
