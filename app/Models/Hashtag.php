<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;

    protected $fillable = [
        'hashtag',
        'image',
        'color'
    ];

    public function courses() {
        return $this->belongsToMany(Course::class, 'course_hashtag')->withTimestamps();
    }
}
