<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_type_id',
        'course_category_id',
        'thumbnail',
        'preview_video',
        'title',
        'subtitle',
        'description',
        'price', // default -> 0
        'priceWithArtKit', // nullable
        'enrollment_status', // default -> Open
        'publish_status', // default -> Draft
        'total_duration', // nullable
        'average_rating', // default -> 0
        'isDeleted', // default -> 0
        'isFeatured' // default -> 0
    ];

    public function courseType() {
        return $this->belongsTo(CourseType::class);
    }

    public function courseCategory() {
        return $this->belongsTo(CourseCategory::class);
    }

    public function courseRequirements() {
        return $this->hasMany(CourseRequirement::class);
    }

    public function courseFeatures() {
        return $this->hasMany(CourseFeature::class);
    }

    public function wokiCourseDetail() {
        return $this->hasOne(WokiCourseDetail::class);
    }

    public function hashtags() {
        return $this->belongsToMany(Hashtag::class, 'course_hashtag')->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_course')->withPivot(
            'status'
        )->withTimestamps();
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function assessment() {
        return $this->hasOne(Assessment::class);
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'course_teacher')->withTimestamps();
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function sections() {
        return $this->hasMany(Section::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function artSupplies() {
        return $this->belongsToMany(ArtSupply::class, 'course_art_supply')->withTimestamps();
    }
}
