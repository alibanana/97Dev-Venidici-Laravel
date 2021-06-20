<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 
        'course_id', 
        'qty', 
        'price',
        'withArtOrNo'
        
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
