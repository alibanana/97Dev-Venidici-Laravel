<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeTestimony extends Model
{
    use HasFactory;

    protected $table = 'fake_testimonies';

    protected $fillable = [
        'thumbnail',
        'content',
        'rating',
        'name',
        'occupancy'
    ];

    protected $casts = [
        'rating' => 'decimal:2'
    ];
}
