<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'linkedIn',
        'address',
        'company',
        'education',
        'university',
        'job',
        'instructor_position_id',
        'salary',
        'cv'
    ];

    public function instructorPosition(){
        return $this->belongsTo(InstructorPosition::class);
    }
}
