<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','description','stars', 'type','discount','promo_for'
    ];
}
