<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrestProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'program',
        'category',
        'description',
        'thumbnail'
    ];

    public function krest() {
        return $this->belongsTo(Krest::class);
    }
}
