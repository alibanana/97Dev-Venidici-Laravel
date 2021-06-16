<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtSupply extends Model
{
    use HasFactory;

    protected $table = 'art_supplies';

    protected $fillable = [
        'image',
        'name',
        'description'
    ];

    public function courses() {
        return $this->belongsToMany(Course::class, 'course_art_supply')->withTimestamps();
    }
}
