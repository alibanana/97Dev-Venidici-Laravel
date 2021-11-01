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
        'hashtag_id',
        'is_featured'
    ];

    public function hashtag() {
        return $this->belongsTo(Hashtag::class, 'hashtags');
    }
}
