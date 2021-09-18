<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'duration',
        'short_description',
        'body',
        'banner',
        'image',
        'hashtag',
        'is_featured'
    ];

    public function hashtags() {
        return $this->belongsToMany(Hashtag::class, 'blog_hashtag')->withTimestamps();
    }
}
