<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrestProgram extends Model
{
    use HasFactory;

    protected $table = 'krest_programs';

    protected $fillable = [
        'program',
        'category',
        'description',
        'thumbnail' // nullable
    ];

    public function krests() {
        return $this->hasMany(Krest::class);
    }
}
