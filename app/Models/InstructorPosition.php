<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'position'
    ]

    public function instructors(){
        return $this->hasMany(Instructor::class);
    }
}
