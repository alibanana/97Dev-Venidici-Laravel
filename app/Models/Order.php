<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 
        'invoice', 
        'course_id', 
        'course_title', 
        'thumbnail', 
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
