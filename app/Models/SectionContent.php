<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionContent extends Model
{
    use HasFactory;

    protected $table = 'section_contents';

    protected $fillable = [
        'section_id',
        'title',
        'youtube_link', // nullable
        'attachment', // nullable
        'description', // nullable
        'duration' // nullable
    ];

    public function section() {
        return $this->belongsTo(Section::class);
    }
}
