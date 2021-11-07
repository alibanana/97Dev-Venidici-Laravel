<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'hashtag_id',
        'title',
        'author',
        'duration',
        'short_description',
        'body',
        'banner',
        'is_featured'
    ];

    public function hashtag() {
        return $this->belongsTo(Hashtag::class);
    }
}
